<?php
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Project;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('Home');
$routes->get('/project/projectos', [Project::class, 'index']);
$routes->post('/project/projectos/create', [Project::class, 'create']);
$routes->put('/project/projectos/editar', [Project::class, 'update']);
$routes->post('/project/projectos/delete', [Project::class, 'deleteProgect']);
//$routes->get('/produtos/delete', [Project::class, 'delete']);
//$routes->get('pages', [Pages::class, 'index']);
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);