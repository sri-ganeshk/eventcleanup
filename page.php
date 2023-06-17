<?php
$insert = false;
if(isset($_POST['name'])){
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
    echo "Succesfully Event Sumbited";

    // Collect post variables
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $map = $_POST['map'];
    $desc = $_POST['desc'];
    $sql = "INSERT INTO `id20261857_localhost`.`trip` (`name`, `date`, `location`, `zip`, `phone`,`map`, `des`, `dt`) VALUES ('$name', '$date', '$location', '$zip', '$phone','$map', '$desc', current_timestamp());";
    //echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
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
            <li><a href="index.php">Home</a></li>
            <li><a href="event.php">Events</a></li>
          </ul>
        </nav>
<body>
    <div class="container">
        <br><br><br>
        <script>
function validateForm() {
  var name = document.forms["eventForm"]["name"].value;
  var location = document.forms["eventForm"]["location"].value;
  var date = document.forms["eventForm"]["date"].value;
  var zip = document.forms["eventForm"]["zip"].value;
  var phone = document.forms["eventForm"]["phone"].value;
  var desc = document.forms["eventForm"]["desc"].value;

  if (name == "" || location == "" || date == "" || zip == "" || phone == "" || desc == "" || map =="") {
    alert("All fields must be filled out");
    return false;
  }
   var today = new Date();
  var enteredDate = new Date(date);

  if (enteredDate < today) {
    alert("Date must be in the future");
    return false;
  }
  return true;
}
</script>

<form action="page.php" method="post" name="eventForm" onsubmit="return validateForm()" >
  <input type="text" name="name" id="name" placeholder="Event Name">
  <label for="date">Event Date:</label>
  <input type="datetime-local" name="date" id="date" placeholder="Date of the Event">
  <input type="text" name="location" id="location" placeholder="Event Location">
  <input type="number" name="zip" id="zip" placeholder="Event Pincode">
  <input type="phone" name="phone" id="phone" placeholder="Contact Number">
  <input type="link" name="map" id="map" placeholder="Google Map location URL">
  <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
  <button class="btn">Submit</button> 
</form>
 
        </form>
    </div>
   
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
