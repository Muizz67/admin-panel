<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources('users', 'AdminApi\UserController');
Route::apiResources('roles', 'AdminApi\RoleController');
Route::apiResources('permissions', 'AdminApi\PermissionController');
Route::apiResources('blogs', 'BlogController')->middleware('auth');

Route::post('blogs/{blog}/update-image', 'BlogController@updateFeaturedImage')->middleware('auth');

Route::apiResources('categories', 'CategoryController')->middleware('auth');
Route::get('activities/{userId?}','AdminApi\ActivityController@index');