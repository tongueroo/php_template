<?php

require("lib/environment.php");
require("lib/router.php");
require("lib/helper.php");

$router = new Router($_SERVER['REQUEST_URI'],$_SERVER['SCRIPT_NAME'],$_SERVER{'DOCUMENT_ROOT'});
$router->route();

// echo "\$_SERVER['REQUEST_URI']: ".$_SERVER['REQUEST_URI'].'<br />';
// echo "\$_SERVER['SCRIPT_NAME']: ".$_SERVER['SCRIPT_NAME'].'<br />';
// 
// echo "layout: ".$router->layout()."<br />";
// echo "page: ".$router->page()."<br />";

check_page($router);
include("layouts/".$router->layout.".php");

?>
