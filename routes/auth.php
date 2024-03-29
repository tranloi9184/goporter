<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    App\Http\Controllers\DashboardController::class, 'index'
])->name('dashboard');

Route::post('/search', [
    App\Http\Controllers\DashboardController::class, 'search'
])->name('dashboard.search');

Route::get('/order', [
    App\Http\Controllers\DashboardController::class, 'createOrder'
])->name('dashboard.createOrder');

Route::post('/order', [
    App\Http\Controllers\DashboardController::class, 'storeOrder'
])->name('dashboard.storeOrder');

Route::put('/order/{id}', [
    App\Http\Controllers\DashboardController::class, 'updateOrder'
])->name('dashboard.updateOrder');

Route::get('/advanced_search', [
    App\Http\Controllers\DashboardController::class, 'showAdvancedSearch'
])->name('dashboard.advanced_search');

Route::post('/advanced_search', [
    App\Http\Controllers\DashboardController::class, 'handleAdvancedSearch'
])->name('dashboard.advanced_search');

Route::get('/schedules', [
    App\Http\Controllers\DashboardController::class, 'schedules'
])->name('dashboard.schedules');

Route::post('/schedules', [
    App\Http\Controllers\DashboardController::class, 'searchSchedules'
])->name('dashboard.schedules');

Route::post('/suggest_search', [
    App\Http\Controllers\DashboardController::class, 'suggestSearch'
])->name('dashboard.suggestSearch');

Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::post('permissions/loadFromRouter', [App\Http\Controllers\PermissionController::class, 'LoadPermission'])->name('permissions.load-router');

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::get('profile', [App\Http\Controllers\UserController::class, 'showProfile'])->name('users.profile');
Route::patch('profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('users.updateProfile');

Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('attendances', App\Http\Controllers\AttendanceController::class);

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('generator_builder.index');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('generator_builder.field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('generator_builder.relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('generator_builder.generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('generator_builder.rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('generator_builder.from_file');


Route::resource('fileUploads', App\Http\Controllers\FileUploadController::class);

Route::get('/orders', [
    App\Http\Controllers\OrderController::class, 'index'
])->name('orders');

Route::get('/orders/create', [
    App\Http\Controllers\OrderController::class, 'create'
])->name('new_order');

Route::get('/queues', [
    App\Http\Controllers\QueueController::class, 'index'
])->name('queues');

Route::get('/schedule', [
    App\Http\Controllers\ScheduleController::class, 'index'
])->name('schedule');
