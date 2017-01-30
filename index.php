<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<title>Customers Feedback</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://eshop.soslocksmith.bg/price/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="http://localhost/price/js/javaScript.js"></script>
	<link rel="stylesheet" type="text/css" href="http://eshop.soslocksmith.bg/price/css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

<meta name="robots" content="noindex,follow" />
</head>

<body >


<!-- Graph HTML -->
<div  id="button-wrapper">

	<select id="category"></select>
	<button id="find"> Find</button>
    <input id="priceCorrection" type="text"></input>
    <button id="correct"> Correct</button>
	<h5 id="shipping_method">PRODUCTS</h5>


</div>
<div id="container" class="col-md-12" >



</div>
<div id="login">
	<label for="username">Username</label>
	<input type="text"  id="username" placeholder="Enter DB username"><br>
	<label for="female">Password</label>
	<input type="text"  id="password" placeholder="Enter DB password"><br>
	<label for="female">Database</label>
	<input type="text"  id="database" placeholder="Enter DB name"><br>
	<button id="connect">Connect to DB </button>

</div>

<!-- end Graph HTML -->





<script>

</script>

</body>

</html>