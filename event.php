<?php
/**
 * event.php — Events listing with search
 */
require_once __DIR__ . '/config.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$now    = new MongoDB\BSON\UTCDateTime(time() * 1000);

if ($search !== '') {
    $regex  = new MongoDB\BSON\Regex($search, 'i');
    $filter = [
        'date' => ['$gte' => $now],
        '$or'  => [
            ['name'     => $regex],
            ['location' => $regex],
            ['zip'      => $regex],
        ],
    ];
} else {
    $filter = ['date' => ['$gte' => $now]];
}

$all_events = iterator_to_array(
    $db->trips->find($filter, ['sort' => ['date' => 1]])
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventCleanup — Events</title>
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
        <a href="index.php">Home</a>
        <a href="event.php" class="active">Events</a>
      </nav>
    </div>
  </header>

  <main>
    <div class="page-top">
      <h1>Upcoming Events</h1>
      <form class="search-form" action="event.php" method="get">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by name, location or pincode…">
        <button type="submit">Search</button>
      </form>
      <a href="page.php" class="btn-primary">+ Add Event</a>
    </div>

    <?php if (empty($all_events)): ?>
      <div class="empty-state">
        <p>🌿 No upcoming events found<?= $search ? ' for "<strong>' . htmlspecialchars($search) . '</strong>"' : '' ?>.</p>
        <a href="page.php" class="btn-primary">Be the first to add one</a>
      </div>
    <?php else: ?>
      <div class="events-grid">
        <?php foreach ($all_events as $row): ?>
          <?php
            $date = $row['date'] instanceof MongoDB\BSON\UTCDateTime
              ? $row['date']->toDateTime()->format('d M Y, g:i A')
              : $row['date'];
          ?>
          <div class="event-card">
            <h2><?= htmlspecialchars($row['name']) ?></h2>
            <div class="event-meta">
              <span class="tag">📍 <?= htmlspecialchars($row['location']) ?></span>
              <span class="tag">🗓 <?= htmlspecialchars($date) ?></span>
              <span class="tag">📮 <?= htmlspecialchars($row['zip']) ?></span>
              <span class="tag">📞 <?= htmlspecialchars($row['phone']) ?></span>
            </div>
            <?php if (!empty($row['des'])): ?>
              <p class="event-desc"><?= htmlspecialchars($row['des']) ?></p>
            <?php endif; ?>
            <?php if (!empty($row['map'])): ?>
              <a class="map-link" href="<?= htmlspecialchars($row['map']) ?>" target="_blank">View on Google Maps →</a>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
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
