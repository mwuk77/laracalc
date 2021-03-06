<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperationController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

/**
 * Routes behind authentication
 */
Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('layouts', 'LayoutController')->only([
        'index', 'show'
    ]);
    
    Route::post('operation', function(Request $request) {
        $operationController = new OperationController();

        /**
         * This could become a lot of boiler-plate with more routes added.
         */
        $validator = Validator::make($request->all(), ['expression' => ['required']]);

        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        else
        {
            return response()->json(['result' => $operationController->execute($request)], 200);
        }
    });
    
});
