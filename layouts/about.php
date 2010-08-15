<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>PhpTemplate</title>
</head>
<body>
	<?php include("layouts/_header.php"); ?>
	<div>This is the about layout.  This file is in layouts/about.php</div>
	<?php render_page($router) ?>
	<?php include("layouts/_footer.php"); ?>
</body>
</html>
