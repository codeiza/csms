<?php
require_once 'connection.php';
//print_r($_REQUEST);
try {
	$pdo = new PDO(DSN, DB_USR, DB_PWD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"SELECT sum(amount_value) as donate FROM donation
		WHERE date_of_donation >= '" . $_REQUEST["datefrom"] . "' AND date_of_donation <= '" . $_REQUEST["dateto"] . "'
		"
	);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$donate = $result['donate'];


	$stmt1 = $pdo->prepare(
		"SELECT sum(price)as massoffering FROM payment
		where event_type = 'Mass Offering'
		AND date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "'
		"
	);
	$stmt1->execute();
	$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
	$masso = $result1['massoffering'];

	$stmt1 = $pdo->prepare(
		"SELECT sum(price)as wedding FROM payment
		where event_type = 'Wedding'
		AND date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "'
		"
	);
	$stmt1->execute();
	$result2 = $stmt1->fetch(PDO::FETCH_ASSOC);
	$wedding = $result2['wedding'];

	$stmt1 = $pdo->prepare(
		"SELECT sum(price)as baptism FROM payment
		where event_type = 'Baptismal'
		AND date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "'
		"
	);
	$stmt1->execute();
	$result3 = $stmt1->fetch(PDO::FETCH_ASSOC);
	$baptism = $result3['baptism'];

	$stmt1 = $pdo->prepare(
		"SELECT sum(price)as funeral FROM payment
		where event_type = 'Funeral'
		AND date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "'
		"
	);
	$stmt1->execute();
	$result34 = $stmt1->fetch(PDO::FETCH_ASSOC);
	$funeral = $result34['funeral'];

	$stmt1 = $pdo->prepare(
		"SELECT sum(price)as Mass FROM payment
		where event_type = 'Mass'
		AND date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "'
		"
	);
	$stmt1->execute();
	$result345 = $stmt1->fetch(PDO::FETCH_ASSOC);
	$Mass = $result345['Mass'];

	$stmt1 = $pdo->prepare(
		"SELECT sum(price)as Blessing FROM payment
		where event_type = 'Blessing'
		AND date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "'
		"
	);
	$stmt1->execute();
	$result6 = $stmt1->fetch(PDO::FETCH_ASSOC);
	$Blessing = $result6['Blessing'];

	$stmt2 = $pdo->prepare(
		"SELECT * FROM worship
		"
	);
	$stmt2->execute();
	$cnt = $stmt2->rowCount();
	//pei chart
	$stmt = $pdo->prepare(
		"SELECT * FROM payment WHERE date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "' GROUP BY event_type
		"
	);
	$stmt->execute();
	$data = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$data[] = array(
			'name' => $row['event_type'],
			'y' => (float)$row['price']
		);
	}
	////daily	
	$stmt = $pdo->prepare(
		"SELECT * FROM payment WHERE date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "' GROUP BY date_of_payment
		"
	);
	$stmt->execute();
	$chartData = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$date_of_payment = $row["date_of_payment"];
		$price = $row["price"];

		$dataPoint = array(
			"date_of_payment" => $date_of_payment,
			"price" => $price


		);

		$chartData[] = $dataPoint;
	}
	////Monthly	
	$stmt1 = $pdo->prepare(
		"SELECT 
    CASE 
        WHEN MONTH(date_of_payment) = 1 THEN 'January'
        WHEN MONTH(date_of_payment) = 2 THEN 'February'
        WHEN MONTH(date_of_payment) = 3 THEN 'March'
        WHEN MONTH(date_of_payment) = 4 THEN 'April'
        WHEN MONTH(date_of_payment) = 5 THEN 'May'
        WHEN MONTH(date_of_payment) = 6 THEN 'June'
        WHEN MONTH(date_of_payment) = 7 THEN 'July'
        WHEN MONTH(date_of_payment) = 8 THEN 'August'
        WHEN MONTH(date_of_payment) = 9 THEN 'September'
        WHEN MONTH(date_of_payment) = 10 THEN 'October'
        WHEN MONTH(date_of_payment) = 11 THEN 'November'
        WHEN MONTH(date_of_payment) = 12 THEN 'December'
    END AS month,
    SUM(price) AS total_price,
    event_type
FROM payment  WHERE date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "'
GROUP BY MONTH(date_of_payment)
ORDER BY MONTH(date_of_payment)"
	);
	$stmt1->execute();
	$chartData1 = array();
	while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
		$month = $row1["month"];
		$price1 = $row1["total_price"];
		// $event_type1 = $row1["event_type"];

		$dataPoint1 = array(
			"month" => $month,
			"price1" => $price1


		);

		$chartData1[] = $dataPoint1;
	}

	//// per event_type
	$stmt2 = $pdo->prepare(
		"SELECT * FROM payment  WHERE date_of_payment >= '" . $_REQUEST["datefrom"] . "' AND date_of_payment <= '" . $_REQUEST["dateto"] . "' GROUP BY event_type
		"
	);
	$stmt2->execute();
	while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
		$date_of_payment2 = $row2["date_of_payment"];
		$price2 = $row2["price"];
		$event_type2 = $row2["event_type"];

		$dataPoint2 = array(
			"date_of_payment2" => $date_of_payment2,
			"price2" => $price2,
			"event_type2" => $event_type2


		);

		$chartData2[] = $dataPoint2;
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>
<style>
	.display-3 {
		font-size: 30px;
	}
