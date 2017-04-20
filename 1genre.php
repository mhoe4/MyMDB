<html>
<head>
<link href="bacon.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div id="frame">
<div id="banner">
<h1>IMDB Most Popular Genre(s)</h1>
</div>

<div id =" main" style="background-color:white; overflow:hidden; width:700px; margin:0 auto;">
<?php

include('common.php');

//fetch query data
$matches = getOneGenre($db);
$matchesInfo = $matches->fetchAll();

//display query results
echo "<h3>Results for most popular genre(s)</h3>";

echo("<table>");
echo("<tr><td><strong>#</strong></td><td><strong>Genre</strong></td><td><strong>Number of Movies</strong></td></tr>");

$i = 1;

foreach ($matchesInfo as $row) {
	echo ("<tr>");
	echo ("<td>$i</td><td>" . $row['genre'] . "</td><td>" . $row['count'] . "</td></tr>");
	$i++;
}

echo("</table>");
echo "<br>";
?>

            </div>
        </div>
    </body>

</html>
