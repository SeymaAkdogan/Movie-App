<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TVSeriesController;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'index']);

// AUTH
Route::get('/login', function(){
    return view('auth.login');
});
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::get('/register', function(){
    return view('auth.register');
});
Route::post('/register', [AuthController::class,'register']);
Route::get('/logout', [AuthController::class,'logout']);

Route::get('/profile', function(){
    return view('auth.profile');
})->middleware('auth');
Route::post('/profile',[AuthController::class,'updateProfile'] )->middleware('auth');


// ACCOUNT
Route::get('/myFavList', [AccountController::class,'myFavList'])->middleware('auth');
Route::get('/myWatchList', [AccountController::class,'myWatchList'])->middleware('auth');
Route::get('/myReview', [AccountController::class,'myReview'])->middleware('auth');
Route::get('/removebyCommentList/{movieId}', [AccountController::class,'removebyCommentList'])->middleware('auth');
Route::get('/removebyWatchList/{movieId}', [AccountController::class,'removebyWatchList'])->middleware('auth');
Route::get('/removebyRateList/{movieId}', [AccountController::class,'removebyRateList'])->middleware('auth');
Route::get('/removebyFavList/{movieId}', [AccountController::class,'removebyFavList'])->middleware('auth');
Route::get('/{movie}/addFav/{movieId}',[AccountController::class,'addFav'])->middleware('auth');
Route::get('/{movie}/addWatchList/{movieId}',[AccountController::class,'addWatchList'])->middleware('auth');
Route::post('/{movie}/review/{movieId}',[AccountController::class,'movieReview'])->middleware('auth');

// MOVIE
Route::get('/movie/populer',[MovieController::class,'getPopularMovie']);
Route::get('/movie/now-playing',[MovieController::class,'getNowPlayingMovie']);
Route::get('/movie/upcoming',[MovieController::class,'getUpcomingMovie']);
Route::get('/movie/top-rated',[MovieController::class,'getTopRatedMovie']);
Route::get('/movie/{movieId}',[MovieController::class,'getMovieDetail']);
Route::get("/movies/filter",[MovieController::class,'getFilterResults']);

// TV SERIES
Route::get("/tvs/filter",[TVSeriesController::class,'getTVFilterResults']);
Route::get("/tv/populer",[TVSeriesController::class,'getPopularTv']);
Route::get("/tv/airing-today",[TVSeriesController::class,'getAiringTodayTv']);
Route::get("/tv/on-the-air",[TVSeriesController::class,'getOnTheAirTv']);
Route::get("/tv/top-rated",[TVSeriesController::class,'getTopRatedTv']);
Route::get('/tv/{serieId}',[TVSeriesController::class,'getTvSeriesDetail']);


