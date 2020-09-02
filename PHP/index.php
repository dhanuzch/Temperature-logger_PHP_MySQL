<?php  
$servername = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "dht11-test"; 

$conn = new mysqli($servername, $username, $password, $dbname); 



if ($conn->connect_error) { 
  die("Connection failed: " . $conn->connect_error); 
} 

$temperature = '';
$humidity = '';
$time = '';

// fetch  
$sql = "SELECT * FROM dht11
ORDER BY id DESC 
LIMIT 0,20"; 

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {

	$temperature = $temperature . '"'. $row['temperature'].'",';
	$humidity = $humidity . '"'. $row['humidity'] .'",';
	$time = $time . '"'. $row['time'] .'",';
}

$temperature = trim($temperature,",");
$humidity = trim($humidity,","); 
$time = trim($time,","); 

?> 

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="30" >
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        <title>DHT11 data</title>
        
        <!-- columns -->
        <style>
            * {
            box-sizing: border-box;
            }

            /* Create two equal columns that floats next to each other */
            .column {
            float: left;
            width: 50%;
            padding: 10px;

            }

            /* Clear floats after the columns */
            .row:after {
            content: "";
            display: table;
            clear: both;
            }
        </style>

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
    <div class="row">
        <div class="column">
            <div class="chart-container1" style="height:20vh; width:40vw">
                <h1>Temperature</h1>  
                <canvas id="myChart1" style=" height: 65vh; background: #FEFEFE; border: 1px solid #555652; margin-top: 10px;"></canvas>
            </div>
        </div>
    <div class="column">
        <div class="chart-container2" style="height:20vh; width:40vw">
            <h1>Humidity</h1>  
            <canvas id="myChart2" style=" height: 65vh; background: #FEFEFE; border: 1px solid #555652; margin-top: 10px;"></canvas>
        </div>
    </div>
    </div>
    
	<script>
		var ctx = document.getElementById('myChart1').getContext('2d');;
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: [<?php echo $time; ?>],
				datasets: 
				[{
					label: 'Temperature',
					data: [<?php echo $temperature; ?>],
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor:'rgba(255, 99, 132, 1)',
					borderWidth: 3
				}]
			},


			options: {scales: {scales:{
				yAxes: [{display: true, ticks: {
            min: 0,
            max: 400,
            stepSize: 10
        }}], 
				xAxes: [{display:true}]
				}
				},
				tooltips:{mode: 'index'},
				legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
			}
		});
    </script>
	
	    
	<script>
		var ctx = document.getElementById('myChart2').getContext('2d');;
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: [<?php echo $time; ?>],
				datasets: 
				[{
					label: 'humidity',
					data: [<?php echo $humidity; ?>],
					backgroundColor: 'rgba(54, 162, 235, 0.2)',
					borderColor:'rgba(54, 162, 235, 1)',
					borderWidth: 3	
				}]
			},

			
			options: {
				scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
				tooltips:{mode: 'index'},
				legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
			}
		});

	</script>
	    
	</body>
</html>
