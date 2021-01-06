<?php
	/* ---------------------------------------------------------------------------
    * filename    : update
    * author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
    * description : This file updates a requisition.
    * ---------------------------------------------------------------------------
    */
	
	// include the class that handles database connections
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if (!empty($_POST)) {
		// keep track post values
		$progress = "In-Progress";
		$assigned = "New User";
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE reqs set progress = ?, assigned = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($progress,$assigned,$id));
		Database::disconnect();
		header("Location: index.php");
			
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM reqs where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$progress = $data['progress'];
		$assigned = $data['assigned'];
		$expcomment = $data['expcomment'];
		Database::disconnect();
	}
?>