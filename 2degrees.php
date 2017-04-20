<html>
	<head>
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

<body>
	<div id="frame">
		<div id="banner">
		<h1>Two Degrees of Kevin Bacon</h1>
		</div>

	<div id =" main" style="background-color:white; overflow:hidden; width:700px; margin:0 auto;">
<?php

include('common.php');

//fetch query data
$matches = getTwoDegree($db);
$matchesInfo = $matches->fetchAll();

//display query results
if (!empty($matchesInfo)) {
	echo "<h3>Actors Two Degrees away from Kevin Bacon</h3>";
		
	echo("<table>");
	echo("<tr><td><strong>#</strong></td><td><strong>Actor</strong></td></tr>");
		
	$i = 1;
		
	foreach ($matchesInfo as $row) {
		echo ("<tr>");
		echo ("<td>$i</td><td>" . $row['first_name'] . " " . $row['last_name'] . "</td></tr>");
		$i++;
	}
		
	echo("</table>");
	echo "<br>";
}


?>

            </div>
            <div id = "banner"> </div>
        </div>
    </body>

</html>
