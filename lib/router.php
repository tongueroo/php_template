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
    	if ($request_uri[$i] == "index.php" || empty($request_uri[$i]))
      	unset($request_uri[$i]);
    $args = array_values($request_uri);
    
	  // possible subdir if code uploaded to a subdirectory http://www.site.com/subdir/
	  // not the root for the http://www.site.com/
	  // remove the subdir from the Array and run regular logic
    $subdir = $args[0];
    $lib_path = dirname(__FILE__);
    if (strpos($lib_path, $subdir)) {
      $subdir_found = true;
      unset($args[0]);
    }
    $args = array_values($args);  // remove subdir
    // echo "args :";
    // print_r($args);
    // echo "subdir_found : $subdir_found";
    
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
			if ($subdir_found)
		    $path = $this->root."/$subdir/views/layouts/".$this->layout.".php";
	    else
		    $path = $this->root."/views/layouts/".$this->layout.".php";
      // echo "%%% path $path<br />\n";

      if (file_exists($path)) {
        # if named layout exists use it
        // echo "keeping ".$this->layout. " layout<br />\n";
      } else {
        // echo "reseting to default layout <br />\n";
        $this->layout = 'default';  # else fallback to the default layout
      }
    }
  }
}

?>