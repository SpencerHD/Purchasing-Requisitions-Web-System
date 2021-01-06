<?php 

    /* ---------------------------------------------------------------------------
    * filename    : join
    * author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
    * description : This program joins a new user through the admin user page.
    * ---------------------------------------------------------------------------
    */

	session_start();
    if (!$_SESSION) {
    header("Location: login.php");
    }

    // include the class that handles database connections
    require 'database.php';
	
	// get current logged in user   
	$logedInUsername = $_SESSION['username'];
	
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
	$product_line = $data['product_line'];
	$user_id = $data['id'];

	if ($role != "admin") {
		header("Location: index.php");
	}

	if (!empty($_POST)) {
		$name = $_POST['name'];
		$last_name = $_POST['last_name'];
		$username = strtoupper(substr($last_name, 0, 7) . substr($name, 0, 1));
		$password = $username;
		$newRole = $_POST['role'];
		$productLine = $_POST['product_line'];
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO users (name,last_name,username,password,role,product_line) values(?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($name,$last_name,$username,$password,$newRole,$productLine));
		Database::disconnect();
		header("Location: users.php");
	}
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
		.tmp {
			margin: 0 auto;
			margin-left: auto;
			margin-right: auto;
			text-align:center;
		}
		input[type=text], select {
			text-align: center;
			font-size: 20px;
			padding: 12px 20px;
			margin: 0px 0px 8px 0px;
			box-sizing: border-box;
			border: 3px solid #ccc;
			-webkit-transition: 0.5s;
			transition: 0.5s;
			outline: none;
		}
		input[type=text]:focus {
			border: 3px solid #555;
		}
		.aligncenter {
            text-align: center;
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
	<div class="topnav">
		<img src="PROSS_Logo.png" href="index" alt="Logo" style="width:110px;height:50px;">
        <a href="index.php"><i class="fa fa-list"></i>&ensp;Home</a>
		<a href="create.php"><i class="fa fa-file-text"></i>&ensp;Create New</a>
		<a style="float:right;" href="logout.php">Sign Out&ensp;<i class="fa fa-sign-out"></i></a>
		<a style="float:right;" href="password.php?id=<?php echo $user_id ?>">Change Password&ensp;<i class="fa fa-unlock-alt"></i></a>
		<a class="active" style="float:right;" href="users.php" id="users">Users&ensp;<i class="fa fa-users"></i></a>
    </div>
    <div class="tmp">
		<div class="tmp">
			<div class="row">
				<h1>Create a New User</h1>
			</div>
			<hr style="width: 98%">

			<form class="tmp" action="join.php" method="post" enctype="multipart/form-data">
				<div class="tmp">
					<label class="control-label" style="font-size: 18px">First Name</label><br>
					<input name="name" type="text" placeholder="First Name" required oninput="this.value = this.value.replace(/[0-9.]/g, '')" maxlength="15" value="<?php echo !empty($name)?$name:'';?>">
				</div>
				<br>
				<div class="tmp">
					<label class="control-label" style="font-size: 18px">Last Name</label><br>
					<input name="last_name" type="text" style="width: 400px" placeholder="Last Name" required oninput="this.value = this.value.replace(/[0-9.]/g, '')" maxlength="20" value="<?php echo !empty($last_name)?$last_name:'';?>">
				</div>
				<br>
				<div class="tmp">
					<label class="control-label" style="font-size: 18px">User Role</label><br>
					<select id="role" name="role" class="select">
						<option value="<?php echo empty($role)?$role:'requester';?>">Requester</option>
						<option value="<?php echo empty($role)?$role:'plm';?>">PLM</option>
						<option value="<?php echo empty($role)?$role:'buyer';?>">Buyer</option>
						<option value="<?php echo empty($role)?$role:'viewer';?>">Viewer</option>
						<option value="<?php echo empty($role)?$role:'admin';?>">Administrator</option>
					</select>
				</div>
				<br>
				<div class="tmp">
					<label class="control-label" style="font-size: 18px">Group</label><br>
					<select id="product_line" name="product_line" class="select">
						<option value="<?php echo empty($product_line)?$product_line:'Columns';?>">Columns</option>
						<option value="<?php echo empty($product_line)?$product_line:'REPS';?>">REPS</option>
						<option value="<?php echo empty($product_line)?$product_line:'CPEPS';?>">CPEPS</option>
						<option value="<?php echo empty($product_line)?$product_line:'Driveline';?>">Driveline</option>
						<option value="<?php echo empty($product_line)?$product_line:'Services';?>">Services</option>
						<option value="<?php echo empty($product_line)?$product_line:'Purchasing';?>">Purchasing</option>
					</select>
				</div>
				<br>
				<button type="button" class="button button1" style="background-color: grey" onclick="history.back()"><span>Back</span></button>
				<button type="submit" class="button button2"><span>Join</span></button>
			</form>
		</div>
				
    </div> <!-- /container -->
  </body>
</html>