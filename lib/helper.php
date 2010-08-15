<?php
// helper methods to be used in the views

function check_page($router)
{
  GLOBAL $environment;
  if ($environment == 'production') {
    $path = $router->layout.'/'.$router->page.'.php';
    if (!file_exists($path)) {
      header("HTTP/1.0 404 Not Found");
      exit;
    }
  }
}

function include_page($router)
{
  $path = $router->layout.'/'.$router->page.'.php';
  if (file_exists($path))
    include($path);
  else
    echo "WARNING: $path file could not be found";
}
	

?>
