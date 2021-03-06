<?php

/* ---------------------------------------------------------------------------
* filename    : deleteuser
* author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
* description : This file deletes a user from the admin user screen after
* receiving the user ID from the page.
* ---------------------------------------------------------------------------
*/

session_start();
if (!$_SESSION) {
	header("Location: login.php");
}
$id = null;

// get current logged in user   
$logedInUsername = $_SESSION['username'];
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}
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

if ($id != NULL) {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM users WHERE id = $id";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
}

header("Location: users.php");
?>