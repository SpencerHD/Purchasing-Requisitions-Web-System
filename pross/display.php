<?php 

    /* ---------------------------------------------------------------------------
    * filename    : display
    * author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
    * description : This program displays the current information for the
	* selected requisition in view-only mode.
    * ---------------------------------------------------------------------------
    */

    session_start();
    if (!$_SESSION) {
    header("Location: login.php");
    }
	
	// get current logged in user   
	$logedInUsername = $_SESSION['username'];

    // include the class that handles database connections
    require 'database.php';
    
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM users WHERE username = '$logedInUsername'";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$role = $data['role'];
	
	$type = NULL;
	
	$sql = "SELECT * FROM reqs WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$submitted = $data['submitted'];
	$assigned = $data['assigned'];
	$type = $data['type'];
	if ($type == "Alterations") {
		$type = "Viewing PO" . $data['ds'];
	} else {
		$type = "Viewing DS" . $data['ds'];
	}
	
	if ($logedInUsername == $submitted) {
		$sql = "UPDATE comments SET new = 0 WHERE reqs_id = '$id' AND new = 1 AND name != '$logedInUsername'";
		$q = $pdo->prepare($sql);
		$q->execute(array());
	} else if ($logedInUsername == $assigned) {
		$sql = "UPDATE comments SET new = 0 WHERE reqs_id = '$id' AND new = 1 AND name != '$logedInUsername'";
		$q = $pdo->prepare($sql);
		$q->execute(array());
	}
	
	Database::disconnect();
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM reqs where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		* {
		  box-sizing: border-box;
		}
        img {
          display: block;
          margin-left: auto;
          margin-right: auto;
        }
        h1 {
            text-align: center;
        }
		p {
			font-size: 20px;
			margin-bottom: 12px;
			margin-top: 0px;
		}
		.tmp {
			text-align: center;
		}
		.link {
			display: inline-block;
			border-radius: 4px;
			background-color: #b3b3b3;
			border: none;
			color: white;
			text-align: center;
			padding: 14px 25px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 5px;
		}
		.link span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.link span:after {
			font-family: FontAwesome;
			content: '\f08e';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}
		.link:hover span {
			padding-right: 25px;
		}
		.link:hover span:after {
			opacity: 1;
			right: 0;
		}
		input[type=text], select, textarea {
		  width: 100%;
		  padding: 12px 20px;
		  margin: 8px 0;
		  box-sizing: border-box;
		  border: 3px solid #ccc;
		  -webkit-transition: 0.5s;
		  transition: 0.5s;
		  outline: none;
		  font-size: 18px;
		}
		input[type=text]:focus {
		  border: 3px solid #555;
		}
        label {
		  padding: 12px 12px 12px 0;
		  display: inline-block;
		  font-size: 20px;
		}
		.button {
			display: inline-block;
			border-radius: 4px;
			background-color: #009900;
			border: none;
			color: #FFFFFF;
			text-align: center;
			font-size: 20px;
			padding: 10px;
			width: 120px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 5px;
			float: right;
		}
		.button span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button span:after {
			content: '\00ab';
			position: absolute;
			opacity: 0;
			top: 0;
			left: -20px;
			transition: 0.5s;
		}
		.button:hover span {
			padding-left: 25px;
		}
		.button:hover span:after {
			opacity: 1;
			left: 0;
		}
		.container {
		  border-radius: 5px;
		  padding: 20px;
		  margin: 8px;
		}
		.col-25 {
		  float: left;
		  width: 25%;
		  margin-top: 6px;
		}
		.col-75 {
		  float: left;
		  width: 75%;
		  margin-top: 6px;
		}
		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
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
		@media screen and (max-width: 600px) {
		  .col-25, .col-75{
			width: 100%;
			margin-top: 0;
		  }
			.topnav a{
				float: none;
				display: block;
				text-align: left;
				width: 100%;
				margin: 0;
				padding: 14px;
			}
		}
    </style>
