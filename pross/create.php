<?php 

    /* ---------------------------------------------------------------------------
    * filename    : create
    * author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
    * description : This program creates a new requisition with the DS number,
	* auto creates the submitter, date, and allows the user to upload documents
	* and add comments to their submission.
    * ----------------------------------------------------------------------------
    */

    session_start();
    if (!$_SESSION) {
    header("Location: login.php");
    }
	
	// get current logged in user   
	$logedInUsername = $_SESSION['username'];
    
    $id = null;
	if (!empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

    // include the class that handles database connections
    require_once 'database.php';
    
    date_default_timezone_set("America/New_York");

	if (!empty($_POST)) {
		// keep track validation errors
		$programError = null;
		$dsError = null;
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM users WHERE username = '$logedInUsername'";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$submitted = $data['name'];
		
		// keep track post values
		$program = $_POST['program'];
		$ds = $_POST['ds'];
		$type = $_POST['type'];
		$submit_date = date("Y-m-d");
		$date = date("Y-m-d H:i:s");
		$assigned = "Unassigned";
		$expcomment = $_POST['expcomment'];
		
		// validate input
		$valid = true;
		
		$sql = "SELECT ds FROM reqs WHERE ds='$ds'";
		foreach ($pdo->query($sql) as $row) {
			if ($_POST['type'] != null) {
				if ($row['ds'] == $ds && $_POST['type'] != "Alterations") {
					$dsError = 'DS# already exists. Please enter another valid number or PO#.';
					$valid = false;
				}
			} else {
				if ($row['ds'] == $ds) {
					$dsError = 'DS# already exists. Please enter another valid number or PO#.';
					$valid = false;
				}
			}
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT role FROM users WHERE username = '$logedInUsername'";
			$q = $pdo->prepare($sql);
			$q->execute(array($id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			$role = $data['role'];
			
			if (isset($_POST['urgency'])) {
				$urgency = "Y";
				$sql = "INSERT INTO reqs (program, ds, urgency, type, submit_date, date, submitted, assigned) values(?, ?, ?, ?, ?, ?, ?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($program,$ds,$urgency,$type,$date,$date,$submitted,$assigned));
			} else {
				$urgency = "N";
				$sql = "INSERT INTO reqs (program, ds, urgency, type, submit_date, date, submitted, assigned) values(?, ?, ?, ?, ?, ?, ?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($program,$ds,$urgency,$type,$date,$date,$submitted,$assigned));
			}
			
			$last_id = $pdo->lastInsertId();
			
			// set PHP variables from data in HTML form
			$reqs_id = $last_id;
			
			if ($expcomment != null) {
				$comment = addslashes($expcomment);
				$new = 1;
				$sql = "INSERT INTO comments(reqs_id, name, comment, new) VALUES ('$reqs_id', '$submitted', '$comment', '$new')";
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$q = $pdo->prepare($sql);
				$q->execute(array());
			}
			
			// Allowed file types
			$allowed = array('.pdf', '.zip', '.stp', '.x_t', '.dwg', '.png', '.html');
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
			header("Location: index.php");
		}
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
		input[type=checkbox] {
			margin-top: 10px;
			position: absolute;
	        cursor: pointer;
		}
		input[type=checkbox]:before {
			 content: "";
			 display: block;
			 position: relative;
			 width: 44px;
			 height: 44px;
			 top: 0;
			 left: 0;
			 border: 2px solid grey;
			 border-radius: 3px;
			 background-color: white;
		}
		input[type=checkbox]:checked:after {
			font-family: FontAwesome;
			content: '\f12a';
			 font-size: 40px;
			 display: block;
			 width: 20px;
			 height: 36px;
			 border: solid black;
			 border-width: 0 0 0 0;
			 position: absolute;
			 top: 5px;
			 left: 17px;
		}
		.custom-delete {
			font-size: 18px;
			background-color: #b22222;
			color: white;
			border: 1px solid #ccc;
			display: inline-block;
			padding: 6px 12px;
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
			content: 'Clear';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}
		.custom-delete:hover span {
			padding-right: 50px;
		}
		.custom-delete:hover span:after {
			opacity: 1;
			right: 0;
		}
        label {
		  padding: 12px 12px 12px 0;
		  display: inline-block;
		  font-size: 18px;
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

<body onload="updateType()">
	<title>Create</title>
	<div class="topnav">
		<img src="PROSS_Logo.png" href="index" alt="Logo" style="width:110px;height:50px;">
        <a href="index"><i class="fa fa-list"></i>&ensp;Home</a>
		<a class="active" href="create"><i class="fa fa-file-text"></i>&ensp;Create New</a>
        <a style="float:right;" href="logout">Sign Out&ensp;<i class="fa fa-sign-out"></i></a>
    </div>
	<h1>Create a New Requisition</h1>
	<hr style="width:98%">

<div class="container">
	<form id="create" action="create" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-25">
				<label id="changeNumType" for="ds"><b>DS#:</b></label>
			</div>
			<div class="col-75">
				<input name="ds" type="text" required style="width: 90%" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*)\./g, '$1');" maxlength="6" placeholder="DS# / PO#" value="<?php echo !empty($ds)?$ds:'';?>">
				<label for="urgency" style="font-size: 20px; margin-left: 1%;">Hot</label>
				<input type="checkbox" id="urgency" name="urgency">
				<?php if (!empty($dsError)): ?>
					<br><span class="help-inline" style="color: red"><?php echo $dsError;?></span>
				<?php endif;?>
			</div>
		</div>
		<div class="row">
			<div class="col-25">
				<label id="program" for="program"><b>Program:</b></label>
			</div>
			<div class="col-75">
				<input name="program" type="text" required maxlength="15" placeholder="Program" value="<?php echo !empty($program)?$program:'';?>">
			</div>
		</div>
		<div class="row">
			<div class="col-25">
				<label for="type"><b>Type:</b></label>
			</div>
			<div class="col-75">
				<select id="type" name="type" onchange="updateType()" class="select">
					<option value="<?php echo !empty($type)?$type:'Single Source';?>">Single Source</option>
					<option value="<?php echo !empty($type)?$type:'Open Quote';?>">Open Quote</option>
					<option value="<?php echo !empty($type)?$type:'Quote Only';?>">Quote Only</option>
					<option value="<?php echo !empty($type)?$type:'LTA';?>">LTA</option>
					<option value="<?php echo !empty($type)?$type:'Alterations';?>">Alterations</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-25">
				<p id="change"><b>Requirements:</b></p>
			</div>
			<div class="col-75">
				<div id="attach1">
					<select id="changeReq1" name="req" onchange="updateReqs()" class="select">
					</select>
					<div id="reqList"></div>
					<div id="reasons"><a href="AlterationsReasons.pdf" target="_blank">Reasons for Alterations&ensp;<i class="fa fa-external-link"></i></a><br><br></div>
					<input id="file1" type="file" style="font-size: 18px" required multiple accept=".pdf, .zip, .png, .html, .x_t, .dwg, .stp" name="upload1[]" onchange="javascript:updateList1()">
					<button type="button" class="custom-delete" onclick="clear1()"><span><i class="fa fa-trash"></i></span></button>
					<p style="font-size: 16px">Note: Hold Shift to select multiple files or drag and drop required files.</p>
					<div id="fileList1"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-25">	
				<label class="control-label"><b>Comment:</b></label> 
			</div>
			<div class="col-75">
				<textarea id="expcomment" name="expcomment" placeholder="Comment..." style="height:55px" value="<?php echo !empty($expcomment)?$expcomment:'';?>"></textarea>
			</div>
		</div>
		<div class="row">
			<button class="button button2" type="submit"><span>Create</span></button>
			<button type="button" class="button button1" style="background-color: grey" onclick="location.href='index';"><span>Cancel</span></button>
		</div>
	</form>
</div>
    <script>
		var options = [
			req1 = ["Quote", "Print", "P-149 (if Engineering WO#)"],
			req2 = ["Print", "P-149 (if Engineering WO#)"],
			req3 = ["Quote", "P-149 (if Engineering WO#)"],
			req4 = ["Print and Reference Print (if applicable)", "P-149 (if Engineering WO#)"],
			req5 = ["Router (if applicable)", "Quote", "Print", "P-149 (if Engineering WO#)"],
			req6 = ["Please provide supporting documents for your ALT reason"],
			req7 = ["CAD", "Print", "P-149 (if Engineering WO#)"]
		];
		function makeUL(array) {
			// Create the list element:
			var list = document.createElement('ul');

			for (var i = 0; i < array.length; i++) {
				// Create the list item:
				var item = document.createElement('li');

				// Set its contents:
				item.appendChild(document.createTextNode(array[i]));

				// Add it to the list:
				list.appendChild(item);
			}

			// Finally, return the constructed list:
			return list;
		}
		document.getElementById('reqList').appendChild(makeUL(options[2]));
		function updateType() {
			var requirements = [
				req1 = ["PPAP", "Engineering Controlled", "Full IMC", "Partial IMC", "Shelf Item"],
				req2 = ["Engineering Controlled", "Full IMC", "Partial IMC"],
				req3 = ["Full IMC", "Partial IMC"]
			];
			document.getElementById('reqList').innerHTML = "";
			var x = document.getElementById("type").value;
			var selectReq = document.getElementById("changeReq1");
			selectReq.innerHTML = "";
			var reqOptions = requirements[0];
			var numType = "DS#:";
			var numType2 = "PO#:";
			if (x == "Quote Only") {
				document.getElementById("changeNumType").innerHTML = numType.bold();
				document.getElementById("changeReq1").style.display = "";
				document.getElementById("reasons").style.display = "none";
				document.getElementById('reqList').appendChild(makeUL(options[1]));
				document.getElementById("file1").setAttribute("required", "required");
				var reqOptions = requirements[1];
			} else if (x == "Open Quote") {
				document.getElementById("changeNumType").innerHTML = numType.bold();
				document.getElementById("changeReq1").style.display = "";
				document.getElementById("reasons").style.display = "none";
				document.getElementById('reqList').appendChild(makeUL(options[6]));
				document.getElementById("file1").setAttribute("required", "required");
				var reqOptions = requirements[1];
			}else if (x == "Single Source") {
				document.getElementById("changeNumType").innerHTML = numType.bold();
				document.getElementById("changeReq1").style.display = "";
				document.getElementById("reasons").style.display = "none";
				document.getElementById('reqList').appendChild(makeUL(options[2]));
				document.getElementById("file1").setAttribute("required", "required");
				var reqOptions = requirements[0];
			} else if (x == "LTA") {
				document.getElementById("changeNumType").innerHTML = numType.bold();
				document.getElementById("changeReq1").style.display = "";
				document.getElementById("reasons").style.display = "none";
				document.getElementById('reqList').appendChild(makeUL(options[4]));
				document.getElementById("file1").setAttribute("required", "required");
				var reqOptions = requirements[2];
			} else {
				document.getElementById("changeNumType").innerHTML = numType2.bold();
				document.getElementById("changeReq1").style.display = "none";
				document.getElementById("reasons").style.display = "";
				document.getElementById('reqList').appendChild(makeUL(options[5]));
				document.getElementById("file1").removeAttribute("required");
			}
			for(var i = 0; i < reqOptions.length; i++) {
				var opt = reqOptions[i];
				selectReq.innerHTML += "<option value=\"" + opt + "\">" + opt + "</option>";
			}
        }
		function updateReqs() {
			document.getElementById('reqList').innerHTML = "";
			var req = document.getElementById("changeReq1").value;
			var type = document.getElementById("type").value;
			if ((req == "Full IMC" && type == "Single Source") || (req == "Partial IMC" && type == "Single Source")) {
				document.getElementById('reqList').appendChild(makeUL(options[0]));
			} else if ((req == "Engineering Controlled" && type == "Quote Only") || (req == "Full IMC" && type == "Quote Only")) {
				document.getElementById('reqList').appendChild(makeUL(options[1]));
			} else if (req == "PPAP" || req == "Shelf Item" || (req == "Engineering Controlled" && type == "Single Source")) {
				document.getElementById('reqList').appendChild(makeUL(options[2]));
			} else if ((req == "Engineering Controlled" || req == "Full IMC" || req == "Partial IMC") && type == "Open Quote") {
				document.getElementById('reqList').appendChild(makeUL(options[6]));
			} else if ((req == "Full IMC" && type == "LTA") || (req == "Partial IMC" && type == "LTA")) {
				document.getElementById('reqList').appendChild(makeUL(options[4]));
			} else if (req == "Partial IMC") {
				document.getElementById('reqList').appendChild(makeUL(options[3]));
			} else {
				document.getElementById('reqList').appendChild(makeUL(options[5]));
			}
		}
		updateList1 = function() {
			var files = [];
			var input = document.getElementById('file1');
			var output = document.getElementById('fileList1');
			var children = "";
			for (var i = 0; i < input.files.length; ++i) {
				children += '<li>' + input.files.item(i).name + '</li>';
				files += input.files.item(i);
			}
			output.innerHTML += '<ul>'+children+'</ul>';
		}
		clear1 = function() {
			document.getElementById("file1").value = null;
			document.getElementById("fileList1").innerHTML = "";
		}
    </script>
  </body>
</html>