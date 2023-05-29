<?php

use App\Http\Controllers\CollaboratorController;
use Illuminate\Support\Facades\Route;

Route::get('getReport/{collaborator}/{week}', [CollaboratorController::class, 'getReport'])
    ->whereNumber('week');

Route::middleware('auth:sanctum')->get('/work-time/{collaborator}', [CollaboratorController::class, 'workTime']);
