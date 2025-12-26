<?php
// Simple bootstrap check
$bootstrapPaths = [__DIR__ . '/../src/bootstrap.php'];
foreach ($bootstrapPaths as $path) { if (file_exists($path)) { require_once $path; break; } }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag River Revival - Drag River Creative</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://dragriver.ca/public/styles.css">
    <style>
        .event-hero {
            text-align: center;
            padding: 4rem 1rem;
            background: linear-gradient(180deg, rgba(0,212,255,0.1) 0%, rgba(15,15,35,0) 100%);
            border-radius: 20px;
            margin-bottom: 3rem;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .info-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }
        .info-icon { font-size: 2rem; margin-bottom: 1rem; display: block; }
        .info-title { color: #00d4ff; font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem; }
        .info-list { list-style: none; opacity: 0.9; line-height: 1.6; }
        .info-list li { margin-bottom: 0.5rem; display: flex; align-items: flex-start; gap: 0.5rem; }
        .info-list li::before { content: '•'; color: #5b86e5; }
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
                <li><a href="index.php" class="back-button">← Back to Events</a></li>
            </ul>
        </nav>
    </header>

    <main style="margin-top: 80px; padding: 2rem; max-width: 1200px; margin-left: auto; margin-right: auto;">
        
        <div class="event-hero fade-in">
            <h1 class="page-title">Drag River Revival</h1>
            <p class="page-subtitle">The Annual Lazy River Tubing Experience</p>
            <span class="status-badge">Summer 2026</span>
        </div>

        <div class="info-grid">
            <!-- The Route -->
            <div class="info-card fade-in">
                <span class="info-icon">🗺️</span>
                <h3 class="info-title">The Route</h3>
                <p>A relaxing float down the historic Drag River.</p>
                <br>
                <ul class="info-list">
                    <li><strong>Start:</strong> The Dam</li>
                    <li><strong>Finish:</strong> Bridge on Fred Jones Rd</li>
                    <li><strong>Duration:</strong> Approx. 2-3 Hours</li>
                    <li><strong>Shuttle:</strong> Service available from finish back to start.</li>
                </ul>
            </div>

            <!-- The Vibe -->
            <div class="info-card fade-in">
                <span class="info-icon">🎵</span>
                <h3 class="info-title">Entertainment & Vibe</h3>
                <p>It's not just a float, it's a celebration.</p>
                <br>
                <ul class="info-list">
                    <li><strong>Pit Stops:</strong> Community hosted stops along the river banks.</li>
                    <li><strong>Destination:</strong> Live Music & DJ all day until late.</li>
                    <li><strong>Atmosphere:</strong> Family friendly by day, party by night.</li>
                </ul>
            </div>

            <!-- Rules -->
            <div class="info-card fade-in">
                <span class="info-icon">⚠️</span>
                <h3 class="info-title">Important Rules</h3>
                <p>Help us keep the river clean and safe for everyone.</p>
                <br>
                <ul class="info-list">
                    <li><strong>NO GLASS:</strong> Strictly prohibited on the river.</li>
                    <li><strong>BYOB:</strong> Allowed (Cans/Plastic only).</li>
                    <li><strong>Respect:</strong> Leave no trace. Pack out what you pack in.</li>
                </ul>
            </div>
        </div>

        <div style="text-align: center; margin-top: 4rem;">
            <a href="https://dragriver.ca/#contact" class="cta-button">Get Notified When Tickets Drop</a>
        </div>

    </main>
    <script src="https://dragriver.ca/public/script.js"></script>
</body>
</html>