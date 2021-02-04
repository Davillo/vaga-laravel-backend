<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerImageController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\OrderItemController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductImageController;
use App\Http\Controllers\User\AuthenticatedUserController;
use App\Http\Controllers\User\AuthenticationController;
use App\Http\Controllers\User\UserImageController;

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
Route::post('/auth/login', [AuthenticationController::class, 'store']);

$router->group([
    'middleware' => 'auth.api',
    'prefix' => '/auth'
], function ($router) {
    $router->get('/logout', [AuthenticatedUserController::class, 'destroy']);
    $router->put('/refresh', [AuthenticatedUserController::class, 'update']);
    $router->get('/me', [AuthenticatedUserController::class, 'show']);
    $router->post('/image', [UserImageController::class, 'update']);
});

$router->group([
    'middleware' => 'auth.api',
    'prefix' => '/products'
], function () use ($router) {
    $router->get('/', [ProductController::class, 'index']);
    $router->post('/', [ProductController::class, 'store']);
    $router->get('/{id}', [ProductController::class, 'show']);
    $router->put('/{id}', [ProductController::class, 'update']);
    $router->delete('/{id}', [ProductController::class, 'destroy']);
    $router->post('/{id}/image', [ProductImageController::class, 'update']);
});

$router->group([
    'middleware' => 'auth.api',
    'prefix' => '/categories'
], function () use ($router) {
    $router->get('/', [CategoryController::class, 'index']);
    $router->post('/', [CategoryController::class, 'store']);
    $router->get('/{id}', [CategoryController::class, 'show']);
    $router->put('/{id}', [CategoryController::class, 'update']);
    $router->delete('/{id}', [CategoryController::class, 'destroy']);
});

$router->group([
    'middleware' => 'auth.api',
    'prefix' => '/customers'
], function () use ($router) {
    $router->get('/', [CustomerController::class, 'index']);
    $router->post('/', [CustomerController::class, 'store']);
    $router->get('/{id}', [CustomerController::class, 'show']);
    $router->put('/{id}', [CustomerController::class, 'update']);
    $router->delete('/{id}', [CustomerController::class, 'destroy']);
    $router->post('/{id}/image', [CustomerImageController::class, 'update']);
});

$router->group([
    'middleware' => 'auth.api',
    'prefix' => '/orders'
], function () use ($router) {
    $router->get('/', [OrderController::class, 'index']);
    $router->post('/', [OrderController::class, 'store']);
    $router->get('/{id}', [OrderController::class, 'show']);
    $router->patch('/{id}', [OrderController::class, 'update']);
    $router->delete('/{id}', [OrderController::class, 'destroy']);

    $router->get('/{id}/items', [OrderItemController::class, 'index']);
    $router->post('/{id}/items', [OrderItemController::class, 'store']);
    $router->get('/{id}/items/{itemId}', [OrderItemController::class, 'show']);
    $router->put('/{id}/items/{itemId}', [OrderItemController::class, 'update']);
    $router->delete('/{id}/items/{itemId}', [OrderItemController::class, 'destroy']);
});