/**
 * Created by Alex on 8/5/2017.
 */
$(document).ready(main);


function log(data)
{
	console.log(data);
}


function main()
{
	$("#btnAddCourse").click(showCourseField);
	$("#btnAddHole").click(showHoleField);
	$("#newCourseSubmit").click(addCourse);
	$("#newHoleSubmit").click(addHole);
	$("#printCurCourses").click(function(){
		clearScreen();
		getCourses();

	});
}


function addCourse()
{


	var c_name = $("#addCourseName").val();
	var c_street = $("#addCourseStreet").val();
	var c_city = $("#addCourseCity").val();
	var c_state = $("#addCourseState").val();
	var c_zip = $("#addCourseZip").val();

	var toSend = {course_name: c_name, street: c_street, city: c_city, state: c_state, zip: c_zip};

	$.ajax("index.php", {
		data: toSend,
		type: 'POST',
		datatype: 'json',
		success: printCourses
	});


	//Clearing fields
	$(".courseInfoField").val('');

}


function addHole()
{
	var course = $("#addHoleCourseName").val();
	var holeNum = $("#addHole").val();
	var blue = $("#addHoleBYard").val();
	var white = $("#addHoleWYard").val();
	var red = $("#addHoleRYard").val();
	var par = $("#addHolePar").val();

	var toSend = {course_name: course, hole: holeNum, blue: blue, white: white, red: red, par: par};

	$.ajax("index.php", {
		data: toSend,
		type: 'POST',
		datatype: 'json',
		success: printHoles
	});

	//Clearing fields
	$(".holeInfoField").val('');

}

function getCourses()
{
	var toSend = {request : 0};
	$.ajax("index.php", {
		data: toSend,
		type: 'GET',
		datatype: 'json',
		success: printCourses,
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus); alert("Error: " + errorThrown);
		}
	});
}



function printCourses(dataFromPHP)
{
	var decodedData = JSON.parse(dataFromPHP);
	log(decodedData);

}

function printHoles(dataFromPHP)
{
	var decodedData = JSON.parse(dataFromPHP);
	log(decodedData);
}



function showCourseField()
{
	clearScreen();
	$("#formAddCourse").show();
}


function showHoleField()
{
	clearScreen();
	$("#formAddHole").show();
}

function clearScreen()
{
	$("#formAddHole").hide();
	$("#formAddCourse").hide();
}























