<?php

    /* ---------------------------------------------------------------------------
    * filename    : openbuy
    * author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
    * description : This file displays an open requisition for buyers only where
	* they have more options to change columns in the data table and also move
	* the requisition through the process flow as it nears completion.
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
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	$assigned = NULL;
	
	$pdo = Database::connect();
	
	$type = NULL;
	
	$pdo = Database::connect();
	
	$sql = "SELECT * FROM reqs WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$ds = $data['ds'];
	$dueDate = $data['due_date'];
	$progress = $data['progress'];
	$submitted = $data['submitted'];
	$assigned = $data['assigned'];
	$type = $data['type'];
	if ($type == "Alterations") {
		$type = "Viewing PO" . $data['ds'];
	} else {
		$type = "Viewing DS" . $data['ds'];
	}
	
	if ($logedInUsername == $assigned) {
		$sql = "UPDATE comments SET new = 0 WHERE reqs_id = '$id' AND new = 1 AND name != '$logedInUsername'";
		$q = $pdo->prepare($sql);
		$q->execute(array());
	}

	if ($assigned == "Unassigned") {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM users WHERE username = '$logedInUsername'";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		
		$sql = "UPDATE reqs SET progress = 'In-Progress', assigned = '$name' WHERE id = '$id'";
		$q = $pdo->prepare($sql);
		$q->execute(array($progress,$assigned,$id));
		Database::disconnect();
	}
	
	if (!empty($_POST)) {
		// keep track post values
		$dueDate = $_POST['dueDate'];
		$progress = $_POST['progress'];
		$assigned = $_POST['assigned'];
		$buycomment = $_POST['buycomment'];
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT role FROM users WHERE username = '$logedInUsername'";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$role = $data['role'];
		
		if ($dueDate != null) {
			$sql = "UPDATE reqs SET due_date = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($dueDate,$id));
		}
		if ($progress != null) {
			if ($progress == "Done") {
				$urgency = "N";
				$sql = "UPDATE reqs SET urgency = ?, progress = ? WHERE id = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($urgency,$progress,$id));
			} else {
				$sql = "UPDATE reqs SET progress = ? WHERE id = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($progress,$id));
			}
		}
		if ($assigned != null) {
			$sql = "UPDATE reqs SET assigned = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($assigned,$id));
		}
		
		$reqs_id = $id;
		
		if ($buycomment != null) {
			$comment = addslashes($buycomment);
			$new = 1;
			$sql = "INSERT INTO comments(reqs_id, name, comment, new) VALUES ('$reqs_id', '$assigned', '$comment', '$new')";
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$q = $pdo->prepare($sql);
			$q->execute(array());
		}
		
		// Count # of uploaded files in array
		$total = count($_FILES['upload1']['name']);
		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ ) {
			$name = $_FILES['upload1']['name'][$i];
			$name = str_replace("'", "", $name);
			$name = str_replace("#", "", $name);
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			/*if (!in_array($ext, $allowed)) {
				echo 'File types not allowed.';
			} else {*/
				//Get the temp file path
				$tmpFilePath = $_FILES['upload1']['tmp_name'][$i];
				$filePath = str_replace("'", "", $tmpFilePath);
				$filePath = str_replace("#", "", $tmpFilePath);

				//Make sure we have a file path
				if ($filePath != ""){
					//Setup our new file path
					if (!is_dir('uploads/' . $ds . '/')) {
						mkdir('uploads/' . $ds . '/', 0777, true);
					}
					$newFilePath = "uploads/" . $ds . "/" . $_FILES['upload1']['name'][$i];
					$newPath = str_replace("'", "", $newFilePath);
					$newPath = str_replace("#", "", $newFilePath);

					//Upload the file into the temp dir
					if(move_uploaded_file($filePath, $newPath)) {
						//echo "Your file <html><b><i>" . $name . "</i></b></html> has been successfully uploaded";
						$sql = "INSERT INTO attachments(reqs_id, role, name)"
								. " VALUES ('$reqs_id', '$role', '$name')";
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$q = $pdo->prepare($sql);
						$q->execute(array());
					// otherwise, report error
					} else {
						echo "Upload failed for this file. Please see administrator. ";
					}
				}
			//}
		}	
		
		Database::disconnect();
		header("Location: index.php");
			
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM reqs where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$program = $data['program'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/bootstrap.min.js"></script>
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
		.custom-delete {
			font-size: 18px;
			background-color: #b22222;
			color: white;
			border: 1px solid #ccc;
			display: inline-block;
			padding: 12px 18px;
			cursor: pointer;
			transition: all 0.5s;
		}
		.custom-delete span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.custom-delete span:after {
			content: 'Delete';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}
		.custom-delete:hover span {
			padding-right: 60px;
		}
		.custom-delete:hover span:after {
			opacity: 1;
			right: 0;
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
			content: '\f019';
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
		input[type=date] {
		  width: 220px;
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
		.container {
		  border-radius: 5px;
		  background-color: #e6e6e6;
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
	<title>Open</title>
	<div class="topnav">
		<img src="PROSS_Logo.png" href="index.php" alt="Logo" style="width:110px;height:50px;">
        <a href="index.php"><i class="fa fa-list"></i>&ensp;Home</a>
		<a href="create.php"><i class="fa fa-file-text"></i>&ensp;Create New</a>
        <a style="float:right;" href="logout.php">Sign Out&ensp;<i class="fa fa-sign-out"></i></a>
    </div>
	<h1><?php echo $type;?></h1>
	<hr style="width:98%">
    <div class="container">    		
	    <form action="openbuy.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-25">
					<label for="program">Program Name:</label>
				</div>
				<div class="col-75">
					<input name="program" type="text" maxlength="15" value="<?php echo !empty($program)?$program:'';?>">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="type">Requisition Type:</label>
				</div>
				<div class="col-75">
					<select id="progress" name="progress" class="select">
						<option selected="selected"><?php echo $data['type'];?></option>
						<option value="<?php echo empty($progress)?$progress:'Single Source';?>">Single Source</option>
						<option value="<?php echo empty($progress)?$progress:'Open Quote';?>">Open Quote</option>
						<option value="<?php echo empty($progress)?$progress:'Quote Only';?>">Quote Only</option>
						<option value="<?php echo empty($progress)?$progress:'LTA';?>">LTA</option>
						<option value="<?php echo empty($progress)?$progress:'Alterations';?>">Alterations</option>
					</select>
				</div>
			</div>
			<div class="row" id="dueDate">
				<div class="col-25">
					<label for="dueDate">Due Date:</label>
				</div>
				<div class="col-75">
					<input name="dueDate" type="date" value="<?php echo !empty($dueDate)?$dueDate:'';?>">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="progress">Status:</label>
				</div>
				<div class="col-75">
					<select id="progress" name="progress" class="select">
						<option selected="selected"><?php echo $data['progress'];?></option>
						<option value="<?php echo empty($progress)?$progress:'In-Progress';?>">In-Progress</option>
						<option value="<?php echo empty($progress)?$progress:'Tech Review';?>">Tech Review</option>
						<option value="<?php echo empty($progress)?$progress:'Recap';?>">Recap</option>
						<option value="<?php echo empty($progress)?$progress:'Rejected';?>">Rejected</option>
						<option value="<?php echo empty($progress)?$progress:'Done';?>">Done</option>
					</select>
				</div>
		    </div>
			<div class="row">
				<div class="col-25">
					<label for="submitted">Requester:</label>
				</div>
				<div class="col-75">
					<label for="submitted"><?php echo $data['submitted'];?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="assigned">Buyer:</label>
				</div>
				<div class="col-75">
					<select name="assigned" class="select">
						<option selected="selected"><?php echo $data['assigned'];?></option>
						<?php
							$pdo = Database::connect();
							
							$sql = "SELECT * FROM users WHERE role LIKE 'buyer'";

							foreach ($pdo->query($sql) as $row) {
								$id = $row['id'];
								$name = $row['name']; 
								echo '<option value="'.$name.'">'.$name.'</option>';
							}
							
							Database::disconnect();
						?>
					</select>
				</div>
		    </div>
			<div class="row">
				<div class="col-25">
					<label class="attachments">Attachments:</label>
				</div>
				<div class="col-75">
					<?php
						$pdo = Database::connect();
						
						$id = $data['id'];
						$sql = "SELECT * FROM attachments WHERE reqs_id=$id AND role!='buyer' ORDER BY id ASC";

						foreach ($pdo->query($sql) as $row) {
							$attach_id = $row['id'];
							$sql = "SELECT * FROM attachments WHERE id=$attach_id";
							echo '<a class="link" href="uploads/' . $data['ds'] . "/" . $row['name'] . '" download><span>' . substr($row['name'],0,30) . '</span></a><a href="deletefile.php?id='.$id.'&attach_id='.$attach_id.'&loc=buy" class="custom-delete" id="delete" onclick="return clicked();"><span><i class="fa fa-close"></i></span></a>&ensp;&ensp;';
						}
						
						Database::disconnect();
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label class="attachments">Buyer Attachments:</label>
				</div>
				<div class="col-75">
					<hr>
					<?php
						$pdo = Database::connect();
						
						$id = $data['id'];
						$sql = "SELECT * FROM attachments WHERE reqs_id=$id AND role='buyer' ORDER BY id ASC";

						foreach ($pdo->query($sql) as $row) {
							$attach_id = $row['id'];
							$sql = "SELECT * FROM attachments WHERE id=$attach_id";
							echo '<a class="link" href="uploads/' . $data['ds'] . "/" . $row['name'] . '" download><span>' . substr($row['name'],0,30) . '</span></a><a href="deletefile.php?id='.$id.'&attach_id='.$attach_id.'&loc=buy" class="custom-delete" id="delete" onclick="return clicked();"><span><i class="fa fa-close"></i></span></a>&ensp;&ensp;';
						}
						
						Database::disconnect();
					?>
				</div>
			</div>
			<div class="row" id="uploadNew">
				<div class="col-25">
					<label class="newAttach">Upload Additional Files:</label>
				</div>
				<div class="col-75">
					<input id="file1" type="file" style="font-size: 18px" multiple accept=".pdf" name="upload1[]" onchange="javascript:updateList1()">
					<button id="clear" type="button" class="custom-delete custom-delete1" style="padding: 7px 12px;" onclick="clear1()"><span><i class="fa fa-trash"></i></span></button>
					<div id="fileList1"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label class="comments">Comments:</label>
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
			<div class="row">
				<div class="col-25">
					<label class="buycomment">Add Comment:</label>
				</div>
				<div class="col-75">
					<textarea id="buycomment" name="buycomment" placeholder="Comment..." style="height:55px" value="<?php echo !empty($buycomment)?$buycomment:'';?>"></textarea>
				</div>
			</div>
			<div class="row">
			<button class="button button2" type="submit"><span>Update</span></button>
			<button type="button" class="button button1" style="background-color: grey" onclick="location.href='index.php';"><span>Cancel</span></button>
		</div>
		</form>
	</div>
	<script>
		var type = "<?php echo $data['type'] ?>";
		function clicked() {
			return confirm('Are you sure you want to delete this attachment?');
		}
		updateList1 = function() {
			var input = document.getElementById('file1');
			var output = document.getElementById('fileList1');
			var children = "";
			for (var i = 0; i < input.files.length; ++i) {
				children += '<li>' + input.files.item(i).name + '</li>';
			}
			output.innerHTML = '<ul>'+children+'</ul>';
		}
		function clear1() {
			document.getElementById("file1").value = null;
			document.getElementById("fileList1").innerHTML = "";
		}
		if (type == "Open Quote" || type == "Quote Only") {
			document.getElementById("dueDate").style.display = "";
		} else {
			document.getElementById("dueDate").style.display = "none";
		}
	</script>		
  </body>
</html>