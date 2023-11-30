<?php
    require __DIR__ . "/../vendor/autoload.php";

use App\Controllers\ChatController;
use MinasRouter\Router\Route;

Route::start("http://chat.test", "@");

Route::get("/", [ChatController::class, "index"]);

Route::execute();