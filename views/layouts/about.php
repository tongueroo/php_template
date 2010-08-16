<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>PhpTemplate</title>
</head>
<body>
  <?php partial("header"); ?>
	<div>This is the about layout.  This file is in views/layouts/about.php</div>
	<strong><?php page($router) ?></strong>
  <?php partial("footer"); ?>
</body>
</html>
