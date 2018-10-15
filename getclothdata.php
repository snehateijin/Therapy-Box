<?php 
$result = file_get_contents('https://therapy-box.co.uk/hackathon/clothing-api.php?username=swapnil');
$clothData = json_decode($result, true);
$payload = $clothData['payload'];
$dressCounts = array_count_values(
    array_column($payload, 'clothe')
);
$chartData = [];
foreach($dressCounts as $key => $value){
	$indChartData['x'] = $key; 
	$indChartData['value'] = $value; 
	$chartData[] = $indChartData;
}
echo json_encode($chartData);
?>