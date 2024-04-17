<div id="container" style="min-width: 610px; height: 400px; max-width: 900px; margin: 0 auto"></div>
<?php
require_once 'connection.php';
try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
        "SELECT DATE_FORMAT(date_of_payment, '%Y-%m') as month, DATE_FORMAT(date_of_payment, '%Y-%m-%d') as day, SUM(price) as amount_value
         FROM payment WHERE event_type = 'Blessing' and date_of_payment >= '".$_REQUEST["DateFrom"]."' AND date_of_payment <= '".$_REQUEST["DateTo"]."'
         GROUP BY month, day"
    );
    $stmt->execute();
		$data = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$month = $row['month'];
        $day = $row['day'];
        $amount_value = (int)$row['amount_value'];
		
		if (!isset($data[$month])) {
		$data[$month] = array(
			'name' => $month,
			'visible' => true,
			'data' => array()
		);
	}

	$data[$month]['data'][] = array($day, $amount_value);
		}
	} catch (PDOException $e) {
	echo $e->getMessage();
	}
?>


<script type="text/javascript">
    // Prepare the data for the chart
    var chartData = <?php echo json_encode(array_values($data)); ?>;

    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Daily Blessing Graph'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total Blessing Income'
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },
        series: chartData,
        drilldown: {
            series: []
        }
    });