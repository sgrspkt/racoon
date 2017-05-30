<?php

require_once 'classes/Db.php';
require_once 'classes/Review.php';
require_once 'classes/Route.php';
require_once 'classes/Bird.php';
require_once 'classes/Response.php';

Route::get('bird', 'Bird@getAllBirds');
Route::get('', 'Bird@getAllBirds');
Route::get('home', 'Bird@getAllBirds');
Route::get('review', 'Review@getAllReviews');
Route::get('bird/{num}', 'Bird@getOne');
Route::get('bird/sortByAsc','Bird@sortByAsc');
Route::get('bird/getBySortByDesc','Bird@sortByDesc');
Route::get('bird/getRating','Bird@getRatings');

Route::post('review/insert','Review@save');
Route::delete('review/{num}', 'Review@delete');
Route::put('review/update', 'Review@updateReview');

Route::get('bird/getByRateHigh','Bird@getByRateHighs');
Route::get('bird/getByRateLow','Bird@getByRateLows');


$server = $_SERVER;
$route = new Route( $server);
$result = $route->execute();
$response = new Response( $result );
$response->toJson();