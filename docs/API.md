# API Documentation

## 1. TikTok Webhook API

Digunakan oleh Node.js TikTok Connector untuk mengirim event realtime dari TikTok Live ke Laravel.

**Endpoint:** `POST /api/tiktok/webhook`  
**Auth:** Bearer Token (Dari `.env` `TIKTOK_WEBHOOK_SECRET`)

### Payload Example (Chat Event)
```json
{
  "type": "chat",
  "data": {
    "userId": "123456",
    "uniqueId": "user123",
    "nickname": "User 123",
    "comment": "ramal aku"
  },
  "timestamp": "2024-05-10T12:00:00Z"
}
```

## 2. WebSocket Channels (Reverb)

Client (Overlay atau browser) melakukan listen ke channel berikut via Laravel Echo.

### Channel: `overlay`
- **Event: `FortuneGenerated`**
  Dikirim saat ada ramalan baru.
  ```json
  {
    "fortune": {
      "id": 1,
      "name": "Budi",
      "title": "Ramalan Masa Depan Budi",
      "content": "Isi ramalan...",
      "luck_level": 85,
      "emoji": "🌟"
    }
  }
  ```

- **Event: `OverlayUpdate`**
  Dikirim saat pengaturan overlay diubah dari Admin.

### Channel: `tiktok`
- **Event: `TiktokCommentReceived`**
- **Event: `TiktokGiftReceived`**

### Channel: `leaderboard`
- **Event: `LeaderboardUpdated`**
