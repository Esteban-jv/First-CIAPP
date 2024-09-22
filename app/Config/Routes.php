<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
/*$routes->get('articles', 'Articles::index');
$routes->get('articles/(:num)', 'Articles::show/$1');
$routes->get('articles/create', 'Articles::create', ['as' => 'create_article']);
$routes->post('articles', 'Articles::store');
$routes->get('articles/(:num)/edit', 'Articles::edit/$1');
$routes->put('articles/(:num)', 'Articles::update/$1');
$routes->delete('articles/delete/(:num)', 'Articles::delete/$1');*/

$routes->get('articles/(:num)/delete', 'Articles::confirmDelete/$1');
$routes->resource('articles',['placeholder' => '(:num)']);

service('auth')->routes($routes);
