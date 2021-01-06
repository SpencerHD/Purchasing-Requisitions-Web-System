<?php

/* ---------------------------------------------------------------------------
* filename    : users
* author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
* description : This file displays the users table for admins to view,
* update, reset passwords, and delete users.
* ---------------------------------------------------------------------------
*/

session_start();
if (!$_SESSION) {
	header("Location: login.php");
}
$id = null;

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

if ($role != "admin") {
	header("Location: index.php");
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
            border: 1px solid black;
        }
        .scrollingTable {
            overflow-y: auto;
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
        
        .topnav .search-container {
          float: left;
        }
        
        .topnav input[type=text] {
          padding: 6px;
          margin-top: 8px;
		  margin-left: 18px;
          font-size: 17px;
          border: none;
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
			.topnav a, .topnav input[type=text], .topnav .search-container button {
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
        <a href="index.php"><i class="fa fa-list"></i>&ensp;Home</a>
		<a href="create.php"><i class="fa fa-file-text"></i>&ensp;Create New</a>
        <div class="search-container">
            <form action="users.php" method="post">
              <input type="text" placeholder="Search Users..." name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
		<a style="float:right;" href="logout.php">Sign Out&ensp;<i class="fa fa-sign-out"></i></a>
		<a style="float:right;" href="password.php?id=<?php echo $user_id ?>">Change Password&ensp;<i class="fa fa-unlock-alt"></i></a>
		<a class="active" style="float:right;" href="users.php" id="users">Users&ensp;<i class="fa fa-users"></i></a>
    </div>

        <img src="PROSS_Logo.png" alt="Logo" style="width:500px;height:200px;" class="center">
            <div class="column">
                <h2><b>Users List</b></h2>
            </div>
			<div class="column">
                <a style="float:right; margin:5px;" href="join.php" name="newUser" class="btn btn-success"><i class="fa fa-user-plus"></i>&ensp;Add New User</a>
            </div>
			<hr style="width:100%">
			<div class="scrollingTable">
				<table class="table table-striped table-bordered" id="myTable">
					<thead>
						<tr>
							<th style="text-align:center;">ID</th>
							<th style="text-align:center;">Name</th>
							<th style="text-align:center;">Last Name</th>
							<th style="text-align:center;">Username</th>
							<th style="text-align:center;">Password</th>
							<th style="text-align:center;">Role</th>
							<th style="text-align:center;">Product Line</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$truncatePass = null;
							$pdo = Database::connect();
							$sql = 'SELECT * FROM users ORDER BY id ASC';
							
							if (isset($_POST['search'])) {
								$search_value=$_POST['search'];
								$sql = "SELECT * FROM users WHERE name LIKE '$search_value'"; 
							}
							
							foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
								echo '<td style="text-align:center;">'. $row['id'] . '</td>';
								echo '<td style="text-align:center;">'. $row['name'] . '</td>';
								echo '<td style="text-align:center;">'. $row['last_name'] . '</td>';
								echo '<td style="text-align:center;">'. $row['username'] . '</td>';
								if ($row['username'] == $row['password']) {
									echo '<td style="text-align:center;">'. $row['password'] .'</td>';
								} else {
									for( $i=0; $i < strlen($row['password']); $i++) {
										$truncatePass = "*" . $truncatePass;
									}
									echo '<td style="text-align:center;">'. $truncatePass .'</td>';
								}
								echo '<td style="text-align:center;">'. $row['role'] . '</td>';
								echo '<td style="text-align:center;">'. $row['product_line'] . '</td>';
								echo '<td width=200>';
								echo '<a class="btn btn-info" href="edit.php?id='.$row['id'].'"><i class="fa fa-pencil-square-o"></i>&ensp;Edit</a>';
								echo '&nbsp;';
								echo '<a class="btn btn-danger" href="deleteuser.php?id='.$row['id'].'" onclick="return delete_clicked();"><i class="fa fa-user-times"></i>&ensp;Delete</a>';
								echo '&nbsp;';
								echo '</td>';
								echo '</tr>';
							}
							Database::disconnect();
						?>
					</tbody>
				</table>
			</div>
		<script>
			var role = "<?php echo $data['role'] ?>";
			if (role == "admin") {
				document.getElementById('users').style.display = "";
			} else {
				document.getElementById('users').style.display = "none";
			}
			function makeTableScroll() {
				var maxRows = 11;

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
			function pass_clicked() {
				return confirm('Are you sure you want to reset this user password?');
			}
			function delete_clicked() {
				return confirm('Are you sure you want to delete this user?');
			}
		</script>
  </body>
</html>