<?php
use App\Http\Controllers\Api\V1\BooksController;
use App\Http\Controllers\Api\V1\WritersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

