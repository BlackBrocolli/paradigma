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
// home/dashboard/copybuku
$routes->get('/home/copy_buku', 'CopyBuku::index', ['filter' => 'authfilter']);
$routes->get('/home/deletecopybuku/(:any)', 'CopyBuku::delete/$1', ['filter' => 'authfilter']);
$routes->post('/home/deletecopybuku/(:any)', 'CopyBuku::delete/$1', ['filter' => 'authfilter']);
$routes->get('/home/editcopybuku/(:any)', 'CopyBuku::editcopybuku/$1', ['filter' => 'authfilter']);
$routes->post('/home/updatecopybuku/(:any)', 'CopyBuku::updatecopybuku/$1', ['filter' => 'authfilter']);
$routes->get('/home/addcopybuku', 'CopyBuku::addcopybuku', ['filter' => 'authfilter']);
$routes->post('/home/createcopybuku', 'CopyBuku::createcopybuku', ['filter' => 'authfilter']);
// admin presensi
$routes->get('/home/presensi', 'Presensi::index', ['filter' => 'authfilter']);
// home/dashboard/ebook
$routes->get('/home/ebook', 'Ebook::index', ['filter' => 'authfilter']);
$routes->get('home/addebook', 'Ebook::addebook', ['filter' => 'authfilter']);
$routes->post('home/createebook', 'Ebook::createebook', ['filter' => 'authfilter']);
$routes->get('home/deleteebook/(:any)', 'Ebook::deleteebook/$1', ['filter' => 'authfilter']);
$routes->post('home/deleteebook/(:any)', 'Ebook::deleteebook/$1', ['filter' => 'authfilter']);
$routes->get('home/editebook/(:any)', 'Ebook::editebook/$1', ['filter' => 'authfilter']);
$routes->post('home/updateebook/(:any)', 'Ebook::updateebook/$1', ['filter' => 'authfilter']);
$routes->get('/home/mhs/bacaebook/(:any)', 'Ebook::bacaebook/$1', ['filter' => 'authfilter']);
// home/dashboard/tugas akhir
$routes->get('/home/tugasakhir', 'TugasAkhir::index', ['filter' => 'authfilter']);
$routes->get('/home/addtugasakhir', 'TugasAkhir::addtugasakhir', ['filter' => 'authfilter']);
$routes->post('/home/createtugasakhir', 'TugasAkhir::createtugasakhir', ['filter' => 'authfilter']);
$routes->get('/home/edittugasakhir/(:any)', 'TugasAkhir::edittugasakhir/$1', ['filter' => 'authfilter']);
$routes->post('/home/updatetugasakhir/(:any)', 'TugasAkhir::updatetugasakhir/$1', ['filter' => 'authfilter']);
$routes->get('/home/deletetugasakhir/(:any)', 'TugasAkhir::deletetugasakhir/$1', ['filter' => 'authfilter']);
$routes->post('/home/deletetugasakhir/(:any)', 'TugasAkhir::deletetugasakhir/$1', ['filter' => 'authfilter']);
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
$routes->post('/home/updatetanggal/(:any)/(:any)', 'Pinjam::updatetanggal/$1/$2', ['filter' => 'authfilter']);
$routes->get('/home/updatetanggal/(:any)', 'Pinjam::updatetanggal/$1', ['filter' => 'authfilter']);
$routes->get('/home/editstatus/(:any)/(:any)', 'Pinjam::editstatus/$1/$2', ['filter' => 'authfilter']);
$routes->post('/home/editstatus/(:any)/(:any)', 'Pinjam::editstatus/$1/$2', ['filter' => 'authfilter']);
// reservasi
$routes->get('/home/reservasi', 'Reservasi::index', ['filter' => 'authfilter']);
$routes->post('/home/mhs/reservasi', 'Reservasi::process', ['filter' => 'authfilter']);
$routes->get('/home/mhs/tglreservasi/(:any)/(:any)', 'Reservasi::tglreservasi/$1/$2', ['filter' => 'authfilter']);
// mahasiswa punya
$routes->get('/home/mhs', 'Home::index_mhs', ['filter' => 'authfilter']);
$routes->get('/home/mhs/detailbuku/(:any)', 'Home::mhs_detailbuku/$1', ['filter' => 'authfilter']);
$routes->get('/home/mhs/ebook', 'Home::mhs_ebook', ['filter' => 'authfilter']);
$routes->get('/home/mhs/ebook/detail/(:any)', 'Home::mhs_detail_ebook/$1', ['filter' => 'authfilter']);
$routes->get('/home/mhs/history', 'Home::mhs_history', ['filter' => 'authfilter']);
$routes->get('/home/mhs/profil', 'Home::mhs_profil', ['filter' => 'authfilter']);
$routes->post('/home/mhs/gantiPassword', 'Home::mhs_ganti_password',['filter' => 'authfilter']);

// mahasiswa ebook
$routes->post('/home/mhs/pinjamebook/(:any)', 'Ebook::pinjamebook/$1');

// absensi
$routes->get('/absensi', 'Absensi::index');
$routes->post('/absensi/input', 'Absensi::input');

// for debugging
$routes->get('/home/debugging', 'Home::debugging', ['filter' => 'authfilter']);

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
