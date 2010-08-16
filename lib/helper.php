<?php
// helper methods to be used in the views

function check_not_found($router)
{
  GLOBAL $environment;
  if ($environment == 'production') {
    $path = 'views/'.$router->layout.'/'.$router->page.'.php';
    if (!file_exists($path)) {
      header("HTTP/1.0 404 Not Found");
      exit;
    }
  }
}

function page($router)
{
  $path = 'views/'.$router->layout.'/'.$router->page.'.php';
  // $full_path = $router->root.'/'.$path;
  // echo "full_path $full_path";
  if (file_exists($path))
    include($path);
  else
    echo '<span style="background-color:red">WARNING: '.$path.' file could not be found</span>';
}

function partial($name)
{
  include("views/layouts/_$name.php");
}
	

?>
