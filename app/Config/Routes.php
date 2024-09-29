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

service('auth')->routes($routes);

$routes->group("", ["filter" => "login"], function($routes) {
    // Articles
    $routes->get('articles/(:num)/delete', 'Articles::confirmDelete/$1');
    $routes->resource('articles',['placeholder' => '(:num)'/*, "filter" => "login"*/]);

    // Images
    $routes->get("articles/(:num)/image/edit", "Articles\Image::new/$1");
    $routes->post("articles/(:num)/image/create", "Articles\Image::create/$1");
    $routes->get("articles/(:num)/image", "Articles\Image::get/$1");
    $routes->delete("articles/(:num)/image/delete", "Articles\Image::delete/$1");

    // Password
    $routes->get('set-password', 'Password::set', ['as' => 'set-password']);
    $routes->post('set-password', 'Password::update');
});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', "filter" => "group:admin"], function($routes) {
    // Users management
    $routes->get('users', 'Users::index');
    $routes->get('users/(:num)', 'Users::show/$1');
    $routes->post('users/(:num)/toggle-ban', 'Users::toggleBan/$1');
    $routes->match(["get","post"],'users/(:num)/groups', 'Users::groups/$1');
    $routes->match(["get","post"],'users/(:num)/permissions', 'Users::permissions/$1');
});