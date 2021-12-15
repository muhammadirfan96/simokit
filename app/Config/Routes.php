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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/checklist/simpan', 'Checklist::simpan');
$routes->get('/checklist/print', 'Checklist::print');
$routes->get('/checklist/(:num)', 'Checklist::print/$1');
$routes->get('/checklist/(:any)', 'Checklist::pilihPeralatan/$1');

$routes->get('/servicerequest/simpan', 'Servicerequest::simpan');
$routes->get('/servicerequest/print', 'Servicerequest::print');
$routes->get('/servicerequest/(:num)', 'Servicerequest::print/$1');
$routes->get('/servicerequest/(:alpha)', 'Servicerequest::index/$1');

$routes->get('/limas/(:num)', 'Limas::print/$1');

$routes->delete('/db_checklist/(:num)', 'Db_checklist::delete/$1');
$routes->get('/db_checklist/(:any)', 'Db_checklist::prints/$1');

$routes->delete('/db_servicerequest/(:num)', 'Db_servicerequest::delete/$1');
$routes->get('/db_servicerequest/(:any)', 'Db_servicerequest::prints/$1');

$routes->delete('/db_limas/(:num)', 'Db_limas::delete/$1');
$routes->get('/db_limas/(:any)', 'Db_limas::prints/$1');

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
