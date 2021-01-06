<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        img {
          display: block;
          margin-left: auto;
          margin-right: auto;
        }
        .tmp {
            margin: 0 auto;
            margin-left: auto;
            margin-right: auto;
            text-align:center;
        }
        input[type=text], input[type=password] {
          width: 25%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
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
		.button span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		.button span:after {
			font-family: FontAwesome;
			content: '\f090';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}
		.button:hover span {
			padding-right: 25px;
		}
		.button:hover span:after {
			opacity: 1;
			right: 0;
		}
        body { 
            animation: fadeInAnimation ease 1s; 
            animation-iteration-count: 1; 
            animation-fill-mode: forwards; 
        } 
        @keyframes fadeInAnimation { 
            0% { 
                opacity: 0; 
            } 
            100% { 
                opacity: 1; 
            } 
        }
    </style>
</head>
	<body>
		<br>
		<br>
		<br>
		<br>

		<img src="PROSS_Logo.png" alt="Logo" style="width:500px;height:200px;">

		<br>

		<form class="form-horizontal" action="login" method="post">
			<p style="text-align:center; font-size: 22px;">Purchasing Requisition Online Submission System</p>
			<br>
			<br>
			<br>
			<div class="tmp">
				<p>Site is currently down while being transferred to Nexteer server. Please use emails in the meantime. Thanks for your patience!</p>
			</div>
		</form>
		<script>
		</scipt>
	</body>
</html>