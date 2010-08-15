#!/usr/bin/env ruby

class Router
  attr_reader :layout, :page
  def initialize(request_uri, script_name, root)
    @request_uri = request_uri
    @script_name = script_name
    @root = root
  end
  
  def route!
    args = @request_uri.split('/')
    if args.length == 0    # '/'.split('/') => []
      @layout = 'default'
      @page = 'index'
    elsif args.length == 2 # '/about'.split('/') => ["", "about"]
      @layout = 'default'
      @page = args[1]
    elsif args # '/about/me'.split('/') => ["", "about", "me"]
      @layout = args[1]
      path = File.expand_path("#{@root}/layouts/#{@layout}.php")
      if File.exist?(path)
        # if about layout exists use it
      else
        @layout = 'default' # else fallback to the default layout
      end
      @page = args[2]
    end
  end
end

# http://php-template.local/gallery/dogs/yellow
# $_SERVER['REQUEST_URI']: /gallery/dogs/yellow
# $_SERVER['SCRIPT_NAME']: /index.php
# 
# http://php-template.local/
# $_SERVER['REQUEST_URI']: /
# $_SERVER['SCRIPT_NAME']: /index.php
#
# http://php-template.local/about/yellow
# $_SERVER['REQUEST_URI']: /about/yellow
# $_SERVER['SCRIPT_NAME']: /index.php
describe Router do
  it "default layout yellow page because about layout doesnt exist" do
    @router = Router.new("/about/yellow","/index.php", File.dirname(__FILE__)+"/test_app_default")
    @router.route!
    @router.layout.should == "default"
    @router.page.should == "yellow"
  end
  it "default layout index page" do
    @router = Router.new("/","/index.php", File.dirname(__FILE__)+"/test_app_default")
    @router.route!
    @router.layout.should == "default"
    @router.page.should == "index"
  end
  it "default layout default page" do
    @router = Router.new("/default","/index.php", File.dirname(__FILE__)+"/test_app_default")
    @router.route!
    @router.layout.should == "default"
    @router.page.should == "default"
  end
  it "default layout about page" do
    @router = Router.new("/about","/index.php", File.dirname(__FILE__)+"/test_app_default")
    @router.route!
    @router.layout.should == "default"
    @router.page.should == "about"
  end
  it "about layout yellow page" do
    @router = Router.new("/about/yellow","/index.php", File.dirname(__FILE__)+"/test_app_about")
    @router.route!
    @router.layout.should == "about"
    @router.page.should == "yellow"
  end
  it "about layout yellow page" do
    @router = Router.new("/animals/dogs/brian","/index.php", File.dirname(__FILE__)+"/test_app_about")
    @router.route!
    @router.layout.should == "default"
    @router.page.should == "dogs"
  end
end