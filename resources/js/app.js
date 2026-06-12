import './bootstrap';

/**
 * Alpine.js is now handled by Livewire 3 automatically
 */

/**
 * Confetti Helper
 */
window.createConfetti = function(count = 50) {
    const container = document.createElement('div');
    container.className = 'confetti-container';
    document.body.appendChild(container);

    const colors = ['#2563eb', '#3b82f6', '#60a5fa', '#a855f7', '#ec4899', '#22c55e', '#fbbf24', '#ef4444'];

    for (let i = 0; i < count; i++) {
        const piece = document.createElement('div');
        piece.className = 'confetti-piece';
        piece.style.left = Math.random() * 100 + '%';
        piece.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        piece.style.animationDelay = Math.random() * 2 + 's';
        piece.style.animationDuration = (Math.random() * 2 + 2) + 's';
        piece.style.transform = `rotate(${Math.random() * 360}deg)`;

        if (Math.random() > 0.5) {
            piece.style.borderRadius = '50%';
        }

        container.appendChild(piece);
    }

    setTimeout(() => container.remove(), 5000);
};

/**
 * Sparkle Helper
 */
window.createSparkles = function(element, count = 8) {
    const rect = element.getBoundingClientRect();

    for (let i = 0; i < count; i++) {
        const sparkle = document.createElement('div');
        sparkle.className = 'sparkle';
        sparkle.style.left = (rect.left + Math.random() * rect.width) + 'px';
        sparkle.style.top = (rect.top + Math.random() * rect.height) + 'px';
        sparkle.style.animationDelay = Math.random() * 1 + 's';
        sparkle.style.background = Math.random() > 0.5 ? '#60a5fa' : '#a855f7';
        document.body.appendChild(sparkle);

        setTimeout(() => sparkle.remove(), 2000);
    }
};

/**
 * Smooth Number Counter
 */
window.animateCounter = function(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = Math.round(target);
            clearInterval(timer);
        } else {
            element.textContent = Math.round(start);
        }
    }, 16);
};

