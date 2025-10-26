<?php

namespace App\Http\Controllers;
use App\Models\Usuarios;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function getSpecificPedido($id, Request $request){
            try {
            $pedidos = DB::table('pedidos')->where('id_usuario', $id)->get();

            if(!$pedidos){
                return response()->json([
                    'status' => 'pedidos_not_found',
                    'message' => 'No orders found for this user'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $pedidos
            ], 200);

            } catch (\Exception $error) {
                return response()->json([
                    'status' => 'server_error',
                    'message' => $error->getMessage()
                ],500);
            }
    }

    public function getAllPedidos(Request $request){
        try {
            $pedidos = DB::table('pedidos')
                ->leftJoin('usuarios', 'pedidos.id_usuario', '=', 'usuarios.id')
                ->select('pedidos.*', 'usuarios.nombre as usuario_nombre', 'usuarios.email as usuario_email')
                ->get();

            if(!$pedidos){
                return response()->json([
                    'status' => 'pedidos_not_found',
                    'message' => 'No orders found for this user'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $pedidos
            ], 200);

            } catch (\Exception $error) {
                return response()->json([
                    'status' => 'server_error',
                    'message' => $error->getMessage()
                ],500);
            }
    }

    public function getPedidosBetween($min, $max){
        try {
            $pedidos = DB::table('pedidos')->whereBetween('total', [$min, $max])->get();

            if(!$pedidos){
                return response()->json([
                    'status' => 'error',
                    'message' => 'No orders found for this user'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $pedidos
            ], 200);

            } catch (\Exception $error) {
                return response()->json([
                    'status' => 'server_error',
                    'message' => $error->getMessage()
                ],500);
            }
    }

    public function getUserByFirstLeter($letter){
        try {
            $users = DB::table('usuarios')->where('nombre', 'like', "$letter%")->get();

            if($users->isEmpty()){
                return response()->json([
                    'status' => 'users_not_found',
                    'message' => 'No users found with that letter'
                ],404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $users
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'status' => 'server_error',
                'message' => $error->getMessage()
            ],500);
        }
    }

    public function getTotalUserRecordsInPedidos($id){
         try {
            $pedidos = DB::table('pedidos')->where('id_usuario', $id)->count();

            if(!$pedidos){
                return response()->json([
                    'status' => 'pedidos_not_found',
                    'message' => 'No orders found for this user'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'amount_of_records' => $pedidos
            ], 200);

            } catch (\Exception $error) {
                return response()->json([
                    'status' => 'server_error',
                    'message' => $error->getMessage()
                ],500);
            }
    }

    public function getAllPedidosDesc(){

        try {
            $pedidos = DB::table('pedidos')
            ->leftJoin('usuarios', 'pedidos.id_usuario','=','usuarios.id')
            ->select('pedidos.*','usuarios.*')
            ->orderByDesc('pedidos.total')
            ->get();

            if(!$pedidos){
                return response()->json([
                    'status' => 'pedidos_not_found',
                    'message' => 'No orders found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $pedidos
            ], 200);

            } catch (\Exception $error) {
                return response()->json([
                    'status' => 'server_error',
                    'message' => $error->getMessage()
                ],500);
            }
    }

    public function getSumaTotalPedidos(){
        try {
            $pedidos = DB::table('pedidos')->sum('total');

            if(!$pedidos){
                return response()->json([
                    'status' => 'pedidos_not_found',
                    'message' => 'No orders found'
                ],404);
            }

            return response()->json([
                'status' => 'success',
                'sum_total_pedidos' => number_format($pedidos, 2)
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
               'status' => 'server_error',
               'message' => $error->getMessage()
            ]);
        }
    }

    public function getCheapestPedido(){
        try {
            $pedido = DB::table('pedidos')
            ->leftJoin('usuarios', 'pedidos.id_usuario','=','usuarios.id')
            ->select('pedidos.*','usuarios.*')
            ->orderBy('pedidos.total')
            ->first();

            if(!$pedido){
                return response()->json([
                    'status' => 'pedidos_not_found',
                    'message' => 'No orders found'
                ],404);
            }

            return response()->json([
                'status' => 'success',
                'sum_total_pedidos' => $pedido
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'status' => 'server_error',
                'message' => $error->getMessage()
            ],500);
        }
    }

    public function products_por_usuario(){
        try {
            $usuarios = DB::table('usuarios')
            ->Join('pedidos', 'usuarios.id','=','pedidos.id_usuario')
            ->select('usuarios.*', 'pedidos.producto', 'pedidos.cantidad', 'pedidos.total')
            ->orderBy('usuarios.id')
            ->get();

            if(!$usuarios){
                return response()->json([
                    'status' => 'users_not_found',
                    'message' => 'No users found'
                ],404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $usuarios
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'server_error',
                'message' => $error->getMessage()
            ],500);
        }
    }

}

