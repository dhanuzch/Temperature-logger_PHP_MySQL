
<?php 
// Server credentials  
$servername = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "dht11-test"; 

$conn = new mysqli($servername, $username, $password, $dbname); 
 
// Checking mysql connection 
if ($conn->connect_error) { 
  die("Connection failed: " . $conn->connect_error); 
} 
 
// Writing a mysql query to retrieve data  
$sql = "SELECT ID, humidity, temperature,time FROM dht11 
ORDER BY id DESC 
LIMIT 0,1 "; 

$result = $conn->query($sql); 

if ($result->num_rows > 0) { 
    // Show each data returned by mysql 
    while($row = $result->fetch_assoc()) { 

?> 
	 <meta http-equiv="refresh" content="30" > 
	<!-- USING HTML HERE : Here I am using php within html tags --> 
    <p> Humidity: <?php echo $row["humidity"]; ?> </p> 
    <p> Temperature: <?php echo $row["temperature"]; ?> </p> 
    <p> Time: <?php echo $row["time"]; ?> </p>
    
 
<?php 
  } 
} else { 
  echo "0 results"; 
} 
 
// Closing mysql connection 
$conn->close(); 
?> 