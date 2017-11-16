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
		echo "Connection failed: " . $e->getMessage();
	}

	return $conn;
}


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


function printHolesFromCourse($course, $conn)
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

function printHolesByNumber($hole, $conn)
{

	try{
		$statement = $conn->prepare('SELECT * FROM course_info WHERE course_info.hole_number = :hole');
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

function printHolesByPar($par, $conn)
{

	try{
		$statement = $conn->prepare('SELECT * FROM course_info WHERE course_info.par = :par');
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





function deleteCourse($conn, $_DELETE)
{

//TODO finish this?
	if (isset($_DELETE["course_name"])) {
		$course_name = $_DELETE["course_name"];
	}

	try {

		$sql = "DELETE FROM `courses` WHERE `course_name` = '" . $course_name . "'";
		$result = $conn->query($sql);
	} catch (PDOException $e) {
		http_response_code(500);
		echo $sql . "<br>" . $e->getMessage();
	}

	printCourses($conn);
	$conn = null;

}


function deleteHole($conn, $_DELETE)
{

	if (isset($_DELETE["course_name"])) {
		$course_name = $_DELETE["course_name"];
	}
	if(isset($_DELETE["hole"])) {
		$hole = $_DELETE["hole"];
	}


	try {

		$sql = "DELETE FROM `course_info` WHERE `course_name` = '" . $course_name . "' AND `hole_number` = '" . $hole . "'";
		$result = $conn->query($sql);
	} catch (PDOException $e) {
		http_response_code(500);
		echo $sql . "<br>" . $e->getMessage();
	}

	printCourses($conn);
	$conn = null;

}






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
		$statement = $conn->prepare("INSERT INTO `course_info` (course_name, hole_number, yardage_blue, yardage_white, yardage_red, par) VALUES (:course_name, :hole, :blue, :white, :red, :par);");
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

	/*TODO There will be quite a bit that I want added here.
		0. Get all available courses. Default
		1. Get all holes.
		2. Get all holes from a certain course. Course name will be sent in
		3. Get all holes of a certain number. Hole number will be sent in
		4. Get all holes of a certain par. Par will be sent in
		5. Get all courses from a specific city, state, zip code(?). Identifier will be sent in
	*/
	if(isset($_GET["request"]) && !empty($_GET["request"]))
	{
		$id = $_GET["request"];
		if($id == 0)
		{
			printCourses(getConnection($servername, $username, $password));
		}
		elseif($id == 1)
		{
			printHoles(getConnection($servername, $username, $password));
		}
		elseif($id == 2)
		{
			printHolesFromCourse($_GET["course"], getConnection($servername, $username, $password));
		}
		elseif($id == 3)
		{
			printHolesByNumber($_GET["hole"], getConnection($servername, $username, $password));
		}
		elseif($id == 4)
		{
			printHolesByPar($_GET["par"], getConnection($servername, $username, $password));
		}
		elseif($id == 5)
		{
			printCoursesByCityState($_GET["city"], $_GET["state"], getConnection($servername, $username, $password));
		}
		/*else
		{
			taken out temporarily, until I figure out how I want individual calls to be made
			printItem(getConnection($servername, $username, $password), $id);
		}*/
	}
	else
	{
		printCourses(getConnection($servername, $username, $password));
	}
}


if($_SERVER["REQUEST_METHOD"] == "PUT")
{
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
	else if(isset($_POST["hole"]))
	{
		addHole(getConnection($servername, $username, $password));
	}
	else
	{
		http_response_code(500);
		echo "unexpected error occured";
	}

}


if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
{
	//$array = "PUT<br>POST: <br>movie_name: title, year_released: year, studio: studio, price: price<br>GET:<br>id-returns specific entry by id <br>DELETE";
	echo "In progress";
}














?>