</style>
<div id="table3">
	<div class="row">
		<div class="col-sm-4">
			<div class="card text-center">
				<div class="header btn-success text-white">
					<div class="row align-items-center">
						<div class="col">
							<img src="image/heart.png" height="60px" />
						</div>
						<div class="col">
							<h3><b>Donation</b></h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<h5>
						<button id="done" class="btn btn-info"> View More <i class="fas fa-angle-right"></i></button>
					</h5>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="card text-center">
				<div class="header btn-info text-white">
					<div class="row align-items-center">
						<div class="col">
							<img src="image/massoffer.png" height="60px" />
						</div>
						<div class="col">

							<h3><b>Mass Offering</b></h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<h5>
						<button id="viewmass" class="btn btn-info"> View More <i class="fas fa-angle-right"></i></button>
					</h5>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="card text-center">
				<div class="header btn-warning text-white">
					<div class="row align-items-center">
						<div class="col">
							<img src="image/wedding.png" height="60px" />
						</div>
						<div class="col">
							<h3><b>Wedding</b></h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<h5>
						<button id="viewwedding" class="btn btn-info"> View More <i class="fas fa-angle-right"></i></button>
					</h5>
				</div>
			</div>
		</div>




	</div>

	<br>
	<div class="row">
		<div class="col-sm-4">
			<div class="card text-center">
				<div class="header btn-primary text-white">
					<div class="row align-items-center">
						<div class="col">
							<img src="image/baptism.png" height="60px" />
						</div>
						<div class="col">
							<h3><b>Baptismal</b></h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<h5>
						<button id="baptismv" class="btn btn-info"> View More <i class="fas fa-angle-right"></i></button>

					</h5>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="card text-center">
				<div class="header btn-danger text-white">
					<div class="row align-items-center">
						<div class="col">
							<img src="image/funeral.png" height="60px" />
						</div>
						<div class="col">
							<h3><b>Funeral</b> </h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<h5>
						<button id="fune" class="btn btn-info"> View More <i class="fas fa-angle-right"></i></button>
					</h5>
				</div>
			</div>
		</div>



		<div class="col-sm-4">
			<div class="card text-center">
				<div class="header btn-success text-white">
					<div class="row align-items-center">
						<div class="col">
							<img src="image/blessing.png" height="60px" />
						</div>
						<div class="col">
							<h3><b>Blessing</b></h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<h5>
						<button id="bless" class="btn btn-info"> View More <i class="fas fa-angle-right"></i></button>
					</h5>
				</div>
			</div>
		</div>


	</div>

	<br>
	<div class="row">
		<div class="col-sm-6">
			<div class="card text-center">
				<div id="chart-container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="card text-center">
				<div id="chart-container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
			</div>
		</div>


	</div>

	<br>
	<div class="row">
		<div class="col-sm-6">
			<div class="card text-center">
				<div id="paymentChart" style="height: 400px;"></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="card text-center">
				<div id="container"></div>
			</div>
		</div>
	</div>

