PhpTemplate
===========

A staring template for new php projects.

It provides a very basic router which handles the routing of urls to layouts and pages in the views directory.

This project already includes some starter view files in the /views directory to help you get going as soon as possible.  The organization of the views structure is the key: 

<pre>
views
|-- about
|   |-- index.php
|   `-- me.php
|-- default
|   |-- contact.php
|   `-- index.php
`-- layouts
    |-- _footer.php
    |-- _header.php
    |-- about.php
    `-- default.php
</pre>

The layouts/default.php is the default layout and will be used most of the time, especially for simple site layouts.  A few examples will make urls to file mapping clear.

In your web browers, going to:

* / -> will render the layouts/default.php and include the default/index.php page in that layout.
* /contact -> will render the layouts/default.php and include the default/contact.php page in that layout.
* /default/contact -> same as the /contact url.

The routing logic starts to change if new layout files exists that matches the url, like in the case for the layouts/about.php layout.

* /about => since a layouts/about.php file exists, it will use that file for the layout and render the about/index.php page.
* /about/index => same as /about url.
* /about/me => since a layouts/about.php file exists, it will use that file for the layout and render the about/me.php page.

What happens when the layouts don't exist?  The layout falls back to the layouts/default.php.  More examples:

* /colors => since a layouts/colors.php file does not exists, it will use the layouts/default.php layout and render the default/colors.php page.
* /colors/blue => since a layouts/colors.php does not file exists, it will use the layouts/default.php and render the default/blue.php page.

The reasoning behind these conventions is so that the designer does not have to update a configuration when he or she needs to add a new layout.  He can just add the layout and it will be picked up.

Getting the Starter Code
===========

If you have git installed:

<pre>
$ git clone http://github.com/tongueroo/php_template.git
$ mv php_tempate your_project_name
</pre>

If you do not have git installed:

Go to http://github.com/tongueroo/php_template and click on the "Download Source" link.

Misc
===========
For programmers familiar with MVC: 
This is meant to be a very thin layer of routing to views; there is no support for database connections and the concept of controllers has not been introduced on purposes. 

Running tests:
The router specs are in the /test directory and can be ran with: $ phpunit test/router_test.php.