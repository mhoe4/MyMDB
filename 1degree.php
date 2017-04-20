<html>
<head>
<link href="bacon.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div id="frame">
<div id="banner">
<h1>The One Degree of Kevin Bacon</h1>
</div>

<div id =" main" style="background-color:white; overflow:hidden; width:700px; margin:0 auto;">
<?php

include('common.php');

//fetch query data
$matches = getOneDegree($first_name, $last_name, $db);
$matchesInfo = $matches->fetchAll();

//display results based on correct input
if (empty($first_name) || empty($last_name)) {
	echo ("<p> Enter actor first and last name</p>");
}else if (!empty($matchesInfo)) {
	echo "<h3>Movies with " . $first_name . " " . $last_name . " and Kevin Bacon</h3>";
	
	echo("<table>");
	echo("<tr><td><strong>#</strong></td><td><strong>Title</strong></td><td><strong>Year</strong></td></tr>");

	$i = 1;

	foreach ($matchesInfo as $row) {
		echo ("<tr>");
		echo ("<td>$i</td><td>" . $row['name'] . "</td><td>" . $row['year'] . "</td></tr>");
		$i++;
	}

	echo("</table>");
} else if (!empty($first_name) && !empty($last_name)) {
	echo ("<p>" . $first_name . " " . $last_name . " wasn't found in any films with Kevin Bacon.</p>");
}

//actor search input form
echo "<br>";
echo "<!-- form to search for movies where a given actor was with Kevin Bacon -->
		<form action='1degree.php' method='get'>
			<fieldset>
				<legend>Movies with Kevin Bacon</legend>
				<div>
					<input name='firstname' type='text' size='12' placeholder='first name' />
					<input name='lastname' type='text' size='12' placeholder='last name' />
					<input type='submit' value='go' />
				</div>
			</fieldset>
		</form>";
?>

            </div>
        </div>
        
    </body>

</html>
