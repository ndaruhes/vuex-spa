<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // User::create([
    //     'name' => 'Muhamad Ndaru',
    //     'email' => 'muhamad.ndaru@gmail.com',
    //     'password' => bcrypt('password'),
    //     'role' => 'Admin'
    // ]);

    // User::create([
    //     'name' => 'Raha Raditya',
    //     'email' => 'raharaditya10@gmail.com',
    //     'password' => bcrypt('password'),
    //     'role' => 'Member'
    // ]);

    return view('welcome');
});
