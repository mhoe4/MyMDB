<html>
<head>
<link href="bacon.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div id="frame">
<div id="banner">
<h1>Actors who have also Directed</h1>
</div>

<div id =" main" style="background-color:white; overflow:hidden; width:700px; margin:0 auto;">
<?php

include('common.php');

//fetch query data
$matches = getDirectors($db);
$matchesInfo = $matches->fetchAll();

//display query results
echo "<h3>Results for actors who have also directed movies</h3>";

echo("<table>");
echo("<tr><td><strong>#</strong></td><td><strong>Actor/Director</strong></td></tr>");

$i = 1;

foreach ($matchesInfo as $row) {
	echo ("<tr>");
	echo ("<td>$i</td><td>" . $row['first_name'] . " " . $row['last_name'] ."</td></tr>");
	$i++;
}

echo("</table>");
echo "<br>";

?>

            </div>
        </div>
    </body>

</html>
