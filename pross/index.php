<?php

/* ---------------------------------------------------------------------------
* filename    : index
* author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
* description : This program displays the landing page and database records
* within a table view and options for the user to sort and display certain
* records based on the type and other factors with a search bar.
* ---------------------------------------------------------------------------
*/

session_start();
if (!$_SESSION) {
	header("Location: login.php");
}
$id = null;
$search = null;
$_SESSION['search'] = null;
$_SESSION['report'] = null;
$_SESSION['sort'] = null;
$_SESSION['page'] = null;
if (isset($_GET['page'])) {
	$_SESSION['page'] = $_GET['page'];
}
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	if ($search == "Done") {
		$_SESSION['search'] = "Done";
	} else {
		$_SESSION['search'] = $search;
	}
}
if (isset($_GET['sort'])) {
	$_SESSION['sort'] = $_GET['sort'];
}
if (isset($_POST['refresh'])) {
	$search = null;
	$_SESSION['search'] = $search;
}
if (isset($_POST['showActive'])) {
	$_SESSION['search'] = "Active";
}
if (isset($_POST['showDone'])) {
	$_SESSION['search'] = "Done";
}
if (isset($_POST['report'])) {
	$_SESSION['report'] = "Print";
	header("Location: report.php");
}
if (!empty($_POST['search'])) {
	$search = $_POST['search'];
	$_SESSION['search'] = $search;
}
if (!empty($_POST['date1']) && !empty($_POST['date2']) ) {
	$search = $_POST['date1'] . "+" .  $_POST['date2'];
	$_SESSION['search'] = $search;
}
if (!empty($_POST['search']) && !empty($_POST['date1']) && !empty($_POST['date2'])) {
	$search = $_POST['search'] . "#" . $_POST['date1'] . "#" .  $_POST['date2'];
	$_SESSION['search'] = $search;
}

// get current logged in user   
$logedInUsername = $_SESSION['username'];

// include the class that handles database connections
require 'database.php';

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM users WHERE username = '$logedInUsername'";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
$name = $data['name'];
$role = $data['role'];
$user_id = $data['id'];
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
		body { 
            animation: fadeInAnimation ease 1s; 
            animation-iteration-count: 1; 
            animation-fill-mode: forwards;
			margin: 0;
			font-family: Arial, Helvetica, sans-serif;
        } 
        @keyframes fadeInAnimation { 
            0% { 
                opacity: 0; 
            } 
            100% {
                opacity: 1; 
            } 
        }
        img {
          display: block;
          margin-left: auto;
          margin-right: auto;
        }
		p {
			font-size: 12px;
			margin-bottom: 0px;
		}
		.pages:hover {
			background-color: #ddd;
			color: black;
			transition: 0.5s;
		}
		.pages {
			text-decoration: none;
			display: inline-block;
			padding: 4px 8px;
			background-color: #f1f1f1;
			color: black;
		}
        .column {
          float: left;
          width: 50%;
          padding: 10px;
        }
        .aligncenter {
            text-align: center;
        }
		table {
            width:  100%;
            border-collapse: collapse;
			font-size: 16px;
        }
        td {
			text-align: center;
			vertical-align: middle;
            border: 1px solid black;
        }
		th {
			text-align: center;
			vertical-align: middle;
		}
        .scrollingTable {
            overflow-y: auto;
        }
		.button {
			display: inline-block;
			border-radius: 4px;
			background-color: #009900;
			border: none;
			color: #FFFFFF;
			text-align: center;
			font-size: 14px;
			width: 140px;
			height: 35px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 5px;
			float: right;
		}
		.button1 span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button1 span:after {
			font-family: FontAwesome;
			content: '\f0f6';
			position: absolute;
			opacity: 0;
			top: 0;
			left: -20px;
			transition: 0.5s;
		}
		.button1:hover span {
			padding-left: 25px;
		}
		.button1:hover span:after {
			opacity: 1;
			left: 0;
		}
		.button2 span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button2 span:after {
			font-family: FontAwesome;
			content: '\f046';
			position: absolute;
			opacity: 0;
			top: 0;
			left: -20px;
			transition: 0.5s;
		}
		.button2:hover span {
			padding-left: 25px;
		}
		.button2:hover span:after {
			opacity: 1;
			left: 0;
		}
		.button3 span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button3 span:after {
			font-family: FontAwesome;
			content: '\f017';
			position: absolute;
			opacity: 0;
			top: 0;
			left: -20px;
			transition: 0.5s;
		}
		.button3:hover span {
			padding-left: 25px;
		}
		.button3:hover span:after {
			opacity: 1;
			left: 0;
		}
		.button4 span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button4 span:after {
			font-family: FontAwesome;
			content: '\f021';
			position: absolute;
			opacity: 0;
			top: 0;
			left: -20px;
			transition: 0.5s;
		}
		.button4:hover span {
			padding-left: 25px;
		}
		.button4:hover span:after {
			opacity: 1;
			left: 0;
		}
		.button5 span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button5 span:after {
			font-family: FontAwesome;
			content: '\f02f';
			position: absolute;
			opacity: 0;
			top: 0;
			left: -20px;
			transition: 0.5s;
		}
		.button5:hover span {
			padding-left: 25px;
		}
		.button5:hover span:after {
			opacity: 1;
			left: 0;
		}
		* {box-sizing: border-box;}
        .topnav {
          overflow: hidden;
          background-color: #e9e9e9;
        }
        .topnav a {
          float: left;
          display: block;
          color: black;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 17px;
		  transition: all 0.5s;
        }
        .topnav p {
          float: left;
          display: block;
          color: black;
          text-align: center;
          padding: 12px 2px 2px 2px;
          text-decoration: none;
          font-size: 20px;
        }
		.topnav img {
          float: left;
          display: block;
          color: black;
          text-align: center;
		  padding: 2px 2px;
          text-decoration: none;
          font-size: 17px;
        }
        .topnav a:hover {
          background-color: #ddd;
          color: black;
		  transition: all 0.5s;
        }
        .topnav a.active {
          background-color: #004A7F;
          color: white;
        }
        .topnav .search-container {
          float: left;
        }
        .topnav input[type=text], input[type=date] {
          padding: 6px;
          margin-top: 8px;
		  margin-left: 4px;
		  margin-right: 4px;
          font-size: 17px;
          border: none;
		  width: 180px;
		  height: 36px;
        }
        .topnav .search-container button {
          float: right;
          padding: 6px;
          margin-top: 8px;
          margin-right: 16px;
          background: #ddd;
          font-size: 17px;
          border: none;
          cursor: pointer;
        }
        .topnav .search-container button:hover {
          background: #ccc;
        }
        @media screen and (max-width: 600px) {
			.topnav .search-container {
				float: none;
			}
			.topnav a, .topnav input[type=text], .topnav .search-container button, .topnav button {
				float: none;
				display: block;
				text-align: left;
				width: 100%;
				margin: 0;
				padding: 14px;
			}
			.topnav input[type=text] {
				border: 1px solid #ccc;  
			}
		}
    </style>
