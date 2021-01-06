<?php

/* ---------------------------------------------------------------------------
* filename    : deletefile
* author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
* description : This file handles the file deletion by receiving the file
* ID from another page and deletes it from the database and file system.
* ---------------------------------------------------------------------------
*/

session_start();
if (!$_SESSION) {
	header("Location: login.php");
}
$attach_id = null;
$id = null;
$loc = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}
if (!empty($_GET['attach_id'])) {
	$attach_id = $_REQUEST['attach_id'];
}
if (!empty($_GET['loc'])) {
	$loc = $_REQUEST['loc'];
}
// include the class that handles database connections
require 'database.php';

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM reqs WHERE id=$id";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
$ds = $data['ds'];
Database::disconnect();

if ($attach_id != NULL) {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM attachments WHERE id=$attach_id";
	$q = $pdo->prepare($sql);
	$q->execute(array($attach_id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$attach_name = $data['name'];
	unlink("uploads/" . $ds . "/" . $attach_name);
	$sql = "DELETE FROM attachments WHERE id = $attach_id";
	$q = $pdo->prepare($sql);
	$q->execute(array($attach_id));
	Database::disconnect();
}

header('Location: open.php'. $loc .'?id='. $id .'');
?>