<?php

// Essa rota faz a autenticação via jwt
Route::post('auth', 'Auth\AuthApiController@authenticate');
//retorna o proprio usuario logado usando o token.

//obs parar esse rota funcionar a Header vai precisa da Authorization + Bearer valor do token.
Route::get('me', 'Auth\AuthApiController@getAuthenticatedUser');

//atualiza o token
Route::post('auth-refresh', 'Auth\AuthApiController@refreshtoken');

//versionamento de api
Route::group(['prefix' => 'v1', 'namespace'=> 'Api\v1'], function() {
    // ,'middleware' => 'auth:api'
    Route::get('categories/{id}/products','CategoryController@produts');

    Route::apiResource('categories','CategoryController');

    Route::apiResource('products','ProductController');

    Route::post('updateProduts/{id}','ProductController@updateProduts');
});

