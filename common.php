<?php

	//database connection information
	$dsn = 'mysql:dbname=imdb_small;host=localhost;port=3306';
	$user = 'root';
	$password = '';
	
	//database connection
	try {
		$db = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
    	die("Could not connect to the database:" . $e->getMessage());
	}
	
	//grab user input
	$first_name= isset($_GET['firstname']) ? clean($_GET['firstname']) : '';
	$last_name= isset($_GET['lastname']) ? clean($_GET['lastname']) : '';
	$genre = isset($_GET['genre']) ? clean($_GET['genre']) : '';
	
	//removes special charachters from strings
	function clean($string) {
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}
	
	//queries movies given actor is in with Kevin Bacon
	function getOneDegree($firstname, $lastname, $db) {
		$firstname = clean($firstname);
		$lastname = clean($lastname);
	    $sql = "SELECT movies.name, year from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) ON movies.id = roles.movie_id "
 				. "Where movies.id in "
 				. "(SELECT movies.id from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) ON movies.id = roles.movie_id "
  				. "WHERE actors.first_name = 'Kevin' and actors.last_name = 'Bacon') "
				. "AND roles.actor_id = "
 				. "(SELECT min(ID) FROM actors WHERE "
  				. "actors.first_name LIKE '" . $firstname . "%' AND actors.last_name LIKE '" . $lastname . "%')";       
	    return $db->query($sql);  
	}
	
	//queries actors who have been in a movie with an actor who has been in a movie with kevin bacon but aren't in a movie with kevin bacon themselves
	function getTwoDegree($db) {
		$sql = "SELECT actors.first_name, actors.last_name from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) "
				. "ON movies.id = roles.movie_id Where movies.id in (SELECT movies.id from movies inner join "
				. "(roles INNER JOIN actors ON actors.id = roles.actor_id) ON movies.id = roles.movie_id "
				. "WHERE actors.id IN (SELECT actors.id from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) "
				. "ON movies.id = roles.movie_id Where movies.id in "
				. "(SELECT movies.id from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) "
				. " ON movies.id = roles.movie_id WHERE actors.first_name = 'Kevin' and actors.last_name = 'Bacon') group by actors.id) "
				. "group by movies.id) AND movies.id NOT IN (SELECT movies.id from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) "
				. "ON movies.id = roles.movie_id WHERE actors.first_name = 'Kevin' and actors.last_name = 'Bacon') "
				. "GROUP by actors.id ORDER BY actors.last_name ASC";
		return $db->query($sql);
	}
	
	//queries genre(s) with the most number of movies
	function getOneGenre($db){
		$sql = "SELECT mg.genre, COUNT(mg.movie_id) AS count FROM movies_genres mg GROUP BY mg.genre HAVING COUNT(mg.movie_id) = "
				. "(SELECT COUNT(mg1.movie_id) totalCount FROM movies_genres mg1 GROUP BY mg1.genre order by totalCount DESC LIMIT 1)";
		return $db->query($sql);
	}
	
	//queries actor(s) with most number of movies of a given genre 
	function getTwoGenre($genre, $db){
		$genre = clean($genre);
		$sql = "SELECT actors.first_name, actors.last_name, COUNT(roles.actor_id) totalCount "
				. "FROM actors INNER join (roles inner join movies_genres on movies_genres.movie_id = roles.movie_id) "
				. "on roles.actor_id = actors.id "
				. "WHERE movies_genres.genre like '" .$genre . "' "
				. "GROUP by roles.actor_id HAVING COUNT(roles.actor_id) = "
				. "(SELECT COUNT(roles.actor_id) totalCount "
				. "FROM actors INNER join (roles inner join movies_genres on movies_genres.movie_id = roles.movie_id) "
				. "on roles.actor_id = actors.id "
				. "WHERE movies_genres.genre like '" . $genre . "' "
				. "GROUP by roles.actor_id "
				. "ORDER by totalCount DESC "
				. "limit 1)";
		return $db->query($sql);
	}
	
	//queries actors who have also directed a movie
	function getDirectors($db){
		$sql = "SELECT directors.first_name, directors.last_name FROM directors "
			. "INNER JOIN actors on directors.first_name = actors.first_name AND directors.last_name = actors.last_name";
		return $db->query($sql);
	}
	
?>
