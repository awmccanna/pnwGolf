<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 8/5/2017
 * Time: 9:12 AM
 */


require_once "credentials.php";

/*
 * Function takes in server information, and returns a PDO object
 */
/**
 * @param $servername
 * @param $username
 * @param $password
 * @return PDO
 */
function getConnection($servername, $username, $password)
{
	try
	{
		$conn = new PDO("mysql:host=$servername;dbname=alexmcc2_pnw_golf_db", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		http_response_code(403);
		echo "Connection failed: " . $e->getMessage();
		exit(1);
	}

	return $conn;
}


/**
 * @param $conn PDO
 */
function printCourses($conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses');
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $conn PDO
 */
function printHoles($conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM course_info');
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $course
 * @param $conn PDO
 */
function printHolesByCourse($course, $conn)
{

	try{
		$statement = $conn->prepare('SELECT * FROM course_info WHERE course_info.course_name = :course');
		$statement->bindParam('course', $course);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;

}

/**
 * @param $hole
 * @param $conn PDO
 */
function printHolesByNumber($hole, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM course_info WHERE course_info.hole = :hole');
		$statement->bindParam('hole', $hole);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;

}

/**
 * @param $par
 * @param $conn PDO
 */
function printHolesByPar($par, $conn)
{

	try{
		$statement = $conn->prepare('SELECT * FROM course_info WHERE par = :par');
		$statement->bindParam('par', $par);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;

}

/**
 * @param $course
 * @param $hole
 * @param $par
 * @param $conn PDO
 */
function printHolesByCourseHolePar($course, $hole, $par, $conn)
{
	try {
		$statement = $conn->prepare('SELECT * FROM course_info WHERE course_name = :course AND hole = :hole AND par = :par');
		$statement->bindParam('course', $course);
		$statement->bindParam('hole', $hole);
		$statement->bindParam('par', $par);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;

}

/**
 * @param $course
 * @param $hole
 * @param $conn PDO
 */
function printHolesByCourseHole($course, $hole, $conn)
{
	try {
		$statement = $conn->prepare('SELECT * FROM course_info WHERE course_name = :course AND hole = :hole');
		$statement->bindParam('course', $course);
		$statement->bindParam('hole', $hole);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $course
 * @param $par
 * @param $conn PDO
 */
function printHolesByCoursePar($course, $par, $conn)
{
	try {
		$statement = $conn->prepare('SELECT * FROM course_info WHERE course_name = :course AND par = :par');
		$statement->bindParam('course', $course);
		$statement->bindParam('par', $par);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $hole
 * @param $par
 * @param $conn PDO
 */
function printHolesByHolePar($hole, $par, $conn)
{
	try {
		$statement = $conn->prepare('SELECT * FROM course_info WHERE hole = :hole AND par = :par');
		$statement->bindParam('hole', $hole);
		$statement->bindParam('par', $par);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}


/**
 * @param $city
 * @param $state
 * @param $conn PDO
 */
function printCoursesByCityState($city, $state, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.city = :city AND courses.state = :state');
		$statement->bindParam('city', $city);
		$statement->bindParam('state', $state);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;

}

/**
 * @param $course_name
 * @param $city
 * @param $state
 * @param $conn PDO
 */
function printCourseByNameCityState($course_name, $city, $state, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.course_name = :name AND courses.city = :city AND courses.state = :state');
		$statement->bindParam('name', $course_name);
		$statement->bindParam('city', $city);
		$statement->bindParam('state', $state);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $course_name
 * @param $city
 * @param $conn PDO
 */
function printCourseByNameCity($course_name, $city, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.course_name = :name AND courses.city = :city');
		$statement->bindParam('name', $course_name);
		$statement->bindParam('city', $city);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $course_name
 * @param $state
 * @param $conn PDO
 */
function printCourseByNameState($course_name, $state, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.course_name = :name AND courses.state = :state');
		$statement->bindParam('name', $course_name);
		$statement->bindParam('state', $state);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $city
 * @param $state
 * @param $conn PDO
 */
function printCourseByCityState($city, $state, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.city = :city AND courses.state = :state');
		$statement->bindParam('city', $city);
		$statement->bindParam('state', $state);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}


/**
 * @param $course_name
 * @param $conn PDO
 */
function printCourseByName($course_name, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.course_name = :name');
		$statement->bindParam('name', $course_name);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $city
 * @param $conn PDO
 */
function printCourseByCity($city, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.city = :city');
		$statement->bindParam('city', $city);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}

/**
 * @param $state
 * @param $conn PDO
 */
function printCourseByState($state, $conn)
{
	try{
		$statement = $conn->prepare('SELECT * FROM courses WHERE courses.state = :state');
		$statement->bindParam('state', $state);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		http_response_code(500);
		echo $e->getMessage();
	}
	http_response_code(200);
	echo json_encode($result);
	$conn = null;
}



/**
 * @param $conn PDO
 * @param $_DELETE
 */
function deleteCourse($conn, $_DELETE)
{
	if (isset($_DELETE["course_name"])) {
		$course_name = $_DELETE["course_name"];
		try {
			$statement = $conn->prepare('DELETE FROM courses WHERE course_name = :course');
			$statement->bindParam('course', $course_name);
			$statement->execute();
		} catch (PDOException $e) {
			http_response_code(500);
			echo $e->getMessage();
		}
		$conn = null;
	}
}


/**
 * @param $conn PDO
 * @param $_DELETE
 */
function deleteHole($conn, $_DELETE)
{

	if (isset($_DELETE["course_name"])) {
		$course_name = $_DELETE["course_name"];
	}
	if(isset($_DELETE["hole"])) {
		$hole = $_DELETE["hole"];
	}

	try {
		$statement  = $conn->prepare('DELETE FROM course_info WHERE course_name = :name AND hole = :hole');
		$statement->bindParam('name', $course_name);
		$statement->bindParam('hole', $hole);
		$statement->execute();
	} catch (PDOException $e) {
		http_response_code(500);
		echo $e->getMessage();
	}
	$conn = null;

}


/**
 * @param $conn PDO
 */
function addCourse($conn)
{
	if(isset($_POST["course_name"]) && !empty($_POST["course_name"]))
	{
		$course_name = $_POST["course_name"];
	}
	if(isset($_POST["street"]) && !empty($_POST["street"]))
	{
		$street = $_POST["street"];
	}
	if(isset($_POST["city"]) && !empty($_POST["city"]))
	{
		$city = $_POST["city"];
	}
	if(isset($_POST["state"]) && !empty($_POST["state"]))
	{
		$state = $_POST["state"];
	}
	if(isset($_POST["zip"]) && !empty($_POST["zip"]))
	{
		$zip = $_POST["zip"];
	}


	try
	{
		$statement = $conn->prepare("INSERT INTO `courses` (course_name, street, city, state, zip) VALUES (:course_name, :street, :city, :state, :zip);");
		$statement->bindParam(':course_name', $course_name);
		$statement->bindParam(':street', $street);
		$statement->bindParam(':city', $city);
		$statement->bindParam(':state', $state);
		$statement->bindParam(':zip', $zip);
		$statement->execute();

	}
	catch(PDOException $e)
	{
		http_response_code(500);
		echo $e->getMessage();
	}
	printCourses($conn);
	$conn = null;
}


/**
 * @param $conn PDO
 */
function addHole($conn)
{
	if(isset($_POST["course_name"]) && !empty($_POST["course_name"]))
	{
		$course_name = $_POST["course_name"];
	}
	if(isset($_POST["hole"]) && !empty($_POST["hole"]))
	{
		$hole = $_POST["hole"];
	}
	if(isset($_POST["blue"]) && !empty($_POST["blue"]))
	{
		$blue = $_POST["blue"];
	}
	if(isset($_POST["white"]) && !empty($_POST["white"]))
	{
		$white = $_POST["white"];
	}
	if(isset($_POST["red"]) && !empty($_POST["red"]))
	{
		$red = $_POST["red"];
	}
	if(isset($_POST["par"]) && !empty($_POST["par"]))
	{
		$par = $_POST["par"];
	}


	try
	{
		$statement = $conn->prepare("INSERT INTO `course_info` (course_name, hole, yardage_blue, yardage_white, yardage_red, par) VALUES (:course_name, :hole, :blue, :white, :red, :par);");
		$statement->bindParam(':course_name', $course_name);
		$statement->bindParam(':hole', $hole);
		$statement->bindParam(':blue', $blue);
		$statement->bindParam(':white', $white);
		$statement->bindParam(':red', $red);
		$statement->bindParam(':par', $par);
		$statement->execute();

	}
	catch(PDOException $e)
	{
		http_response_code(500);
		echo $e->getMessage();
	}
	printHoles($conn);
	$conn = null;
}













/********************************************************************/
/*							Main starts here						*/
/********************************************************************/

if($_SERVER["REQUEST_METHOD"] == "DELETE")
{
	$_DELETE = array();
	parse_str(file_get_contents('php://input'), $_DELETE);

	if(isset($_DELETE["hole"]))
	{
		deleteHole(getConnection($servername, $username, $password), $_DELETE);
	}
	elseif(isset($_DELETE["course_name"]))
	{
		deleteCourse(getConnection($servername, $username, $password), $_DELETE);
	}

}


if($_SERVER["REQUEST_METHOD"] == "GET")
{

	/*
	--How it works:
		Checks if holes is set. If it is, that means that it is coming from the ./pnwgolf/holes
		Then checks for course_name, hole, and par being sent in. Call appropriate method based off of the request.
		If no other fields are sent in, does a default print.
	*/

	if(isset($_GET["holes"]) && !empty($_GET["holes"]))
	{
		//var_dump($_GET["course_name"]);
		if(isset($_GET["course_name"]) && !empty($_GET["course_name"]))
		{
			if(isset($_GET["hole"]) && !empty($_GET["hole"]))
			{
				if(isset($_GET["par"]) && !empty($_GET["par"]))
				{
					printHolesByCourseHolePar($_GET["course_name"], $_GET["hole"], $_GET["par"], getConnection($servername, $username, $password));
				}
				else
				{
					printHolesByCourseHole($_GET["course_name"], $_GET["hole"], getConnection($servername, $username, $password));
				}

			}
			elseif(isset($_GET["par"]) && !empty($_GET["par"]))
			{
				printHolesByCoursePar($_GET["course_name"], $_GET["par"], getConnection($servername, $username, $password));
			}
			else
			{
				printHolesByCourse($_GET["course_name"], getConnection($servername, $username, $password));
			}

		}//End course_name check
		elseif(isset($_GET["hole"]) && !empty($_GET["hole"]))
		{
			if(isset($_GET["par"]) && !empty($_GET["par"]))
			{
				printHolesByHolePar($_GET["hole"], $_GET["par"], getConnection($servername, $username, $password));
			}
			else//print by hole
			{
				printHolesByNumber($_GET["hole"], getConnection($servername, $username, $password));
			}
		}
		elseif(isset($_GET["par"]) && !empty($_GET["par"]))
		{
			printHolesByPar($_GET["par"], getConnection($servername, $username, $password));
		}
		else//default print
		{

			printHoles(getConnection($servername, $username, $password));
		}
	}
	else//courses or basic index
	{
		if(isset($_GET["course_name"]) && !empty($_GET["course_name"]))
		{
			if(isset($_GET["city"]) && !empty($_GET["city"]))
			{
				if(isset($_GET["state"]) && !empty($_GET["state"]))
				{
					printCourseByNameCityState($_GET["course_name"], $_GET["city"], $_GET["state"], getConnection($servername, $username, $password));
				}
				else
				{
					printCourseByNameCity($_GET["course_name"], $_GET["city"], getConnection($servername, $username, $password));
				}

			}
			elseif(isset($_GET["state"]) && !empty($_GET["state"]))
			{
				printCourseByNameState($_GET["course_name"], $_GET["state"], getConnection($servername, $username, $password));
			}
			else
			{
				printCourseByName($_GET["course_name"], getConnection($servername, $username, $password));

			}
		}
		elseif(isset($_GET["city"]) && !empty($_GET["city"]))
		{
			if(isset($_GET["state"]) && !empty($_GET["state"]))
			{
				printCourseByCityState($_GET["city"], $_GET["state"], getConnection($servername, $username, $password));
			}
			else
			{
				printCourseByCity($_GET["city"], getConnection($servername, $username, $password));
			}
		}
		elseif(isset($_GET["state"]) && !empty($_GET["state"]))
		{
			printCourseByState($_GET["state"], getConnection($servername, $username, $password));
		}
		else
		{
			printCourses(getConnection($servername, $username, $password));
		}

	}

}


if($_SERVER["REQUEST_METHOD"] == "PUT")
{
	//Currently not implemented, won't be available for public use regardless
	$_PUT = array();
	parse_str(file_get_contents('php://input'), $_PUT);
	//editHole(getConnection($servername, $username, $password), $_PUT);
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isset($_POST["street"]))
	{
		addCourse(getConnection($servername, $username, $password));
	}
	elseif(isset($_POST["hole"]))
	{
		addHole(getConnection($servername, $username, $password));
	}
	else
	{
		http_response_code(500);
		echo "Unexpected error occured";
	}

}


if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
{
	//$array = "PUT<br>POST: <br>movie_name: title, year_released: year, studio: studio, price: price<br>GET:<br>id-returns specific entry by id <br>DELETE";
	echo "API Usage<br>
		URL: /holes<br>
		Returns information about specific holes on a course<br>
		Options:<br>
		none: Returns information on all holes<br>
		course_name (string): All the holes of the desired course.<br>
		hole (int): Hole number.<br>
		par (int): Par of the hole or holes<br><br>
		URL: /courses<br>
		Returns information about the courses<br>
		Options:<br>
		course_name (string): Information about the course.<br>
		city (string): Courses in the given city.<br>
		state (2 letter string): Courses in the given city.<br><br>
		URL: /index<br>
		Returns information on all the courses";

}














?>