</head>
<body>
	<title>View</title>
	<div class="topnav">
		<img src="PROSS_Logo.png" href="index.php" alt="Logo" style="width:110px;height:50px;">
        <a href="index.php"><i class="fa fa-list"></i>&ensp;Home</a>
		<a href="create.php"><i class="fa fa-file-text"></i>&ensp;Create New</a>
        <a style="float:right;" href="logout.php">Sign Out&ensp;<i class="fa fa-sign-out"></i></a>
    </div>
	<h1><?php echo $type;?></h1>
	<hr style="width: 98%">

	<div class="container">
		<div class="row">
			<div class="col-25">
				<label for="program"><b>Program Name:</b></label>
			</div>
			<div class="col-25">
				<label for="program"><?php echo $data['program'];?></label>
			</div>
			<div class="col-25">
				<label for="type"><b>Requisition Type:</b></label>
			</div>
			<div class="col-25">
				<label for="type"><?php echo $data['type'];?></label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-25">
				<label for="progress"><b>Current Status:</b></label>
			</div>
			<div class="col-25">
				<label for="progress"><?php echo $data['progress'];?></label>
			</div>
			<div class="col-25">
				<label for="date"><b>Latest Timestamp:</b></label>
			</div>
			<div class="col-25">
				<label for="date"><?php echo date("m-d-Y h:i:s a",strtotime($data['date']));?></label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-25">
				<label for="submitted"><b>Requester:</b></label>
			</div>
			<div class="col-25">
				<label for="submitted"><?php echo $data['submitted'];?></label>
			</div>
			<div class="col-25">
				<label for="assigned"><b>Buyer:</b></label>
			</div>
			<div class="col-25">
				<label for="assigned"><?php echo $data['assigned'];?></label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-25">
				<label class="attachments"><b>Attachments:</b></label>
			</div>
			<div class="col-75">
				<?php
					$pdo = Database::connect();
					
					$id = $data['id'];
					$sql = "SELECT * FROM attachments WHERE reqs_id=$id AND role!='buyer' ORDER BY id ASC";

					foreach ($pdo->query($sql) as $row) {
						$id = $row['id'];
						$sql = "SELECT * FROM attachments WHERE id=$id";
						echo "<a class='link' target='_blank' href='uploads/" . $data['ds'] . "/" . $row['name'] . "'><span>" . substr($row['name'],0,30) . "</span></a>";
					}
					
					Database::disconnect();
				?>
			</div>
		</div>
		<br>
		<div class="row" id="buyAttachments">
			<div class="col-25">
				<label class="attachments"><b>Buyer Attachments:</b></label>
			</div>
			<div class="col-75">
				<hr>
				<?php
					$pdo = Database::connect();
					
					$id = $data['id'];
					$sql = "SELECT * FROM attachments WHERE reqs_id=$id AND role='buyer' ORDER BY id ASC";

					foreach ($pdo->query($sql) as $row) {
						$id = $row['id'];
						$sql = "SELECT * FROM attachments WHERE id=$id";
						echo "<a class='link' target='_blank' href='uploads/" . $data['ds'] . "/" . $row['name'] . "'><span>" . substr($row['name'],0,30) . "</span></a>";
					}
					
					Database::disconnect();
				?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-25">
				<label class="comments"><b>Comments:</b></label>
			</div>
			<div class="col-75">
				<?php
					$pdo = Database::connect();
					
					$id = $data['id'];
					$counter = 0;
					$sql = "SELECT * FROM comments WHERE reqs_id=$id ORDER BY id ASC";

					foreach ($pdo->query($sql) as $row) {
						$counter = $counter + 1;
						$comment_id = $row['id'];
						$sql = "SELECT * FROM comments WHERE id=$comment_id";
						echo '<p style="font-size: 16px;">'.  $row['name'] .' @ '. date("m-d-Y / h:i:s a",strtotime($row['timestamp'])) .'</p><p>'. $row['comment'] .'</p><hr />';
					}
					if ($counter == 0) {
						echo "<p>No comments</p>";
					}
					
					Database::disconnect();
				?>
			</div>
		</div>
		<br>
		<br>
		<form action="index">
			<button type="submit" class="button" style="background-color: grey"><span>Back</span></button>
		</form>
	</div>
	<script type="text/javascript">
	</script>
</body>
</html>