<?php
/**
 * page.php — Add a new cleanup event
 * Uses MongoDB instead of MySQL
 */
require_once __DIR__ . '/config.php';

$insert  = false;
$error   = '';

if (isset($_POST['name'])) {
    $name     = trim($_POST['name']);
    $location = trim($_POST['location']);
    $dateStr  = trim($_POST['date']);
    $zip      = trim($_POST['zip']);
    $phone    = trim($_POST['phone']);
    $map      = trim($_POST['map']);
    $desc     = trim($_POST['desc']);

    // Convert the datetime-local string to MongoDB UTCDateTime
    try {
        $dateObj  = new DateTime($dateStr);
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

    if ($result->getInsertedId()) {
        $insert = true;
    } else {
        $error = "Something went wrong, please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>EventCleanup — Add Event</title>
    <link rel="icon" href="logom.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
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
      </ul>
    </nav>
    <div class="container">
      <br><br><br>

      <?php if ($insert): ?>
        <p style="color:green;text-align:center;font-size:20px;">✅ Event submitted successfully! <a href="event.php">View Events</a></p>
      <?php elseif ($error): ?>
        <p style="color:red;text-align:center;"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <script>
        function validateForm() {
          var name     = document.forms["eventForm"]["name"].value;
          var location = document.forms["eventForm"]["location"].value;
          var date     = document.forms["eventForm"]["date"].value;
          var zip      = document.forms["eventForm"]["zip"].value;
          var phone    = document.forms["eventForm"]["phone"].value;
          var desc     = document.forms["eventForm"]["desc"].value;

          if (!name || !location || !date || !zip || !phone || !desc) {
            alert("All fields must be filled out");
            return false;
          }
          var today       = new Date();
          var enteredDate = new Date(date);
          if (enteredDate < today) {
            alert("Date must be in the future");
            return false;
          }
          return true;
        }
      </script>

      <form action="page.php" method="post" name="eventForm" onsubmit="return validateForm()">
        <input type="text"           name="name"     id="name"     placeholder="Event Name" required>
        <label for="date">Event Date:</label>
        <input type="datetime-local" name="date"     id="date"     required>
        <input type="text"           name="location" id="location" placeholder="Event Location" required>
        <input type="number"         name="zip"      id="zip"      placeholder="Event Pincode" required>
        <input type="tel"            name="phone"    id="phone"    placeholder="Contact Number" required>
        <input type="url"            name="map"      id="map"      placeholder="Google Map location URL">
        <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
        <button class="btn" type="submit">Submit</button>
      </form>
    </div>
  </body>
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
</html>
