<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return response()->json([
        'status' => 'healthy',
        'service' => 'Spotly API',
        'version' => '12.0',
        'checks' => [
            'database' => DB::connection()->getDatabaseName() ? 'OK' : 'FAIL',
            'cache' => Cache::store('redis')->put('ping', 'pong', 5) ? 'OK' : 'FAIL',
        ]
    ]);
});
