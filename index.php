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
 $all_events = $con->query($sql);
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
  </head>
  <body>
    <header>
        <img class ="i"src="logom.jpg" >
      <h1>EventCleanup</h1>
      
    </header>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="event.php">Events</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
    <main>
      <section id="home">
        <h2>Welcome to EventCleanup</h2>
        <p>We're dedicated to organizing community cleanups to make our neighborhoods a better place for everyone.</p>
      </section>
      <br><hr><br>
      <section id="about">
        <h2>About Us</h2>
        <p>EventCleanup is a collage project that was made in 2023. We believe that by working together, we can make a positive impact on our communities.</p>
      </section>
      <br><hr><br>
      
      <section id="events">
        <h2>Upcoming Cleanups</h2>
        <ul>
            <main>
      <?php
      while($row = mysqli_fetch_assoc($all_events)){
      ?>
          <li><?php echo $row["date"]?>  :  <?php echo $row["location"]?>  :  <?php echo $row["name"]?></li>
          <?php
      }
  ?>
        </ul>
      </section>
      <br><hr><br>
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
      <br><hr><br>
      <section>
        <h2>Why Clean Our Public Places?</h2>
        <p>
          <img src="https://www.aucklandcouncil.govt.nz/Lists/ParksDetailImages/kell-park-path-stump.jpg?width=759&height=416" alt="A park with clean paths and picnic tables">
        </p>
        <p>Public places, such as parks, streets, and beaches, are important areas where people gather and socialize. Keeping these spaces clean and well-maintained is crucial for the health and well-being of the community and the environment.</p>
        <p>Litter, debris, and other waste can attract pests, harm wildlife, and even contaminate water sources. Cleaning up public spaces can prevent these negative consequences and create a safer, healthier, and more enjoyable environment for everyone.</p>
      </section>
      <br><hr><br>
      <section>
        <h2>Why Participate in Cleanup Events?</h2>
        <p>
          <img src="https://media.gettyimages.com/id/84423012/photo/young-people-collecting-garbage-on-beach.jpg?s=612x612&w=0&k=20&c=q1OUNqbRm1TrLkq_0RAsS0y8G3Qtm2mdphL4DZ0QlVU=" alt="A group of people cleaning a beach together">
        </p>
        <p>Participating in public cleanup events is a great way to make a positive impact on the community and the environment. By working together with others, you can make a big difference in just a short amount of time.</p>
        <p>Not only will you help keep public spaces clean and safe, but you will also show your support for environmental conservation and sustainability. Plus, participating in cleanup events can be a fun and rewarding experience, allowing you to meet new people, learn new skills, and make a positive impact in your community.</p>
      </section>
      
      
    </main>
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

  </body>
</html>
