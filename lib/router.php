<?php

class Router
{
	public $layout;
	public $page;
	
	public function layout() {
		return $this->layout;
	}
	public function page() {
		return $this->page;
	}
	
	function __construct($request_uri, $script_name, $root) {
		$this->request_uri = $request_uri;
		$this->script_name = $script_name;
		$this->root = $root;
	}
	
	public function route() {
    $request_uri = explode('/', $this->request_uri);
    $script_name = explode('/', $this->script_name);
		// removes the unwanted blank item at the beginning and index.php if it is in the request_uri
		for($i= 0;$i < sizeof($script_name);$i++)
    	if ($request_uri[$i] == $script_name[$i] || empty($request_uri[$i]))
      	unset($request_uri[$i]);
    $args = array_values($request_uri);

		$c = count($args);
    // echo "request_uri : $this->request_uri \n";
    // echo "c : $c \n";
    // echo "args : $args \n";
    // print_r($args);
    // echo "\n";
		if ($c == 0) {
			$this->layout = 'default';
			$this->page = 'index';
		} elseif ($c == 1) {
			$this->layout = 'default';
			$this->page = $args[0];
		} else {
			$this->layout = $args[0];
			$this->page = $args[1];
      $path = $this->root."/views/layouts/".$this->layout.".php";
      if (file_exists($path)) {
        # if named layout exists use it
      } else {
        $this->layout = 'default';  # else fallback to the default layout
      }
      $this->page = $args[1];
		}
	}
}

?>