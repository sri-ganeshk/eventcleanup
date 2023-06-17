<?php
  // Set connection variables
    $server ="localhost";
    $username = "id20261857_root";
    $password  = "Gan_123456789";
    $db_name = "id20261857_localhost";
    
    $con =new mysqli($server,$username,$password,$db_name);
    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    
 $sql = "SELECT * FROM trip WHERE date >= NOW() ORDER BY date ASC";
 $search = '';
  if (isset($_GET['search'])) {
    $search = $_GET['search'];
  }
  
  $sql = "SELECT * FROM trip WHERE date >= NOW() AND (name LIKE '%$search%' OR location LIKE '%$search%' OR zip LIKE '%$search%') ORDER BY date ASC";
  $all_events = $con->query($sql);
// $all_events = $con->query($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>EventCleanup </title>
    <link rel = "icon" href = "logom.jpg"  type = "image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha384-z3qUNxM3+TSv2ZsFjXhN2MH4lN4NfYjZXW8NcO/7SgWCJjK0DP/Lo8HkUKPV82Pn" crossorigin="">
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha384-RU6j/dTwY7GevbLZxV7jKdRZU6JwnD9Xtnq7VU+cnfUJ7YUezMCzJ+t7VfFYmRmC" crossorigin=""></script>
  <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
  </head>
  <body>
    <header>
        <img class ="i"src="logom.jpg" >
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
  <input type="text" name="search">
  <input type="submit" value="Search">
</form>
    <button ><a href="page.php" id="add-event"  >Add an Event</a></button>
    <main>
      <?php
      while($row = mysqli_fetch_assoc($all_events)){
      ?>
    <div class="event-container">
      <h1 class="event-title"><?php echo $row["name"]?></h1>
      <div class="event-info">
        <p><span>Location:</span> <?php echo $row["location"]?></p>
        <p><span>Date and Time:</span> <?php echo $row["date"]?></p>
        <p><span>Zip:</span> <?php echo $row["zip"]?></p>
        <p><span>Phone:</span><?php echo $row["phone"]?></p>
       <p> <?php echo "<a target='_blank' href='".$row['map']."'>Google Map Location</a>"; ?> </p>
       <!--<p><?php echo $map["map"]; ?></p>-->
      </div>
      <p><?php echo $row["des"]?></p>
      <br><hr><br>
    </div>
    <?php
      }
  ?>
  </main>
  <br> <br><br>
  <div id="map" style="height: 400px;"></div>
   <br><br><hr><br><br>
   <script>
  // Initialize Leaflet map
  var mymap = L.map('map').setView([51.505, -0.09], 13);

  // Add a TileLayer (base map) to the map
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18,
  }).addTo(mymap);

  // Loop over all events and add a marker to the map for each
  <?php while($row = mysqli_fetch_assoc($all_events)) { ?>
    L.marker([<?php echo $row["lat"]?>, <?php echo $row["lng"]?>])
      .bindPopup("<?php echo $row["name"]?>")
      .addTo(mymap);
  <?php } ?>
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
  </body>
  
  <footer>
    <div class="container">
      <div class="footer-logo">
        <img src="logo.png" alt="Logo">
      </div>
      <div class="footer-info">
          <p><b>Centre for Engineering and Education Research
Vignan's Institute of Information Technology (A), Visakhapatnam</b></p>
        <p>K N SRI GANESH 22L31A0596</p>
        <p>L ABHIRAM 22L31A05B0</p>
        <p>P SUDEEP REDDY 22L31A05E9</p>
        <p>M.MANEESH 22L31A05B7</p>
        <p>M JAYENDRA 22L31A05C1</p>
      </div>
    </div>
  </footer>
</html>
