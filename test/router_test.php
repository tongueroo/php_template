<?php
require_once 'PHPUnit/Framework.php';

// had to install a bunch of stuff
// PEAR:
// http://www.phpunit.de/manual/current/en/installation.html
// http://www.newmediacampaigns.com/page/install-pear-phpunit-xdebug-on-macosx-snow-leopard
// and making sure that the pear gets installed in /usr/local
// also editig the /etc/php.ini file was tricky, the correct include_path is
// sh-3.2# grep 'include_path' /etc/php.ini | grep -v ';'
// include_path = ".:/usr/local/PEAR:/usr/lib/php/pear:/php/includes"
// then apachectl restart
 
// to run test
// $ phpunit --verbose foo.php 

/// http://www.phpunit.de/manual/current/en/api.html#api.assert

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
      $path = $this->root."/layouts/".$this->layout.".php";
      if (file_exists($path)) {
        # if named layout exists use it
      } else {
        $this->layout = 'default';  # else fallback to the default layout
      }
      $this->page = $args[1];
		}
	}
}

class RouterTest extends PHPUnit_Framework_TestCase
{
  public function test_default_layout_yellow_page_because_about_layout_doesnt_exist()
  {
    $router = new Router('/about/me','/index.php',dirname(__FILE__).'/test_app_default');
    $router->route();
    $this->assertEquals('default', $router->layout());
    $this->assertEquals('me', $router->page());
  }
  public function test_default_layout_index_page()
  {
   $router = new Router('/','/index.php',dirname(__FILE__).'/test_app_default');
   $router->route();
   $this->assertEquals('default', $router->layout());
   $this->assertEquals('index', $router->page());
  }
  public function test_default_layout_default_page()
  {
   $router = new Router('/default','/index.php',dirname(__FILE__).'/test_app_default');
   $router->route();
   $this->assertEquals('default', $router->layout());
   $this->assertEquals('default', $router->page());
  }
  public function test_about_layout_me_page()
  {
   $router = new Router('/about/me','/index.php',dirname(__FILE__).'/test_app_about');
   $router->route();
   $this->assertEquals('about', $router->layout());
   $this->assertEquals('me', $router->page());
  }
  public function test_default_layout_about_page()
  {
   $router = new Router('/about','/index.php',dirname(__FILE__).'/test_app_about');
   $router->route();
   $this->assertEquals('default', $router->layout());
   $this->assertEquals('about', $router->page());
  }
  public function test_about_layout_yellow_page_animals()
  {
   $router = new Router('/animals/dogs/brian','/index.php',dirname(__FILE__).'/test_app_default');
   $router->route();
   $this->assertEquals('default', $router->layout());
   $this->assertEquals('dogs', $router->page());
  }
}

?>