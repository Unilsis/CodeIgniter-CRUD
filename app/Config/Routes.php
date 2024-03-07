<?php

use App\Controllers\ProdutoController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('Home');
$routes->get('/crud_codeigniter4', [ProdutoController::class, 'index']);
$routes->post('/crud_codeigniter4/create', [ProdutoController::class, 'create']);
$routes->put('/crud_codeigniter4/update', [ProdutoController::class, 'update']);
$routes->post('/crud_codeigniter4/deletePD', [ProdutoController::class, 'deletePD']);
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);