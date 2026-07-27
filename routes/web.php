<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('/users', function () {
    return User::all();
});


Route::get('users/{name?}/{email?}/{age?}',
    static function (?string $name = '', ?string $email = '', ?int $age = 0) {
        return "$name $email $age";
    })
    ->whereAlpha('name')
    ->whereAlpha('email')
    ->whereNumber('age');

// Route::get('/users/{id}', function (int $id) {
//     return User::where('id', $id)->first();
// });

// Route::get('users/{id}', static function (int $id) {
//    return User::where('id', $id)->first();
// })->where(['id' => '[0-9]+']);
// //    //->where('id', '[0-9]+');
// //    ->whereNumber('id');

//Route model binding
Route::get('users/{user}', static function (User $user) {
    return $user;
})
    ->whereNumber('id');


    Route::get('/', function () {
    return view('welcome');
});
