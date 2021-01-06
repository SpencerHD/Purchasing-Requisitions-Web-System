<?php 
    
    /* ---------------------------------------------------------------------------
    * filename    : delete
    * author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
    * description : This program deletes a requisition after displaying a prompt
	* for comfirmation.
    * ---------------------------------------------------------------------------
    */

    session_start();
    if (!$_SESSION) {
    header("Location: login.php");
    }
    
    // include the class that handles database connections
    require 'database.php';
    
	$id = 0;
	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if (!empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM reqs where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$ds = $data['ds'];		
		
		$sql = "DELETE FROM reqs WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		$sql = "SELECT * FROM attachments WHERE reqs_id=$id ORDER BY id DESC";
		foreach ($pdo->query($sql) as $row) {
			$attach_id = $row['id'];
			$sql = "SELECT * FROM attachments WHERE id=$attach_id";
			unlink("uploads/" . $ds . "/" . $row['name']);
		}
		if (is_dir('uploads/' . $ds . '/')) {
			rmdir('uploads/' . $ds . '/');
		}
		
		$sql = "DELETE FROM attachments WHERE reqs_id = $id";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		$sql = "DELETE FROM comments WHERE reqs_id = $id";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM reqs where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$ds = $data['ds'];
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
		.column {
          float: left;
          width: 50%;
          padding: 10px;
        }
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
		}
		.tmp {
			margin: 0 auto;
			margin-left: auto;
			margin-right: auto;
			text-align:center;
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
		}
		.button2 span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button2 span:after {
			content: '\00bb';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}
		.button2:hover span {
			padding-right: 25px;
		}
		.button2:hover span:after {
			opacity: 1;
			right: 0;
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
	<title>Delete</title>
	<div class="topnav">
		<img src="PROSS_Logo.png" href="index.php" alt="Logo" style="width:110px;height:50px;">
        <a href="index.php"><i class="fa fa-list"></i>&ensp;Home</a>
		<a class="active" href="create"><i class="fa fa-file-text"></i>&ensp;Create New</a>
        <a style="float:right;" href="logout.php">Sign Out&ensp;<i class="fa fa-sign-out"></i></a>
    </div>
	<h1>Delete DS<?php echo $data['ds'];?></h1>
	<hr style="width:98%">
	
    <div class="container">		    		
		<div class="tmp">
		<p class="alert alert-error">Are you sure you want to delete this requisition? This action cannot be undone.</p>
			<form action="delete" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<button type="button" class="button button1" style="background-color: #b22222" onclick="location.href='index';"><span>No</span></button>
				<button type="submit" class="button button2"><span>Yes</span></button>
			</form>
		</div>
	</div>
  </body>
</html>