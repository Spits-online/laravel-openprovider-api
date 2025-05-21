<?php

use Illuminate\Support\Facades\Route;
use Spits\LaravelOpenproviderApi\Http\Controllers\DnsRecordsController;

Route::middleware(config('openprovider-api.middleware'))->group(function () {
    Route::get('dns-zone/export/records/{domain}', [DnsRecordsController::class, 'export'])->name('dns-zone.export');
    Route::get('dns-zone/records/{domain}', [DnsRecordsController::class, 'show'])->name('dns-zone.records.show');
    Route::post('dns-zone/records/{domain}', [DnsRecordsController::class, 'store'])->name('dns-zone.records.store');
    Route::put('dns-zone/records/{domain}', [DnsRecordsController::class, 'update'])->name('dns-zone.records.update');
    Route::delete('dns-zone/records/{domain}', [DnsRecordsController::class, 'destroy'])->name('dns-zone.records.destroy');
});
