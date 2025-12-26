<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Drag River Creative</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://dragriver.ca/public/styles.css">
    <style>
        .countdown-container {
            text-align: center;
            padding: 4rem 2rem;
        }
        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        .time-block {
            background: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 15px;
            min-width: 120px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        .time-value {
            font-size: 3rem;
            font-weight: 700;
            color: #00d4ff;
            display: block;
        }
        .time-label {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="bg-animation">
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
    </div>

    <header>
        <nav class="nav-container">
            <a href="https://dragriver.ca" class="logo">Drag River</a>
            <ul class="nav-menu">
                <li><a href="https://dragriver.ca" class="back-button">← Back to Home</a></li>
            </ul>
        </nav>
    </header>

    <main style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
        <div class="countdown-container">
            <h1 class="page-title">The Collection</h1>
            <p class="page-subtitle">Premium apparel, fine art prints, and calendars dropping soon.</p>
            
            <div class="countdown-timer" id="countdown">
                <div class="time-block">
                    <span class="time-value" id="days">00</span>
                    <span class="time-label">Days</span>
                </div>
                <div class="time-block">
                    <span class="time-value" id="hours">00</span>
                    <span class="time-label">Hours</span>
                </div>
                <div class="time-block">
                    <span class="time-value" id="minutes">00</span>
                    <span class="time-label">Minutes</span>
                </div>
                <div class="time-block">
                    <span class="time-value" id="seconds">00</span>
                    <span class="time-label">Seconds</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Set launch date: Jan 1, 2026 00:00:00 EST
        // Timestamp: 1767243600 (Jan 1 2026 05:00:00 UTC)
        const launchDate = 1767243600 * 1000;

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = launchDate - now;

            if (distance < 0) {
                document.getElementById('countdown').innerHTML = '<div class="time-block" style="width: 100%; max-width: 500px;"><span class="time-value" style="font-size: 2.5rem;">We are Live!</span><span class="time-label">Shop Now</span></div>';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').innerText = days.toString().padStart(2, '0');
            document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
</body>
</html>