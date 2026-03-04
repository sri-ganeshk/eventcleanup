<?php
/**
 * index.php — Home page
 */
require_once __DIR__ . '/config.php';

$now        = new MongoDB\BSON\UTCDateTime(time() * 1000);
$all_events = $db->trips->find(
    ['date' => ['$gte' => $now]],
    ['sort' => ['date' => 1], 'limit' => 3]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventCleanup — Community Cleanups</title>
  <link rel="icon" href="logom.jpg" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="header-inner">
      <div class="logo-wrap">
        <img src="logom.jpg" alt="EventCleanup logo" class="logo">
        <span class="brand">EventCleanup</span>
      </div>
      <nav>
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="event.php">Events</a>
        <a href="#contact">Contact</a>
      </nav>
    </div>
  </header>

  <main>

    <!-- Hero -->
    <section class="hero" id="home">
      <h1>Clean Up. <span>Come Together.</span></h1>
      <p>Join community cleanup events in your area and make a real difference in your neighbourhood.</p>
      <a href="event.php" class="btn-primary">Browse Events</a>
    </section>

    <!-- Upcoming previews -->
    <section class="section" id="events">
      <h2>Upcoming Cleanups</h2>
      <ul class="preview-list">
        <?php foreach ($all_events as $row):
          $date = $row['date'] instanceof MongoDB\BSON\UTCDateTime
            ? $row['date']->toDateTime()->format('d M Y')
            : $row['date'];
        ?>
          <li>
            <span class="preview-date"><?= htmlspecialchars($date) ?></span>
            <span class="preview-name"><?= htmlspecialchars($row['name']) ?></span>
            <span class="preview-loc">📍 <?= htmlspecialchars($row['location']) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <a href="event.php" class="btn-outline">See all events →</a>
    </section>

    <!-- About -->
    <section class="section" id="about">
      <h2>About Us</h2>
      <p>EventCleanup is a college project born in 2023. We believe small actions — picking up litter, organizing a beach cleanup, clearing a park — add up to a healthier, happier community for everyone.</p>
    </section>

    <!-- Why section -->
    <section class="section why-grid">
      <div class="why-card">
        <div class="why-icon">🌍</div>
        <h3>Protect the Environment</h3>
        <p>Litter attracts pests, harms wildlife and contaminates water. A clean neighbourhood is a healthy one.</p>
      </div>
      <div class="why-card">
        <div class="why-icon">🤝</div>
        <h3>Build Community</h3>
        <p>Cleanup events bring people together. Meet neighbours, learn new skills and take collective pride in your area.</p>
      </div>
      <div class="why-card">
        <div class="why-icon">✅</div>
        <h3>Make an Impact</h3>
        <p>Even a few hours of your time can transform a public space and inspire others to do the same.</p>
      </div>
    </section>

    <!-- Contact -->
    <section class="section" id="contact">
      <h2>Contact Us</h2>
      <form class="contact-form">
        <input type="text" placeholder="Your name" required>
        <input type="email" placeholder="Your email" required>
        <textarea rows="5" placeholder="Your message" required></textarea>
        <button type="submit" class="btn-primary">Send Message</button>
      </form>
    </section>

  </main>

  <footer>
    <div class="footer-inner">
      <p><strong>EventCleanup</strong><br>
      A community cleanup event platform built with PHP & MongoDB.</p>
      <p style="margin-top:8px;opacity:.7;font-size:13px;">Designed to bring people together for a cleaner environment.</p>
    </div>
  </footer>
</body>
</html>
