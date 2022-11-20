<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'authfilter']);
// auth
$routes->get('/register', 'Register::index');
$routes->post('/register/process', 'Register::process');
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/login/logout', 'Login::logout');
// home/dashboard/buku
$routes->get('/home', 'Home::index', ['filter' => 'authfilter']);
$routes->get('/home/buku', 'Home::readbuku', ['filter' => 'authfilter']);
$routes->get('/home/addbuku', 'Home::addbuku', ['filter' => 'authfilter']);
$routes->post('home/createbuku', 'Home::createbuku', ['filter' => 'authfilter']);
$routes->get('/home/deletebuku/(:any)', 'Home::deletebuku/$1', ['filter' => 'authfilter']);
$routes->post('/home/deletebuku/(:any)', 'Home::deletebuku/$1', ['filter' => 'authfilter']);
$routes->get('/home/editbuku/(:any)', 'Home::editbuku/$1', ['filter' => 'authfilter']);
$routes->post('/home/updatebuku/(:any)', 'Home::updatebuku/$1', ['filter' => 'authfilter']);
// my profile
$routes->get('/home/myprofile', 'Home::myprofile', ['filter' => 'authfilter']);
// anggota
$routes->get('/home/anggota', 'Member::index', ['filter' => 'authfilter']);
$routes->get('/home/addanggota', 'Member::addanggota', ['filter' => 'authfilter']);
$routes->post('home/createanggota', 'Member::createanggota', ['filter' => 'authfilter']);
$routes->get('/home/deleteanggota/(:any)', 'Member::deleteanggota/$1', ['filter' => 'authfilter']);
$routes->post('/home/deleteanggota/(:any)', 'Member::deleteanggota/$1', ['filter' => 'authfilter']);
$routes->get('/home/editanggota/(:any)', 'Member::editanggota/$1', ['filter' => 'authfilter']);
$routes->post('/home/updateanggota/(:any)', 'Member::updateanggota/$1', ['filter' => 'authfilter']);
// peminjaman
$routes->get('/home/peminjaman', 'Pinjam::index', ['filter' => 'authfilter']);
$routes->get('/home/addpeminjaman', 'Pinjam::addpeminjaman', ['filter' => 'authfilter']);
$routes->post('home/createpeminjaman', 'Pinjam::createpeminjaman', ['filter' => 'authfilter']);
$routes->get('/home/edittanggal/(:any)', 'Pinjam::edittanggal/$1', ['filter' => 'authfilter']);
$routes->post('/home/updatetanggal/(:any)', 'Pinjam::updatetanggal/$1', ['filter' => 'authfilter']);
$routes->get('/home/editstatus/(:any)/(:any)', 'Pinjam::editstatus/$1/$2', ['filter' => 'authfilter']);
$routes->post('/home/editstatus/(:any)/(:any)', 'Pinjam::editstatus/$1/$2', ['filter' => 'authfilter']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