</div>

<div class="row">


	<?php
	$data_json = json_encode($data);
	?>

	<script type="text/javascript">
		Highcharts.chart('container', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Summary',
		style: {
			color: '#333333', // Set title text color
			fontSize: '18px', // Set title font size
			fontWeight: 'bold', // Set title font weight
		}
		
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.1f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				}
			},
			series: [{
				name: 'Collection Summary',
				colorByPoint: true,
				data: <?php echo $data_json; ?> // Insert the JSON data here
			}]
		});

		////chart daily
		var chartData = <?php echo json_encode($chartData); ?>;

		Highcharts.chart('chart-container', {
			chart: {
				type: 'line' // Change type to 'line'
			},
			title: {
				text: 'Daily Source of Funds',
		style: {
			color: '#333333', // Set title text color
			fontSize: '18px', // Set title font size
			fontWeight: 'bold', // Set title font weight
		}
				
			},
			xAxis: {
				categories: chartData.map(item => item.date_of_payment)
			},
			yAxis: {
				title: {
					text: 'Values'
				}
			},
			series: [{
				name: 'Amount',
				data: chartData.map(item => parseInt(item.price))
			}]
		});

		////chart monthly
		var chartData1 = <?php echo json_encode($chartData1); ?>;

    Highcharts.chart('chart-container1', {
        chart: {
            type: 'column', // Change type to 'column' for a column chart
            backgroundColor: '#ffffff', // Set background color
        },
        title: {
            text: 'Monthly Source of Funds',
            style: {
                color: '#333333', // Set title text color
                fontSize: '18px', // Set title font size
                fontWeight: 'bold', // Set title font weight
            }
        },
        xAxis: {
            categories: chartData1.map(item => item.month)
        },
        yAxis: {
            title: {
                text: 'Values',
                style: {
                    color: '#333333', // Set axis label color
                }
            }
        },
        series: [{
            name: 'Amount',
            data: chartData1.map(item => parseInt(item.price1))
        }],
        colors: ['#90ed7d'], // Set column color
    });

		////per event type
		var chartData2 = <?php echo json_encode($chartData2); ?>;

Highcharts.chart('paymentChart', {
	chart: {
		type: 'pie', // Change type to 'pie' for donut chart
		backgroundColor: '#ffffff', // Set background color
	},
	title: {
		text: 'Source Of Funds',
		style: {
			color: '#333333', // Set title text color
			fontSize: '18px', // Set title font size
			fontWeight: 'bold', // Set title font weight
		}
	},
	tooltip: {
		pointFormat: '{series.name}: <b>{point.y}</b>'
	},
	plotOptions: {
		pie: {
			innerSize: '50%', // Set inner size for donut effect
			depth: 45, // Set depth for 3D effect
			stacking: 'normal', // Enable stacking
			dataLabels: {
				enabled: true,
				format: '{point.name}: {point.y}', // Display data labels with value
				style: {
					color: '#333333', // Set data label text color
				}
			}
		}
	},
	series: [{
		name: 'Amount',
		data: chartData2.map(item => ({
			name: item.event_type2,
			y: parseInt(item.price2)
		}))
	}],
	colors: ['#7cb5ec', '#90ed7d', '#f7a35c'], // Set colors for different sections of the donut chart
});
	</script>

</div>