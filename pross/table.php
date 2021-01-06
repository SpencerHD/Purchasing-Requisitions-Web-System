<?php
	/* ---------------------------------------------------------------------------
	* filename    : table
	* author      : Spencer Huebler-Davis, spencer.huebler-davis@nexteer.com
	* description : This file handles all of the table data with sql statements
	* selected based on the information requested from the index page.
	* ---------------------------------------------------------------------------
	*/

	require 'database.php';

	$date = date('Y-m-d H:i:s',time()-(4*86400));
	$results_per_page = 12;
	
	session_start();
	if (!$_SESSION) {
		header("Location: login.php");
	}
	$id = null;
	$sort = null;
	$sort_val = null;
	$search = null;
	$search_val = null;
	$report = null;
	
	if ($_SESSION['page'] != null) { 
		$page  = $_SESSION["page"];
	} else {
		$page = 1;
	}
	$start_from = ($page - 1) * $results_per_page;
	
	if ($_SESSION['report'] != null) {
		$report = $_SESSION['report'];
	}
	// get current logged in user   
	$logedInUsername = $_SESSION['username'];
	if ($_SESSION['sort'] != null) {
		$sort_val = $_SESSION['sort'];
	}
	if ($_SESSION['search'] != null) {
		$search_val = $_SESSION['search'];
	}
	if (isset($_GET['search'])) {
		$search_val = $GET['search'];
	}
	$pdo = Database::connect();
	$sql = "SELECT * FROM users WHERE username = '$logedInUsername'";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$name = $data['name'];
	$role = $data['role'];
	$product_line = $data['product_line'];
	$user_id = $data['id'];
		
	if ($role!="requester" && $role != "plm") {
		$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Re-Submitted', 'Submitted', 'Tech Review', 'In-Progress', 'Rejected', 'Recap'), id DESC LIMIT $start_from, ".$results_per_page;
		$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Re-Submitted', 'Submitted', 'Tech Review', 'In-Progress', 'Rejected', 'Recap'), id DESC";
	} else if ($role == "plm" ) {
		$sql = "SELECT * FROM reqs INNER JOIN users ON reqs.submitted = users.name WHERE progress NOT LIKE 'Done' AND users.product_line = '$product_line' LIMIT $start_from, ".$results_per_page;
		$sql_count = "SELECT * FROM reqs INNER JOIN users ON reqs.submitted = users.name WHERE progress NOT LIKE 'Done' AND users.product_line = '$product_line'";
	} else {
		$sql = "SELECT * FROM reqs WHERE submitted='$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Rejected', 'Tech Review', 'In-Progress', 'Submitted', 'Re-Submitted', 'Done'), id DESC LIMIT $start_from, ".$results_per_page;
		$sql_count = "SELECT * FROM reqs WHERE submitted='$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Rejected', 'Tech Review', 'In-Progress', 'Submitted', 'Re-Submitted', 'Done'), id DESC";
	}
	if (isset($_POST['search'])) {
		$search_value=$_POST['search'];
		header("Location: index.php?search=$search_value");
	}
	if ($search_val != null) {
		if (strpos($search_val, '+') !== false) {
			$search_date = explode("+", $search_val);
			$sql = "SELECT * FROM reqs WHERE date BETWEEN '$search_date[0] 00:00:01' AND '$search_date[1] 23:59:59' ORDER BY date DESC LIMIT $start_from, ".$results_per_page;
			$sql_count = "SELECT * FROM reqs WHERE date BETWEEN '$search_date[0] 00:00:01' AND '$search_date[1] 23:59:59'";
		} else if (strpos($search_val, '#') !== false) {
			$search_date = explode("#", $search_val);
			$sql = "SELECT * FROM reqs WHERE (ds LIKE '$search_date[0]' OR submitted LIKE '$search_date[0]' OR assigned LIKE '$search_date[0]' OR program LIKE '$search_date[0]' OR progress LIKE '$search_date[0]' OR type LIKE '$search_date[0]') AND date BETWEEN '$search_date[1] 00:00:01' AND '$search_date[2] 23:59:59' ORDER BY date DESC LIMIT $start_from, ".$results_per_page;
			$sql_count = "SELECT * FROM reqs WHERE (ds LIKE '$search_date[0]' OR submitted LIKE '$search_date[0]' OR assigned LIKE '$search_date[0]' OR program LIKE '$search_date[0]' OR progress LIKE '$search_date[0]' OR type LIKE '$search_date[0]') AND date BETWEEN '$search_date[1] 00:00:01' AND '$search_date[2] 23:59:59'";
		} else {
			$sql = "SELECT * FROM reqs WHERE ds LIKE '$search_val' OR submitted LIKE '$search_val' OR assigned LIKE '$search_val' OR program LIKE '$search_val' OR progress LIKE '$search_val' OR type LIKE '$search_val' ORDER BY date DESC LIMIT $start_from, ".$results_per_page;
			$sql_count = "SELECT * FROM reqs WHERE ds like '$search_val' OR submitted LIKE '$search_val' OR assigned LIKE '$search_val' OR program LIKE '$search_val' OR progress LIKE '$search_val' OR type LIKE '$search_val'";
		}
	}
	if ($search_val == "Active") {
		if ($role!="requester") {
			$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Re-Submitted', 'Submitted', 'Tech Review', 'In-Progress', 'Rejected', 'Recap'), id DESC LIMIT $start_from, ".$results_per_page;
			$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Re-Submitted', 'Submitted', 'Tech Review', 'In-Progress', 'Rejected', 'Recap'), id DESC";
		} else {
			$sql = "SELECT * FROM reqs WHERE submitted='$name' AND progress NOT LIKE 'Done' ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Re-Submitted', 'Submitted', 'Tech Review', 'In-Progress', 'Rejected', 'Recap'), id DESC LIMIT $start_from, ".$results_per_page;
			$sql_count = "SELECT * FROM reqs WHERE submitted='$name' AND progress NOT LIKE 'Done' ORDER BY FIELD(urgency, 'Y', 'N'), FIELD(progress, 'Re-Submitted', 'Submitted', 'Tech Review', 'In-Progress', 'Rejected', 'Recap'), id DESC";
		}
	}
	if ($search_val == "Done") {
		if ($role!="requester") {
			$sql = "SELECT * FROM reqs WHERE progress LIKE 'Done' ORDER BY date DESC LIMIT $start_from, ".$results_per_page;
			$sql_count = "SELECT * FROM reqs WHERE progress LIKE 'Done' ORDER BY date DESC";
		} else {
			$sql = "SELECT * FROM reqs WHERE submitted='$name' AND progress LIKE 'Done' ORDER BY date DESC LIMIT $start_from, ".$results_per_page;
			$sql_count = "SELECT * FROM reqs WHERE submitted='$name' AND progress LIKE 'Done' ORDER BY date DESC";
		}
	}
	if ($report == "Print") {
		$sql = $_SESSION['print'];
		$_SESSION['print'] = null;
	}
	$records = 0;
	foreach ($pdo->query($sql_count) as $row) {
		$records++;
	}
	if ($records != 0) {
		echo '<thead>';
			echo '<tr>';
				if ($report != "Print" && $search_val == null) {
					if ($sort_val != null) {
						if ($sort_val == "dsasc") {
							echo '<th>DS / PO Number&ensp;<a href="index.php?sort=dsdesc"><i class="fa fa-sort-numeric-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY ds ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY ds ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY ds ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY ds ASC";
							}
						} else if ($sort_val == "dsdesc") {
							echo '<th>DS / PO Number&ensp;<a href="index.php?sort=dsasc"><i class="fa fa-sort-numeric-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY ds DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY ds DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY ds DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY ds DESC";
							}
						} else {
							echo '<th>DS / PO Number&ensp;<a href="index.php?sort=dsasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>DS / PO Number&ensp;<a href="index.php?sort=dsasc"><i class="fa fa-sort"></i></a></th>';
					}
					if ($sort_val != null) {
						if ($sort_val == "progasc") {
							echo '<th>Program&ensp;<a href="index.php?sort=progdesc"><i class="fa fa-sort-alpha-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY program ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY program ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY program ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY program ASC";
							}
						} else if ($sort_val == "progdesc") {
							echo '<th>Program&ensp;<a href="index.php?sort=progasc"><i class="fa fa-sort-alpha-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY program DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY program DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY program DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY program DESC";
							}
						} else {
							echo '<th>Program&ensp;<a href="index.php?sort=progasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>Program&ensp;<a href="index.php?sort=progasc"><i class="fa fa-sort"></i></a></th>';
					}
					if ($sort_val != null) {
						if ($sort_val == "statusasc") {
							echo '<th>Status&ensp;<a href="index.php?sort=statusdesc"><i class="fa fa-sort-alpha-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY progress ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY progress ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY progress ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqsWHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY progress ASC";
							}
						} else if ($sort_val == "statusdesc") {
							echo '<th>Status&ensp;<a href="index.php?sort=statusasc"><i class="fa fa-sort-alpha-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY progress DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY progress DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY progress DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY progress DESC";
							}
						} else {
							echo '<th>Status&ensp;<a href="index.php?sort=statusasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>Status&ensp;<a href="index.php?sort=statusasc"><i class="fa fa-sort"></i></a></th>';
					}
					if ($sort_val != null) {
						if ($sort_val == "typeasc") {
							echo '<th>Type&ensp;<a href="index.php?sort=typedesc"><i class="fa fa-sort-alpha-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY type ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY type ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY type ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY type ASC";
							}
						} else if ($sort_val == "typedesc") {
							echo '<th>Type&ensp;<a href="index.php?sort=typeasc"><i class="fa fa-sort-alpha-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY type DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY type DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY type DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY type DESC";
							}
						} else {
							echo '<th>Type&ensp;<a href="index.php?sort=typeasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>Type&ensp;<a href="index.php?sort=typeasc"><i class="fa fa-sort"></i></a></th>';
					}
					if ($sort_val != null) {
						if ($sort_val == "dateasc") {
							echo '<th>Submit Date&ensp;<a href="index.php?sort=datedesc"><i class="fa fa-sort-amount-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submit_date ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submit_date ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submit_date ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submit_date ASC";
							}
						} else if ($sort_val == "datedesc") {
							echo '<th>Submit Date&ensp;<a href="index.php?sort=dateasc"><i class="fa fa-sort-amount-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submit_date DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submit_date DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submit_date DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submit_date DESC";
							}
						} else {
							echo '<th>Submit Date&ensp;<a href="index.php?sort=dateasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>Submit Date&ensp;<a href="index.php?sort=dateasc"><i class="fa fa-sort"></i></a></th>';
					}
					if ($sort_val != null) {
						if ($sort_val == "timeasc") {
							echo '<th>Timestamp&ensp;<a href="index.php?sort=timedesc"><i class="fa fa-sort-amount-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY date ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY date ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY date ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY date ASC";
							}
						} else if ($sort_val == "timedesc") {
							echo '<th>Timestamp&ensp;<a href="index.php?sort=timeasc"><i class="fa fa-sort-amount-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY date DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY date DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY date DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY date DESC";
							}
						} else {
							echo '<th>Timestamp&ensp;<a href="index.php?sort=timeasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>Timestamp&ensp;<a href="index.php?sort=timeasc"><i class="fa fa-sort"></i></a></th>';
					}
					if ($sort_val != null) {
						if ($sort_val == "reqasc") {
							echo '<th>Requester&ensp;<a href="index.php?sort=reqdesc"><i class="fa fa-sort-alpha-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submitted ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submitted ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submitted ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submitted ASC";
							}
						} else if ($sort_val == "reqdesc") {
							echo '<th>Requester&ensp;<a href="index.php?sort=reqasc"><i class="fa fa-sort-alpha-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submitted DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY submitted DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submitted DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY submitted DESC";
							}
						} else {
							echo '<th>Requester&ensp;<a href="index.php?sort=reqasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>Requester&ensp;<a href="index.php?sort=reqasc"><i class="fa fa-sort"></i></a></th>';
					}
					if ($sort_val != null) {
						if ($sort_val == "buyasc") {
							echo '<th>Buyer&ensp;<a href="index.php?sort=buydesc"><i class="fa fa-sort-alpha-asc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY assigned ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY assigned ASC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY assigned ASC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY assigned ASC";
							}
						} else if ($sort_val == "buydesc") {
							echo '<th>Buyer&ensp;<a href="index.php?sort=buyasc"><i class="fa fa-sort-alpha-desc"></i></a></th>';
							if ($role != "requester") {
								$sql = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY assigned DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE progress NOT LIKE 'Done' ORDER BY assigned DESC";
							} else {
								$sql = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY assigned DESC LIMIT $start_from, ".$results_per_page;
								$sql_count = "SELECT * FROM reqs WHERE submitted = '$name' AND (CASE WHEN progress LIKE 'Done' THEN date>='$date' WHEN progress NOT LIKE 'Done' THEN date END) ORDER BY assigned DESC";
							}
						} else {
							echo '<th>Buyer&ensp;<a href="index.php?sort=buyasc"><i class="fa fa-sort"></i></a></th>';
						}
					} else {
						echo '<th>Buyer&ensp;<a href="index.php?sort=buyasc"><i class="fa fa-sort"></i></a></th>';
					}
				} else {
					echo '<th>DS / PO Number</th>';
					echo '<th>Program</th>';
					echo '<th>Status</th>';
					echo '<th>Type</th>';
					echo '<th>Date</th>';
					echo '<th>Timestamp</th>';
					echo '<th>Requester</th>';
					echo '<th>Buyer</th>';
				}
			echo '</tr>';
		echo '</thead>';
	} else if ($report != "Print") {
		echo "<thead><tr><th style='font-size: 24px'>You're all caught up! <i class='fa fa-smile-o'></i></th></tr></thead>";
	}
	echo '<tbody>';
	$records = 0;
	foreach ($pdo->query($sql_count) as $row) {
		$records++;
	}
	foreach ($pdo->query($sql) as $row) {
		$counter = 0;
		$new_count = 0;
		$counter2 = 0;
		$new_count2 = 0;
		$sql_com = "SELECT * FROM comments WHERE reqs_id = ". $row['id'] ."";
		$q = $pdo->prepare($sql_com);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		if ($row['progress']=="Done" && $report != "Print") {
			echo '<tr style="background-color:#c2f0c2">';
		} else if ($row['progress']=="Rejected" && $report != "Print") {
			echo '<tr style="background-color:#ff9999">';
		} else if ($row['urgency'] == "Y" && $report != "Print") {
			echo '<tr style="background-color:#ffc14d">';
		} else if ($row['progress'] == "Recap" && $report != "Print") {
			echo '<tr style="background-color:#ffe866">';
		} else if (($row['progress']=="Re-Submitted" || $row['progress']=="Submitted") && $report != "Print") {
			echo '<tr style="background-color:#bbd0f7">';
		} else {
			echo '<tr>';
		}
		if ($row['urgency'] == "Y" && $row['progress'] != "Done") {
			echo '<td><i class="fa fa-fire"></i>&ensp;'. $row['ds'] . '</td>';
		} else {
			echo '<td>'. $row['ds'] . '</td>';
		}
		echo '<td>'. $row['program'] . '</td>';
		echo '<td>'. $row['progress'] . '</td>';
		if ($row['progress'] == "Recap") {
			if ($row['due_date'] != null && $row['progress'] != "Done") {
				echo '<td><i class="fa fa-paperclip"></i>&ensp;'. $row['type'] . '<p>Due Date: '. date("m-d", strtotime($row['due_date'])) .'</p></td>';
			} else {
				echo '<td><i class="fa fa-paperclip"></i>&ensp;'. $row['type'] . '</td>';
			}
		} else {
			if ($row['due_date'] != null && $report != "Print" && $row['progress'] != "Done") {
				echo '<td>'. $row['type'] . '<p>Due Date: '. date("m-d", strtotime($row['due_date'])) .'</p></td>';
			} else {
				echo '<td>'. $row['type'] . '</td>';
			}
		}
		echo '<td>'. date("m-d-Y",strtotime($row['submit_date'])) . '</td>';
		echo '<td>'. date("m-d-Y / h:i:s a",strtotime($row['date'])) . '</td>';
		if ($data['comment'] != null && $report != "Print") {
			foreach ($pdo->query($sql_com) as $row2) {
				if ($row2['name'] == $row['submitted'] && $row2['comment'] != null) {
					$counter = $counter + 1;
					if ($row2['new']) {
						$new_count = 1;
					}
				} else if ($row2['name'] == $row['assigned'] && $row2['comment'] != null) {
					$counter2 = $counter2 + 1;
					if ($row2['new']) {
						$new_count2 = 1;
					}
				}
			}
			if ($counter == 1) {
				if ($new_count > 0 && $row['progress'] != "Done") {
					echo '<td><i class="fa fa-comment"></i>&ensp;'. $row['submitted'] . '<p>New Comment</p></td>';
				} else {
					echo '<td><i class="fa fa-comment"></i>&ensp;'. $row['submitted'] . '</td>';
				}
			} else if ($counter > 1) {
				if ($new_count > 0 && $row['progress'] != "Done") {
					echo '<td><i class="fa fa-comments"></i>&ensp;'. $row['submitted'] . '<p>New Comment</p></td>';
				} else {
					echo '<td><i class="fa fa-comments"></i>&ensp;'. $row['submitted'] . '</td>';
				}
			}else if ($counter < 1) {
				echo '<td>'. $row['submitted'] . '</td>';
			}
			if ($counter2 == 1) {
				if ($new_count2 > 0 && $row['progress'] != "Done") {
					echo '<td><i class="fa fa-comment"></i>&ensp;'. $row['assigned'] . '<p>New Comment</p></td>';
				} else {
					echo '<td><i class="fa fa-comment"></i>&ensp;'. $row['assigned'] . '</td>';
				}
			} else if ($counter2 > 1) {
				if ($new_count2 > 0 && $row['progress'] != "Done") {
					echo '<td><i class="fa fa-comments"></i>&ensp;'. $row['assigned'] . '<p>New Comment</p></td>';
				} else {
					echo '<td><i class="fa fa-comments"></i>&ensp;'. $row['assigned'] . '</td>';
				}
			}else if ($counter2 < 1) {
				echo '<td>'. $row['assigned'] . '</td>';
			}
		} else {
			echo '<td>'. $row['submitted'] . '</td>';
			echo '<td>'. $row['assigned'] . '</td>';
		}
		if ($report != "Print") {
			echo '<td style="text-align:left;" width="280">';
			echo '<a class="btn btn-info" href="display?id='.$row['id'].'"><i class="fa fa-file-o"></i>&ensp;View</a>';
			echo '&nbsp;';
			if ($role == "requester" && $row['progress'] != "Done") {
				echo '<a class="btn btn-warning" href="open?id='.$row['id'].'">Open</a>';
			} else if ($role=="buyer" && ($row['assigned']=="Unassigned" || $row['assigned']==$name)) {
				echo '<a class="btn btn-warning" href="openbuy?id='.$row['id'].'"><i class="fa fa-folder-open"></i>&ensp;Open</a>';
			} else if ($role=="admin") {
				echo '<a class="btn btn-warning" href="openadm?id='.$row['id'].'"><i class="fa fa-user"></i>&ensp;Admin</a>';
			}
			echo '&nbsp;';
			if (($role=="admin" || ($role=="buyer" && $row['assigned']==$name)) || ($row['submitted']==$name && $row['assigned']=="Unassigned")) {
				echo '<a class="btn btn-danger" href="delete?id='.$row['id'].'"><i class="fa fa-trash"></i>&ensp;Delete</a>';
			}
			echo '</td>';
		}
		echo '</tr>';
	}
	echo '</tbody>';
	
	$total_pages = ceil($records / $results_per_page);
	$current_page = null;
	$prev_page = null;
	$start = ($page - 1) * 5;
	if ($report != "Print") {
		if ($page > 1) {
			echo "<td colspan='9'>Page: ";
			$prev_page = $page - 1;
			if ($search_val != null) {
				echo "<a class='pages' href='index.php?search=".$search_val."&page=1'><<</a>";
				echo "<a class='pages' href='index.php?search=".$search_val."&page=".$prev_page."'><</a>";
			} else {
				echo "<a class='pages' href='index.php?page=1'><<</a>";
				echo "<a class='pages' href='index.php?page=".$prev_page."'><</a>";
			}
		} else if ($records != 0) {
			echo "<td colspan='9'>Page: ";
		}
		for ($i = $page; $i <= $page + 4; $i++) {
			if ($i <= $total_pages) {
				if ($i == $page) {
					if ($i == 1) {
						echo $i . "&ensp;";
					} else {
						echo "&ensp;" . $i . "&ensp;";
					}
				} else {
					if ($search_val != null) {
						echo "<a class='pages' href='index.php?search=".$search_val."&page=".$i."'>".$i."</a>";
					} else {
						echo "<a class='pages' href='index.php?page=".$i."'>".$i."</a>";
					}
				}
			}
		}
		if ($page != $total_pages) {
			$next_page = $page + 1;
			if ($search_val != null) {
				echo "<a class='pages' href='index.php?search=".$search_val."&page=".$next_page."'>></a>";
				echo "<a class='pages' href='index.php?search=".$search_val."&page=".$total_pages."'>>></a>";
			} else {
				echo "<a class='pages' href='index.php?page=".$next_page."'>></a>";
				echo "<a class='pages' href='index.php?page=".$total_pages."'>>></a>";
			}
		}
		echo "</td>";
	}
	$_SESSION['print'] = $sql;
	Database::disconnect();
?>