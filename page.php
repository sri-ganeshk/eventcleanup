<?php
/**
 * page.php — Add a new cleanup event
 */
require_once __DIR__ . '/config.php';

$insert = false;
$error  = '';

if (isset($_POST['name'])) {
    $name     = trim($_POST['name']);
    $location = trim($_POST['location']);
    $dateStr  = trim($_POST['date']);
    $zip      = trim($_POST['zip']);
    $phone    = trim($_POST['phone']);
    $map      = trim($_POST['map']);
    $desc     = trim($_POST['desc']);

    try {
        $dateObj   = new DateTime($dateStr);
        $mongoDate = new MongoDB\BSON\UTCDateTime($dateObj->getTimestamp() * 1000);
    } catch (Exception $e) {
        $mongoDate = null;
    }

    $result = $db->trips->insertOne([
        'name'     => $name,
        'location' => $location,
        'date'     => $mongoDate,
        'zip'      => $zip,
        'phone'    => $phone,
        'map'      => $map,
        'des'      => $desc,
        'lat'      => null,
        'lng'      => null,
        'dt'       => new MongoDB\BSON\UTCDateTime(),
    ]);

    $insert = (bool) $result->getInsertedId();
    if (!$insert) $error = "Something went wrong — please try again.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventCleanup — Add Event</title>
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
        <a href="event.php">Events</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="section form-section">
      <h1>Add a Cleanup Event</h1>
      <p class="form-subtitle">Fill in the details below and your event will appear on the listing page.</p>

      <?php if ($insert): ?>
        <div class="alert alert-success">✅ Event submitted! <a href="event.php">View all events →</a></div>
      <?php elseif ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form class="add-form" action="page.php" method="post" name="eventForm" onsubmit="return validateForm()">
        <label>Event Name
          <input type="text" name="name" placeholder="e.g. Marina Beach Cleanup" required>
        </label>
        <label>Event Date &amp; Time
          <input type="datetime-local" name="date" required>
        </label>
        <label>Location
          <input type="text" name="location" placeholder="e.g. Marina Beach, Chennai" required>
        </label>
        <label>Pincode
          <input type="number" name="zip" placeholder="e.g. 600001" required>
        </label>
        <label>Contact Number
          <input type="tel" name="phone" placeholder="e.g. 9876543210" required>
        </label>
        <label>Google Maps URL <span class="optional">(optional)</span>
          <input type="url" name="map" placeholder="https://maps.google.com/...">
        </label>
        <label>Additional Info <span class="optional">(optional)</span>
          <textarea name="desc" rows="5" placeholder="What to bring, who to contact, etc."></textarea>
        </label>
        <button class="btn-primary" type="submit">Submit Event</button>
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

  <script>
    function validateForm() {
      var f = document.forms["eventForm"];
      if (!f["name"].value || !f["location"].value || !f["date"].value ||
          !f["zip"].value  || !f["phone"].value) {
        alert("Please fill in all required fields.");
        return false;
      }
      if (new Date(f["date"].value) < new Date()) {
        alert("Date must be in the future.");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
