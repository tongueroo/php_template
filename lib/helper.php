<?php
// helper methods to be used in the views

function check_not_found($router)
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

function render_page($router)
{
  $path = $router->layout.'/'.$router->page.'.php';
  if (file_exists($path))
    include($path);
  else
    echo '<span style="background-color:red">WARNING: $path file could not be found</span>';
}
	

?>
