<?php

/* ---------------------------------------------------------------------------
* filename    : report
* author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
* description : This file displays a print report based on the previously
* selected data from the index screen and allows the user to print.
* ---------------------------------------------------------------------------
*/

session_start();
if (!$_SESSION) {
	header("Location: login.php");
}
$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
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
			width: 100px;
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
			content: '\00ab';
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
        input[type=number], input[type=date] {
          padding: 6px;
          margin-top: 8px;
		  margin-left: 0px;
          font-size: 17px;
          border: none;
		  width: 180px;
		  height: 36px;
        }
		.search-container {
          float: left;
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
        .search-container button:hover {
          background: #ccc;
        }
        @media screen and (max-width: 600px) {
			.search-container {
				float: none;
			}
			.search-container button {
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
	<title>Report</title>
            <div class="column">
                <h2><b>Print Report</b></h2>
            </div>
            <div class="column">
				<button name="report" class="button button5" style="background-color: #5F9EA0" type="button" onclick="window.print()"><span>Print</span></button>
				<button name="report" class="button button1" style="background-color: grey" type="button" onclick="location.href='index.php';"><span>Cancel</span></button>
            </div>
			<hr style="width:100%">
			<div id="infos">
				<table class="table table-striped table-bordered" id="output">
				</table>
			</div>
		<script type="text/javascript">
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