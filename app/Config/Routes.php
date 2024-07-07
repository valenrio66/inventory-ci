<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// User
$routes->get('/login', 'User::login');
$routes->post('user/attemptLogin', 'User::attemptLogin');
$routes->get('/dashboard','Dashboard::index', ['filter' => 'auth']);
$routes->get('/dashboard/user/add','User::renderPageCreateUser', ['filter' => 'auth']);
$routes->post('/user/create','User::createUser', ['filter' => 'auth']);
$routes->get('user/logout', 'User::logout');