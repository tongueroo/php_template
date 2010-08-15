<?php

// to test: http://php-template.local/foo/bar

$request_uri = explode('/', $_SERVER['REQUEST_URI']);
$script_name = explode('/',$_SERVER['SCRIPT_NAME']);
 
echo "\$_SERVER['REQUEST_URI']: ".$_SERVER['REQUEST_URI'].'<br />';
echo "\$_SERVER['SCRIPT_NAME']: ".$_SERVER['SCRIPT_NAME'].'<br />';

// echo 'request_uri: '; print_r($request_uri); echo '<br />';
// echo 'request_uri[0]: '.$request_uri[0].'<br />';
// echo 'request_uri[1]: '.$request_uri[1].'<br />';
// echo 'request_uri[2]: '.$request_uri[2].'<br />';

echo 'request_uri : ';
print_r($request_uri);
echo "<br />";
echo 'script_name : ';
print_r($script_name);
echo "<br />";

for($i= 0;$i < sizeof($script_name);$i++)
{
	if ($request_uri[$i] == $script_name[$i])
  {
  	unset($request_uri[$i]);
	}
}
 
$command = array_values($request_uri);

echo '<hr />';

echo 'request_uri: '; print_r($request_uri); echo '<br />';
echo 'script_name: '; print_r($script_name); echo '<br />';
echo 'command: '; print_r($command); echo '<br />';

echo '<hr />';

echo 'request_uri[0]: '.$request_uri[0].'<br />';
echo 'request_uri[1]: '.$request_uri[1].'<br />';
echo 'request_uri[2]: '.$request_uri[2].'<br />';

echo 'script_name[0]: '.$script_name[0].'<br />';
echo 'script_name[1]: '.$script_name[1].'<br />';

echo 'command[0]: '.$command[0].'<br />';
echo 'command[1]: '.$command[1].'<br />';
echo 'command[2]: '.$command[2].'<br />';

echo '<hr />';

echo "\$_SERVER{'DOCUMENT_ROOT'}: ".$_SERVER{'DOCUMENT_ROOT'}.'<br />';

?>

