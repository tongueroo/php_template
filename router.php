<?php

// to test: http://php-template.local/foo/bar

$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
 
for($i= 0;$i < sizeof($scriptName);$i++)
        {
      if ($requestURI[$i] == $scriptName[$i])
              {
                unset($requestURI[$i]);
            }
      }
 
$command = array_values($requestURI);


echo $_SERVER['REQUEST_URI'].'<br />';
echo $_SERVER['SCRIPT_NAME'].'<br />';
echo 'requestUri '.$requestUri.'<br />';
echo 'scriptName '.$scriptName.'<br />';
print_r($scriptName);
echo '<br />';
echo 'command '.$command.'<br />';
print_r($command);
echo '<br />';
?>

