<?php
/**
 * Routes Configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */


    Router::parseExtensions('rss', 'atom');

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));

	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/admin', array(
	    'controller' => 'users',
	    'action' => 'dashboard',
	    'admin' => true
    ));

    // SearchItems
	Router::connect('/search/*', array('controller' => 'search_items', 'action' => 'index'));

	// Product RSS feeds
	Router::connect('/feed', array(
	    'controller' => 'products',
	    'action' => 'feed',
	    'url' => array('ext' => 'rss')
    ));

    // Product tabs nested resources
    Router::connect(
        '/admin/products/:parent_id/tabs/*',
        array('controller' => 'products', 'action' => 'tabs', 'admin' => true),
        array('pass' => array('parent_id'))
    );

    // Category subs nested resources
    Router::connect(
        '/admin/categories/:parent_id/subs',
        array('controller' => 'categories', 'action' => 'subs', 'admin' => true),
        array('pass' => array('parent_id'))
    );
    Router::connect(
        '/categories/:slug/submenus',
        array('controller' => 'categories', 'action' => 'submenus'),
        array('pass' => array('slug'))
    );
    Router::connect(
        '/categories/:parent_slug/lists/:slug/*',
        array('controller' => 'categories', 'action' => 'lists'),
        array('pass' => array('parent_slug', 'slug'))
    );

    // Rating subs nested resources
    Router::connect(
        '/admin/ratings/:parent_id/subs',
        array('controller' => 'ratings', 'action' => 'subs', 'admin' => true),
        array('pass' => array('parent_id'))
    );

    // ProductInfo nested resources
    Router::connect(
        '/admin/products/:product_id/office',
        array('controller' => 'product_infos', 'action' => 'office', 'admin' => true),
        array('pass' => array('product_id'))
    );

	// ProductRating nested resources
	Router::connect(
	    '/admin/products/:product_id/ratings',
	    array('controller' => 'product_ratings', 'action' => 'index', 'admin' => true),
	    array('pass' => array('product_id'))
    );
    Router::connect(
	    '/admin/products/:product_id/ratings/add',
	    array('controller' => 'product_ratings', 'action' => 'add', 'admin' => true),
	    array('pass' => array('product_id'))
    );
    Router::connect(
	    '/admin/products/:product_id/ratings/delete/:id',
	    array('controller' => 'product_ratings', 'action' => 'delete', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );
    Router::connect(
	    '/admin/products/:product_id/ratings/move_up/:id',
	    array('controller' => 'product_ratings', 'action' => 'move_up', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );
    Router::connect(
	    '/admin/products/:product_id/ratings/move_down/:id',
	    array('controller' => 'product_ratings', 'action' => 'move_down', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );

    //ProductService nested resources
    Router::connect(
	    '/admin/products/:product_id/services',
	    array('controller' => 'product_services', 'action' => 'index', 'admin' => true),
	    array('pass' => array('product_id'))
    );
    Router::connect(
	    '/admin/products/:product_id/services/add',
	    array('controller' => 'product_services', 'action' => 'add', 'admin' => true),
	    array('pass' => array('product_id'))
    );
    Router::connect(
	    '/admin/products/:product_id/services/delete/:id',
	    array('controller' => 'product_services', 'action' => 'delete', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );
    Router::connect(
	    '/admin/products/:product_id/services/move_up/:id',
	    array('controller' => 'product_services', 'action' => 'move_up', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );
    Router::connect(
	    '/admin/products/:product_id/services/move_down/:id',
	    array('controller' => 'product_services', 'action' => 'move_down', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );

    // ProductGallery nested resources
    Router::connect(
	    '/admin/products/:product_id/galleries',
	    array('controller' => 'product_galleries', 'action' => 'index', 'admin' => true),
	    array('pass' => array('product_id'))
    );
    Router::connect(
	    '/admin/products/:product_id/galleries/add',
	    array('controller' => 'product_galleries', 'action' => 'add', 'admin' => true),
	    array('pass' => array('product_id'))
    );
    Router::connect(
	    '/admin/products/:product_id/galleries/edit/:id',
	    array('controller' => 'product_galleries', 'action' => 'edit', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );
    Router::connect(
	    '/admin/products/:product_id/galleries/delete/:id',
	    array('controller' => 'product_galleries', 'action' => 'delete', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );
    Router::connect(
	    '/admin/products/:product_id/galleries/move_up/:id',
	    array('controller' => 'product_galleries', 'action' => 'move_up', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );
    Router::connect(
	    '/admin/products/:product_id/galleries/move_down/:id',
	    array('controller' => 'product_galleries', 'action' => 'move_down', 'admin' => true),
	    array('pass' => array('product_id', 'id'))
    );

    Router::connect(
	    '/products/:parent_category_slug/list/:category_id/:category_slug',
	    array('controller' => 'products', 'action' => 'listing'),
	    array('pass' => array('category_id'))
    );
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
//	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
