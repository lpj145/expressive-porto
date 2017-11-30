<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 */
/** @var \Zend\Expressive\Application $app */
$app->post('/login', \AuthExpressive\Controller\LoginController::class);
$app->get('/users', \App\Containers\Authentication\UI\API\Controller\ListUsersController::class);
$app->get('/welcome', App\Containers\Welcome\UI\WEB\Controller\Controller::class);