<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Query Builder Examples API Routes

Route::prefix('v1/pedidos')->group(function(){

    // 2. Recupera todos los pedidos asociados al usuario con ID 2.
    Route::get('/pedidospecifico/{id}', [PedidosController::class, 'getSpecificPedido']);

    // 3. Obtén la información detallada de los pedidos, incluyendo el nombre y correo electrónico de los usuarios.
    Route::get('/allpedidos', [PedidosController::class, 'getAllPedidos']);

    // 4. Recupera todos los pedidos cuyo total esté en el rango de $100 a $250
    Route::get('/range/{min}/{max}', [PedidosController::class,'getPedidosBetween']);

    // 5. Encuentra todos los usuarios cuyos nombres comiencen con la letra "R"
    Route::get('/users/startswith/{letter}', [PedidosController::class,'getUserByFirstLeter']);

    // 6. Calcula el total de registros en la tabla de pedidos para el usuario con ID 5
    Route::get('/count/user/{userId}', [PedidosController::class,'getTotalUserRecordsInPedidos']);

    // 7. Recupera todos los pedidos junto con la información de los usuarios, ordenándolos de forma descendente según el total del pedido
    Route::get('/with-users/desc', [PedidosController::class, 'getAllPedidosDesc']);

    // 8. Obtén la suma total del campo "total" en la tabla de pedidos
    Route::get('/sum-total', [PedidosController::class,'getSumaTotalPedidos']);

    // 9. Encuentra el pedido más económico, junto con el nombre del usuario asociado
    Route::get('/cheapest', [PedidosController::class,'getCheapestPedido']);

    // 10. Obtén el producto, la cantidad y el total de cada pedido, agrupándolos por usuario
    Route::get('/products-by-user', [PedidosController::class ,'products_por_usuario']);
});
