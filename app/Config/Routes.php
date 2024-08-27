<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes For Authentification
$routes->get('/', 'Auth::login');
$routes->get('/dashboard', 'Home::index', ['filter' => 'auth']);
$routes->get('/register', 'Auth::register');
$routes->post('auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/logout', 'Auth::logout');

// User
$routes->get('/dashboard/user', 'User::getAllUser', ['filter' => 'auth']);
$routes->get('/dashboard/user/detail/(:segment)', 'User::renderPageDetailUser/$1', ['filter' => 'auth']);
$routes->get('/dashboard/user/add', 'User::renderPageCreateUser', ['filter' => 'auth']);
$routes->post('/user/create', 'User::createUser', ['filter' => 'auth']);
$routes->get('/dashboard/user/update/(:segment)', 'User::renderPageUpdateUser/$1', ['filter' => 'auth']);
$routes->post('/user/update/(:segment)', 'User::updateUser/$1', ['filter' => 'auth']);
$routes->get('/user/delete/(:segment)', 'User::deleteUser/$1', ['filter' => 'auth']);
$routes->get('/dashboard/profile/(:segment)', 'User::renderPageProfileUser/$1', ['filter' => 'auth']);

// Gudang
$routes->get('/dashboard/gudang', 'Gudang::getAllGudang', ['filter' => 'auth']);
$routes->get('/dashboard/gudang/add', 'Gudang::renderPageAddGudang', ['filter' => 'auth']);
$routes->post('/gudang/add', 'Gudang::addGudang', ['filter' => 'auth']);
$routes->get('/dashboard/gudang/detail/(:segment)', 'Gudang::renderPageDetailGudang/$1', ['filter' => 'auth']);
$routes->get('/dashboard/gudang/update/(:segment)', 'Gudang::renderPageUpdateGudang/$1', ['filter' => 'auth']);
$routes->post('/gudang/update/(:segment)', 'Gudang::updateGudang/$1', ['filter' => 'auth']);
$routes->get('/gudang/delete/(:num)', 'Gudang::deleteGudang/$1', ['filter' => 'auth']);

// Rak
$routes->get('/dashboard/rak', 'Rak::getAllRak', ['filter' => 'auth']);
$routes->get('/dashboard/rak/add', 'Rak::renderPageAddRak', ['filter' => 'auth']);
$routes->post('/rak/add', 'Rak::addRak', ['filter' => 'auth']);
$routes->get('/dashboard/rak/detail/(:segment)', 'Rak::renderPageDetailRak/$1', ['filter' => 'auth']);
$routes->get('/dashboard/rak/update/(:segment)', 'Rak::renderPageUpdateRak/$1', ['filter' => 'auth']);
$routes->post('/rak/update/(:segment)', 'Rak::updateRak/$1', ['filter' => 'auth']);
$routes->get('/rak/delete/(:num)', 'Rak::deleteRak/$1', ['filter' => 'auth']);

// Box
$routes->get('/dashboard/box', 'Box::getAllBox', ['filter' => 'auth']);
$routes->get('/dashboard/box/add', 'Box::renderPageAddBox', ['filter' => 'auth']);
$routes->post('/box/add', 'Box::addBox', ['filter' => 'auth']);
$routes->get('/dashboard/box/detail/(:segment)', 'Box::renderPageDetailBox/$1', ['filter' => 'auth']);
$routes->get('/dashboard/box/update/(:segment)', 'Box::renderPageUpdateBox/$1', ['filter' => 'auth']);
$routes->post('/box/update/(:segment)', 'Box::updateBox/$1', ['filter' => 'auth']);
$routes->get('/box/delete/(:segment)', 'Box::deleteBox/$1', ['filter' => 'auth']);

// Barang
$routes->get('/dashboard/barang', 'Barang::getAllBarang', ['filter' => 'auth']);
$routes->get('/dashboard/barang/add', 'Barang::renderPageAddBarang', ['filter' => 'auth']);
$routes->post('/barang/add', 'Barang::addBarang', ['filter' => 'auth']);
$routes->get('/dashboard/barang/detail/(:segment)', 'Barang::renderPageDetailBarang/$1', ['filter' => 'auth']);
$routes->get('/dashboard/barang/update/(:segment)', 'Barang::renderPageUpdateBarang/$1', ['filter' => 'auth']);
$routes->post('/barang/update/(:segment)', 'Barang::updateBarang/$1', ['filter' => 'auth']);

// Pengiriman Barang
$routes->get('/dashboard/pengirimanbarang', 'PengirimanBarang::index', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/dashboard/pengirimanbarang/add', 'PengirimanBarang::create', ['filter' => 'auth']);
$routes->match(['get', 'post'],'/dashboard/pengirimanbarang/suratpengiriman', 'PengirimanBarang::suratPengiriman', ['filter' => 'auth']);
$routes->post('/dashboard/pengirimanbarang/submitpengiriman', 'PengirimanBarang::submitPengiriman', ['filter' => 'auth']);
$routes->post('dashboard/pengirimanbarang/approve/(:segment)', 'PengirimanBarang::approve/$1', ['filter' => 'auth']);

$routes->get('/dashboard/pengirimanbarang/edit/(:segment)', 'PengirimanBarang::renderPageUpdatePengiriman/$1', ['filter' => 'auth']);
$routes->post('/pengirimanbarang/edit/(:segment)', 'PengirimanBarang::edit/$1', ['filter' => 'auth']);
$routes->get('/dashboard/pengirimanbarang/delete/(:segment)', 'PengirimanBarang::delete/$1', ['filter' => 'auth']);
$routes->get('/dashboard/pengirimanbarang/download/(:segment)', 'PengirimanBarang::downloadPdf/$1', ['as' => 'download_surat'], ['filter' => 'auth']);
