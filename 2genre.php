<html>
<head>
<link href="bacon.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div id="frame">
<div id="banner">
<h1>IMDB Actors with Most Movies for Selected Genre</h1>
</div>

<div id =" main" style="background-color:white; overflow:hidden; width:700px; margin:0 auto;">
<?php

include('common.php');

//fetch query data
$matches = getTwoGenre($genre, $db);
$matchesInfo = $matches->fetchAll();

//display query results based on correct input
if (empty($genre)) {
	echo ("<p>Select a Movie Genre</p>");
}else if (!empty($matchesInfo)) {
	echo "<h3>Results for " . $genre . "</h3>";

	echo("<table>");
	echo("<tr><td><strong>#</strong></td><td><strong>Actor</strong></td><td><strong>Number of Movies</strong></td></tr>");

	$i = 1;

	foreach ($matchesInfo as $row) {
		echo ("<tr>");
		echo ("<td>$i</td><td>" . $row['first_name'] . " " . $row['last_name'] . "</td><td>" . $row['totalCount'] . "</td></tr>");
		$i++;
	}

	echo("</table>");
} 

//form to select genre to query on
echo "<br>";
echo "<!-- form to select genre  -->
		<form action='2genre.php' method='get'>
			<fieldset>
				<legend>Movie Genres</legend>
				<div>
					<select name='genre' id='genre'>
  						<option value=''></option>
  						<option value='Action'>Action</option>
  						<option value='Adventure'>Adventure</option>
  						<option value='Animation'>Animation</option>
  						<option value='Comedy'>Comedy</option>
  						<option value='Crime'>Crime</option>
  						<option value='Drama'>Drama</option>
  						<option value='Family'>Family</option>
  						<option value='Fantasy'>Fantasy</option>
  						<option value='Horror'>Horror</option>
  						<option value='Music'>Music</option>
  						<option value='Musical'>Musical</option>
  						<option value='Mystery'>Mystery</option>
  						<option value='Romance'>Romance</option>
  						<option value='Sci-Fi'>Sci-Fi</option>
  						<option value='Thriller'>Thriller</option>
  						<option value='War'>War</option>
					</select>
					<input type='submit' value='go' />
				</div>
			</fieldset>
		</form>";
?>
            </div>
        </div>
    </body>

</html>
