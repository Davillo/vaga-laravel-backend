<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['prefix' => '/products'], function () use ($router) {
    $router->get('/', [ProductController::class, 'index']);
    $router->post('/', [ProductController::class, 'store']);
    $router->get('/{id}', [ProductController::class, 'show']);
    $router->put('/{id}', [ProductController::class, 'update']);
    $router->delete('/{id}', [ProductController::class, 'destroy']);
});

$router->group(['prefix' => '/categories'], function () use ($router) {
    $router->get('/', [CategoryController::class, 'index']);
    $router->post('/', [CategoryController::class, 'store']);
    $router->get('/{id}', [CategoryController::class, 'show']);
    $router->put('/{id}', [CategoryController::class, 'update']);
    $router->delete('/{id}', [CategoryController::class, 'destroy']);
});