</head>

<body onload="makeTableScroll()">
	<title>Index</title>
    <div class="topnav">
		<img src="PROSS_Logo.png" href="index.php" alt="Logo" style="width:110px;height:50px;">
        <a class="active" href="index.php"><i class="fa fa-list"></i>&ensp;Home</a>
		<a href="create.php"><i class="fa fa-file-text"></i>&ensp;Create New</a>
        <div class="search-container">
            <form action="index.php" method="POST" enctype="multipart/form-data">
				<input type="text" style="margin-left: 10px" maxlength="14" placeholder="Search..." name="search">
				<input type="date" placeholder="Search..." name="date1">
				-
				<input type="date" style="margin-right: 0px" placeholder="Search..." name="date2">
				<button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
		<b><p id="greeting" style="float:left;">Hello, <?php echo $name ?>!</p></b>
		<a style="float:right;" href="logout.php">Sign Out&ensp;<i class="fa fa-sign-out"></i></a>
		<a style="float:right;" href="password.php?id=<?php echo $user_id ?>" id="changePass">Change Password&ensp;<i class="fa fa-unlock-alt"></i></a>
		<a style="float:right;" href="users.php" id="users">Users&ensp;<i class="fa fa-users"></i></a>
    </div>
            <div class="column">
                <h2><b>Purchase Order Requisitions</b></h2>
            </div>
            <div class="column">
				<button name="createNew" class="button button1" style="background-color: #191970" type="button" onclick="location.href='create';"><span>Create New</span></button>
				<form action="index.php?search=Done" method="post">
					<button name="showDone" class="button button2" type="submit"><span>Done</span></button>
				</form>
				<form action="index.php?search=Active" method="post">
					<button name="showActive" class="button button3" style="background-color: grey" type="submit"><span>Active</span></button>
				</form>
				<form action="index.php" method="post">
					<button name="refresh" class="button button4" style="background-color: #800000" type="submit"><span>Refresh</span></button>
				</form>
				<form action="index.php?sql=print" method="post">
					<button name="report" class="button button5" style="background-color: #5F9EA0" type="submit"><span>Print Report</span></button>
				</form>
            </div>
			<hr style="width:100%">
			<div class="scrollingTable" id="myTable">
				<table class="table table-striped table-bordered" id="output">
				</table>
			</div>
		<script type="text/javascript">
			var today = new Date();
			var curHr = today.getHours();
			if (curHr < 12) {
			  document.getElementById('greeting').innerHTML = "Good Morning, <?php echo $name ?>!";
			} else if (curHr < 18) {
			  document.getElementById('greeting').innerHTML = "Good Afternoon, <?php echo $name ?>!";
			} else {
			  document.getElementById('greeting').innerHTML = "Good Evening, <?php echo $name ?>!";
			}
			function makeTableScroll() {
				var maxRows = 10;

				var table = document.getElementById('myTable');
				var wrapper = table.parentNode;
				var rowsInTable = table.rows.length;
				var height = 0;
				if (rowsInTable > maxRows) {
					for (var i = 0; i < maxRows; i++) {
						height += table.rows[i].clientHeight;
					}
					wrapper.style.height = height + "px";
				}
			}
			var role = "<?php echo $data['role'] ?>";
			if (role == "admin") {
				document.getElementById('users').style.display = "";
				document.getElementById('changePass').style.display = "";
			} else {
				document.getElementById('users').style.display = "none";
				document.getElementById('changePass').style.display = "none";
			}
			function dsSort() {
				document.getElementById("dsSort").className = "fa fa-sort-desc";
			}
			$(document).ready(function(){
				function getData(){
					$.ajax({
						type: 'POST',
						url: 'table.php',
						success: function(data){
							$('#output').html(data);
						}
					});
				}
				getData();
				setInterval(function () {
					getData(); 
				}, 1000);
			});
		</script>
  </body>
</html>