<?php
	$result ='
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
		<title></title>
	</head>
	<body>
		<div id="titlecont" style="visibility: hidden; position: absolute; width:100%" action="php/1.php" onclick="AjaxGetData(event)" nexttitle="">
			<img src="img/back.png" style="position: absolute; height: 20px; margin-top: 10px; color:#8cc63d">
			<div class="tarifftitle" id="title">
				Тариф "Вода"
			</div>
		</div>
		<div style="display: flex;justify-content: center;min-width: 326px;">
			<div class="bannerwrapper" id="result">
	';
	include "php/1.php";
	$result.='
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/main.js" charset="utf8"></script>
	<script type="text/javascript" src="js/jquery.js" charset="utf8"></script>
	</html>
	';
	echo $result;
?>