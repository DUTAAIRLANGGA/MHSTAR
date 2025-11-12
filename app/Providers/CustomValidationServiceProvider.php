<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Aturan validasi kustom untuk username
        Validator::extend('validateUsername', function ($attribute, $value, $parameters, $validator) {
            // Logika validasi: Username hanya boleh berisi huruf, angka, dan underscore.
            return preg_match('/^[a-zA-Z0-9_]+$/', $value);
        });

        // Aturan validasi kustom untuk panjang password
        Validator::extend('min_3_chars', function ($attribute, $value, $parameters, $validator) {
            // Logika validasi: Memeriksa apakah panjang string lebih dari atau sama dengan 3.
            return strlen($value) >= 3;
        });

        // Menambahkan pesan error kustom untuk aturan 'validateUsername'
        Validator::replacer('validateUsername', function ($message, $attribute, $rule, $parameters) {
            return 'Username hanya boleh berisi huruf, angka, dan underscore.';
        });

        // Menambahkan pesan error kustom untuk aturan 'min_3_chars'
        Validator::replacer('min_3_chars', function ($message, $attribute, $rule, $parameters) {
            return 'Password harus memiliki setidaknya 3 karakter.';
        });
    }
}