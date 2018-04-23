<?php

require('db_config.php');
	/* Getting demo_viewer table data */

	$sql = "SELECT SUM(numberofview) as count FROM demo_viewer 

            //GROUP BY YEAR(created_at) ORDER BY created_at";
            
    //$sensor_name = $database->sqlRequest("SELECT sensorNamePerso FROM usersensor WHERE usersensor.sensorId = ".$_GET['id']." AND usersensor.typeId= ".$_GET['typeID'] , "sensorNamePerso");
    //$cond = "WHERE sensorId=".$_GET['id']." AND typeId= ".$_GET['typeID']."  AND date >= DATE_ADD(now(),INTERVAL -1 DAY) ORDER BY date DESC";
    $cond = "SELECT date1  as count FROM historysensor WHERE sensorId=28 AND typeId=9  ORDER BY date1 DESC";
    //$value = $database->sqlRequest("SELECT value FROM historysensor ".$cond, "value");
    //$date = $database->sqlRequest("SELECT date FROM historysensor ".$cond, "date");

    $result = mysqli_query($mysqli,$cond);
    
	$result = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $result = json_encode(array_column($result, 'count'),JSON_NUMERIC_CHECK);

   // echo $result;

    $cond = "SELECT value1  as count FROM historysensor WHERE sensorId=28 AND typeId=9  ORDER BY date1 DESC";
    //$value = $database->sqlRequest("SELECT value FROM historysensor ".$cond, "value");
    //$date = $database->sqlRequest("SELECT date FROM historysensor ".$cond, "date");

    $result2 = mysqli_query($mysqli,$cond);
    
	$result2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);

    $result2 = json_encode(array_column($result2, 'count'),JSON_NUMERIC_CHECK);

   // echo $result2;

/*

	$viewer = mysqli_query($mysqli,$sql);

	$viewer = mysqli_fetch_all($viewer,MYSQLI_ASSOC);

	$viewer = json_encode(array_column($viewer, 'count'),JSON_NUMERIC_CHECK);


	/* Getting demo_click table data */

/*	$sql = "SELECT SUM(numberofclick) as count FROM demo_click 

			//GROUP BY YEAR(created_at) ORDER BY created_at";

	$click = mysqli_query($mysqli,$sql);

    $click = mysqli_fetch_all($click,MYSQLI_ASSOC);
    
	$click = json_encode(array_column($click, 'count'),JSON_NUMERIC_CHECK);*/

    //$array1 = array(1477526400000, 2);
   // $array2 = array(1481846400000, 4);
    //$array3 = array(1485302400000, 6);
    //$data1 = array($array1,$array2,$array3);
//$data = json_encode($data1);
    //echo $click;
    $array1=array();
    $resolv=array();
    $tab = "SELECT date1, value1 FROM historysensor WHERE sensorId=28 AND typeId=9  ORDER BY date1 ASC";
    $resolv = mysqli_query($mysqli, $tab);
    /*if (mysqli_num_rows($resolv) > 0)
{
     // output data of each row
     while($row = mysqli_fetch_array($resolv))
     {
         echo "valeur: " . $row["value1"]. " - date: " . $row["date1"]. "<br>";
     }
}
else
{
     echo "0 results";
}*/
 
while($row = mysqli_fetch_array($resolv))
{
    $xdata[]= $row["value1"];
    $ydata[]= $row["date1"];
}


 

    //echo $xdata;
    //echo $ydata;
    $data1 =array($xdata,$ydata);
    $data2 = json_encode($data1);
    echo $data2;
?>


<!DOCTYPE html>

<html>

<head>

	<title>HighChart</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

	<script src="https://code.highcharts.com/highcharts.js"></script>

</head>

<body>


<script type="text/javascript">


$(function () { 



    var data3 = <?php echo $data2; ?>;


    $('#container').highcharts({

        chart: {

            type: 'line'

        },

        title: {

            text: 'Courbe de suivi'

        },

        xAxis: {

            //categories: ['2013','2014','2015', '2016']
            type: 'datetime'

        },

        yAxis: {

            title: {

                text: 'valeur'

            }

        },

        series: [{

            name: 'result',

            //data: data_click
            data: data3

        }, /*{

            name: 'result',

            data: data3

        }*/]

    });

});


</script>


<div class="container">

	<br/>

	<h2 class="text-center">Highcharts </h2>

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading ">Dashboard</div>

                <div class="panel-body">

                    <div id="container"></div>

                </div>

            </div>

        </div>

    </div>

</div>


</body>

</html>