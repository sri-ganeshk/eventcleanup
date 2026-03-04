<?php
/**
 * event.php — Events listing with search
 * Uses MongoDB instead of MySQL
 */
require_once __DIR__ . '/config.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$now = new MongoDB\BSON\UTCDateTime(time() * 1000);

// Build filter — search across name, location, zip
if ($search !== '') {
    $regex = new MongoDB\BSON\Regex($search, 'i');
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
<html>
  <head>
    <meta charset="UTF-8">
    <title>EventCleanup — Events</title>
    <link rel="icon" href="logom.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin=""></script>
  </head>
  <body>
    <header>
      <img class="i" src="logom.jpg">
      <h1>EventCleanup</h1>
    </header>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="event.php">Events</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
    <br><br>
    <form action="event.php" method="get">
      <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by name, location or pincode…">
      <input type="submit" value="Search">
    </form>
    <button><a href="page.php" id="add-event">Add an Event</a></button>
    <main>
      <?php if (empty($all_events)): ?>
        <p style="text-align:center;color:#666;">No upcoming events found.</p>
      <?php endif; ?>
      <?php foreach ($all_events as $row): ?>
        <?php
          $date = $row['date'] instanceof MongoDB\BSON\UTCDateTime
            ? $row['date']->toDateTime()->format('Y-m-d H:i')
            : $row['date'];
        ?>
        <div class="event-container">
          <h1 class="event-title"><?= htmlspecialchars($row['name']) ?></h1>
          <div class="event-info">
            <p><span>Location:</span> <?= htmlspecialchars($row['location']) ?></p>
            <p><span>Date and Time:</span> <?= htmlspecialchars($date) ?></p>
            <p><span>Zip:</span> <?= htmlspecialchars($row['zip']) ?></p>
            <p><span>Phone:</span> <?= htmlspecialchars($row['phone']) ?></p>
            <?php if (!empty($row['map'])): ?>
              <p><a target="_blank" href="<?= htmlspecialchars($row['map']) ?>">Google Map Location</a></p>
            <?php endif; ?>
          </div>
          <p><?= htmlspecialchars($row['des'] ?? '') ?></p>
          <br><hr><br>
        </div>
      <?php endforeach; ?>
    </main>

    <div id="map" style="height: 400px;"></div>
    <br><br><hr><br><br>

    <script>
      var mymap = L.map('map').setView([20.2961, 85.8245], 5);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(mymap);

      // Add markers for events that have lat/lng
      var events = <?php
        $markers = [];
        foreach ($all_events as $row) {
          if (!empty($row['lat']) && !empty($row['lng'])) {
            $markers[] = [
              'lat'  => (float)$row['lat'],
              'lng'  => (float)$row['lng'],
              'name' => $row['name'],
            ];
          }
        }
        echo json_encode($markers);
      ?>;

      events.forEach(function(e) {
        L.marker([e.lat, e.lng]).bindPopup(e.name).addTo(mymap);
      });
    </script>

    <section id="contact">
      <h2>Contact Us</h2>
      <form>
        <label for="name">Name:</label>
        <input type="text" id="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" required>
        <label for="message">Message:</label>
        <textarea id="message" required></textarea>
        <button type="submit">Submit</button>
      </form>
    </section>
    <footer>
      <div class="container">
        <div class="footer-logo">
          <img src="logo.png" alt="Logo">
        </div>
        <div class="footer-info">
          <p><b>Centre for Engineering and Education Research<br>Vignan's Institute of Information Technology (A), Visakhapatnam</b></p>
          <p>K N SRI GANESH 22L31A0596</p>
          <p>L ABHIRAM 22L31A05B0</p>
          <p>P SUDEEP REDDY 22L31A05E9</p>
          <p>M.MANEESH 22L31A05B7</p>
          <p>M JAYENDRA 22L31A05C1</p>
        </div>
      </div>
    </footer>
  </body>
</html>
