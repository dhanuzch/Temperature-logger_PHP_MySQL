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

$temperature = '';
$humidity = '';

// Writing a mysql query to retrieve data  
$sql = "SELECT * FROM dht11
ORDER BY id DESC 
LIMIT 0,5"; 

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {

	$temperature = $temperature . '"'. $row['temperature'].'",';
	$humidity = $humidity . '"'. $row['humidity'] .'",';
}

$temperature = trim($temperature,",");
$humidity = trim($humidity,","); 

?> 

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="30" >
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<title>DHT11 data</title>

		<style type="text/css">			
			body{
				font-family: Arial;
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #555652;
			}

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>

	</head>

	<body>	   

	    <div class="container">	
	    <h1>USE CHART.JS WITH MYSQL DATASETS</h1>       
			<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'line',
		        data: {
		            
		            datasets: 
		            [{
		                label: 'Temperature',
		                data: [<?php echo $temperature; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(255,99,132)',
		                borderWidth: 3
		            },

		            {
		            	label: 'humidity',
		                data: [<?php echo $humidity; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,255,255)',
		                borderWidth: 3	
		            }]
		        },
		     
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
		    });
			</script>
	    </div>
	    
	</body>
</html>
