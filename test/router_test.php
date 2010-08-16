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

include(dirname(__FILE__).'/../lib/router.php');

class RouterTest extends PHPUnit_Framework_TestCase
{
	// default layout
	public function test_default_layout_yellow_page_because_about_layout_doesnt_exist()
	{
	  $router = new Router('/about/me','/index.php',dirname(__FILE__).'/test_app_default');
	  $router->route();
	  $this->assertEquals('default', $router->layout);
	  $this->assertEquals('me', $router->page);
	}
	public function test_default_layout_index_page()
	{
	 $router = new Router('/','/index.php',dirname(__FILE__).'/test_app_default');
	 $router->route();
	 $this->assertEquals('default', $router->layout);
	 $this->assertEquals('index', $router->page);
	}
	public function test_default_layout_default_page()
	{
	 $router = new Router('/default','/index.php',dirname(__FILE__).'/test_app_default');
	 $router->route();
	 $this->assertEquals('default', $router->layout);
	 $this->assertEquals('index', $router->page);
	}
	// about layout
	public function test_about_layout_me_page()
	{
	 $router = new Router('/about/me','/index.php',dirname(__FILE__).'/test_app_about');
	 $router->route();
	 $this->assertEquals('about', $router->layout);
	 $this->assertEquals('me', $router->page);
	}
  public function test_about_layout_index_page()
  {
   $router = new Router('/about','/index.php',dirname(__FILE__).'/test_app_about');
   $router->route();
   $this->assertEquals('about', $router->layout);
   $this->assertEquals('index', $router->page);
  }
	public function test_about_layout_yellow_page_animals()
	{
	 $router = new Router('/animals/dogs/brian','/index.php',dirname(__FILE__).'/test_app_default');
	 $router->route();
	 $this->assertEquals('default', $router->layout);
	 $this->assertEquals('dogs', $router->page);
	}
	// subdir default layout
	public function test_subdir_default_layout_contact_page()
	{
	 $router = new Router('/subdir/contact','/index.php',dirname(__FILE__).'/test_app_subdir_default');
	 $router->route();
	 $this->assertEquals('default', $router->layout);
	 $this->assertEquals('contact', $router->page);
	}
	public function test_subdir_about_layout_me_page_no_about_layout()
	{
	 $router = new Router('/subdir/about/me','/index.php',dirname(__FILE__).'/test_app_subdir_default');
	 $router->route();
	 $this->assertEquals('default', $router->layout);
	 $this->assertEquals('me', $router->page);
	}
	// subdir about layout
	public function test_subdir_about_layout_index_page()
	{
	 $router = new Router('/subdir/about','/index.php',dirname(__FILE__).'/test_app_subdir_default');
	 $router->route();
	 $this->assertEquals('default', $router->layout);
	 $this->assertEquals('about', $router->page);
	}
	public function test_subdir_about_layout_me_page_found_about_layout()
	{
	 $router = new Router('/subdir/about/me','/index.php',dirname(__FILE__).'/test_app_subdir_about');
	 $router->route();
	 $this->assertEquals('about', $router->layout);
	 $this->assertEquals('me', $router->page);
	}
	public function test_subdir_about_layout_index_page_found_about_layout()
	{
	 $router = new Router('/subdir/about','/index.php',dirname(__FILE__).'/test_app_subdir_about');
	 $router->route();
	 $this->assertEquals('about', $router->layout);
	 $this->assertEquals('index', $router->page);
	}
}

?>