<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramalanku Overlay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #00ff00 !important; /* Greenscreen for OBS Chroma Key */
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
        
        .overlay-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end; /* Show at bottom by default */
        }

        .fortune-popup {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 24px;
            max-width: 600px;
            width: 90vw; /* Take 90% width on mobile */
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            transform-origin: bottom center;
        }

        @media (max-width: 640px) {
            .fortune-popup {
                padding: 20px;
                width: 95vw;
                border-radius: 20px;
            }
        }

        .fortune-popup.glow-primary {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 30px rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.3);
        }

        .fortune-popup.glow-purple {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 30px rgba(168, 85, 247, 0.3);
            border-color: rgba(168, 85, 247, 0.3);
        }

        /* Vue/Alpine Animations */
        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .fade-enter-from, .fade-leave-to {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body x-data="overlayManager()">

    <div class="overlay-container p-4 md:p-10">
        
        {{-- Queue Status (Hidden normally, useful for debug) --}}
        <div class="absolute top-4 left-4 text-white/50 text-xs font-mono" x-show="queue.length > 0">
            Queue: <span x-text="queue.length"></span>
        </div>

        {{-- Fortune Popup --}}
        <div class="w-full flex justify-center pb-4 md:pb-8">
            <template x-if="currentFortune">
                <div class="fortune-popup"
                     :class="currentFortune.mode === 'openai' ? 'glow-purple' : 'glow-primary'"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-10 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">
                    
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 text-center sm:text-left">
                        <div class="text-7xl sm:text-6xl animate-bounce-in mb-2 sm:mb-0" x-text="currentFortune.emoji"></div>
                        <div class="flex-1 w-full">
                            
                            <div class="flex justify-center sm:justify-start">
                                <template x-if="currentFortune.name">
                                    <div class="inline-block px-3 py-1 bg-white/10 rounded-full text-sm font-bold text-slate-300 mb-2 border border-white/5">
                                        👤 <span x-text="currentFortune.name"></span>
                                    </div>
                                </template>
                            </div>

                            <h2 class="text-xl sm:text-2xl font-bold font-[Outfit] text-white mb-2" x-text="currentFortune.title"></h2>
                            <p class="text-lg sm:text-xl text-slate-200 leading-relaxed font-medium" x-text="currentFortune.content"></p>
                            
                            <div class="mt-4 flex flex-col sm:flex-row items-center sm:items-center gap-2 sm:gap-3 w-full">
                                <span class="text-sm font-bold text-slate-400">Keberuntungan:</span>
                                <div class="w-full sm:flex-1 h-3 bg-slate-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-1000"
                                         :style="`width: ${currentFortune.luck_level}%`"></div>
                                </div>
                                <span class="text-sm font-bold text-white" x-text="`${currentFortune.luck_level}%`"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Confetti Script --}}
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        function overlayManager() {
            return {
                queue: [],
                currentFortune: null,
                isProcessing: false,
                displayDuration: 8000, // 8 seconds per fortune
                voices: [],

                init() {
                    console.log('Overlay initialized. Waiting for events...');
                    
                    // Load TTS Voices
                    const loadVoices = () => {
                        this.voices = window.speechSynthesis.getVoices();
                    };
                    loadVoices();
                    if (window.speechSynthesis && window.speechSynthesis.onvoiceschanged !== undefined) {
                        window.speechSynthesis.onvoiceschanged = loadVoices;
                    }

                    // Because Vite defers app.js, we wait briefly for window.Echo to be ready
                    const checkEcho = setInterval(() => {
                        if (window.Echo) {
                            clearInterval(checkEcho);
                            console.log('Echo is ready! Listening to overlay channel...');
                            window.Echo.channel('overlay')
                                .listen('.FortuneGenerated', (e) => {
                                    console.log('Received fortune:', e.fortune);
                                    this.queue.push(e.fortune);
                                    this.processQueue();
                                })
                                .listen('.OverlayUpdate', (e) => {
                                    console.log('Received overlay settings update:', e.settings);
                                    if (e.settings.displayDuration) {
                                        this.displayDuration = e.settings.displayDuration * 1000;
                                    }
                                });
                        }
                    }, 200);
                    
                    // Timeout after 10 seconds
                    setTimeout(() => {
                        if (!window.Echo) {
                            clearInterval(checkEcho);
                            console.error('Laravel Echo failed to initialize after 10 seconds. Please ensure Reverb is running and app.js is compiled.');
                        }
                    }, 10000);
                },

                processQueue() {
                    if (this.isProcessing || this.queue.length === 0) return;

                    this.isProcessing = true;
                    this.currentFortune = this.queue.shift();

                    // Play Notification Pop Sound
                    this.playPopSound();

                    // Read out loud (Text to Speech)
                    this.speakText(this.currentFortune);

                    // Trigger sound/effects
                    if (this.currentFortune.luck_level >= 80) {
                        this.triggerConfetti();
                    }

                    // Hide after duration
                    setTimeout(() => {
                        this.currentFortune = null;
                        
                        // Wait a bit before showing the next one
                        setTimeout(() => {
                            this.isProcessing = false;
                            this.processQueue();
                        }, 500);
                    }, this.displayDuration);
                },

                playPopSound() {
                    try {
                        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                        if (audioCtx.state === 'suspended') audioCtx.resume();
                        
                        const oscillator = audioCtx.createOscillator();
                        const gainNode = audioCtx.createGain();
                        
                        oscillator.type = 'sine';
                        oscillator.frequency.setValueAtTime(440, audioCtx.currentTime); // A4
                        oscillator.frequency.exponentialRampToValueAtTime(880, audioCtx.currentTime + 0.1); // Slide up to A5

                        gainNode.gain.setValueAtTime(0, audioCtx.currentTime);
                        gainNode.gain.linearRampToValueAtTime(0.3, audioCtx.currentTime + 0.02);
                        gainNode.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.3);

                        oscillator.connect(gainNode);
                        gainNode.connect(audioCtx.destination);

                        oscillator.start(audioCtx.currentTime);
                        oscillator.stop(audioCtx.currentTime + 0.3);
                    } catch (e) {
                        console.log("Audio failed", e);
                    }
                },

                speakText(fortune) {
                    if ('speechSynthesis' in window) {
                        // Cancel previous speech if any
                        window.speechSynthesis.cancel();

                        // Construct text to read
                        let textToRead = "";
                        if (fortune.name) textToRead += fortune.name + " . "; // dot for slight pause
                        textToRead += fortune.title + " . " + fortune.content;

                        const utterance = new SpeechSynthesisUtterance(textToRead);
                        utterance.lang = 'id-ID'; // Indonesian voice
                        utterance.rate = 0.95; // Slightly slower for clarity
                        utterance.pitch = 1.2; // Increase pitch to sound more feminine/cheerful
                        utterance.volume = 1.0;

                        // Try to select a known female Indonesian voice
                        let idVoices = this.voices.filter(v => v.lang.startsWith('id'));
                        if (idVoices.length > 0) {
                            // "Damayanti" is Mac female, "Gadis" is Windows female, "Google" is Chrome default female
                            let femaleVoice = idVoices.find(v => v.name.includes('Damayanti') || v.name.includes('Gadis') || v.name.includes('Google'));
                            utterance.voice = femaleVoice || idVoices[0]; // fallback to first ID voice
                        }

                        // Force OBS/Browser to play
                        setTimeout(() => {
                            window.speechSynthesis.speak(utterance);
                        }, 200); // Slight delay after pop sound
                    }
                },

                triggerConfetti() {
                    if (typeof confetti === 'function') {
                        confetti({
                            particleCount: 100,
                            spread: 70,
                            origin: { y: 0.6 },
                            colors: ['#3b82f6', '#a855f7', '#ec4899']
                        });
                    }
                }
            }
        }
    </script>
</body>
</html>
