require('dotenv').config({ path: '../.env' });
const express = require('express');
const { WebcastPushConnection } = require('tiktok-live-connector');
const axios = require('axios');

const app = express();
app.use(express.json());

const PORT = process.env.TIKTOK_CONNECTOR_PORT || 3000;
const LARAVEL_API_URL = process.env.APP_URL ? `${process.env.APP_URL}/api/tiktok/webhook` : 'http://localhost:8000/api/tiktok/webhook';
const API_TOKEN = process.env.TIKTOK_WEBHOOK_SECRET || 'ramalanku-secret-token';

let tiktokLiveConnection = null;
let currentUsername = '';

console.log('🚀 TikTok Live Connector for Ramalanku starting...');

// API to connect to a stream
app.post('/api/connect', async (req, res) => {
    const { username } = req.body;
    
    if (!username) {
        return res.status(400).json({ error: 'Username is required' });
    }

    if (tiktokLiveConnection) {
        tiktokLiveConnection.disconnect();
    }

    currentUsername = username;
    
    try {
        tiktokLiveConnection = new WebcastPushConnection(username);
        
        // Connect to the stream
        await tiktokLiveConnection.connect();
        console.log(`✅ Connected to livestream: @${username}`);
        
        setupEventListeners(tiktokLiveConnection);
        
        res.json({ success: true, message: `Connected to @${username}` });
    } catch (err) {
        console.error(`❌ Failed to connect:`, err.message);
        res.status(500).json({ error: err.message });
    }
});

// API to disconnect
app.post('/api/disconnect', (req, res) => {
    if (tiktokLiveConnection) {
        tiktokLiveConnection.disconnect();
        tiktokLiveConnection = null;
        console.log(`🛑 Disconnected from livestream: @${currentUsername}`);
        res.json({ success: true, message: 'Disconnected' });
    } else {
        res.json({ success: false, message: 'Not connected' });
    }
});

// API status
app.get('/api/status', (req, res) => {
    res.json({
        connected: !!tiktokLiveConnection,
        username: currentUsername
    });
});

function setupEventListeners(connection) {
    // Send data to Laravel
    const sendToLaravel = async (type, data) => {
        try {
            await axios.post(LARAVEL_API_URL, {
                type,
                data,
                timestamp: new Date().toISOString()
            }, {
                headers: {
                    'Authorization': `Bearer ${API_TOKEN}`,
                    'Content-Type': 'application/json'
                }
            });
        } catch (error) {
            console.error('Failed to forward to Laravel:', error.message);
        }
    };

    // Chat events
    connection.on('chat', data => {
        console.log(`[CHAT] @${data.uniqueId}: ${data.comment}`);
        sendToLaravel('chat', {
            userId: data.userId,
            uniqueId: data.uniqueId,
            nickname: data.nickname,
            comment: data.comment,
            profilePictureUrl: data.profilePictureUrl
        });
    });

    // Gift events
    connection.on('gift', data => {
        if (data.giftType === 1 && !data.repeatEnd) {
            // Streak in progress => show only temporary
            console.log(`[GIFT] @${data.uniqueId} is sending gift ${data.giftName} x${data.repeatCount}`);
        } else {
            // Streak ended or non-streakable gift => process
            console.log(`[GIFT] @${data.uniqueId} sent gift ${data.giftName} x${data.repeatCount}`);
            sendToLaravel('gift', {
                userId: data.userId,
                uniqueId: data.uniqueId,
                nickname: data.nickname,
                giftId: data.giftId,
                giftName: data.giftName,
                repeatCount: data.repeatCount,
                diamondCount: data.diamondCount,
                profilePictureUrl: data.profilePictureUrl
            });
        }
    });

    // Room user count events
    connection.on('roomUser', data => {
        sendToLaravel('viewer_count', {
            viewerCount: data.viewerCount
        });
    });

    // Like events
    connection.on('like', data => {
        sendToLaravel('like', {
            uniqueId: data.uniqueId,
            nickname: data.nickname,
            likeCount: data.likeCount,
            totalLikeCount: data.totalLikeCount
        });
    });
    
    // Disconnect event
    connection.on('disconnected', () => {
        console.log('Disconnected from stream.');
        sendToLaravel('disconnected', { username: currentUsername });
    });
}

app.listen(PORT, () => {
    console.log(`📡 TikTok Connector server running on port ${PORT}`);
});
