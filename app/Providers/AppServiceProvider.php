<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (env('SQL_DEBUG', false)) {
            $no = 0;
            DB::listen(function($query) use (&$no) {
                Log::withContext([
                    "sql-{$no}" => $query->sql,
                    "sql-{$no}-bindings" => join(',', $query->bindings ?? []),
                    "sql-{$no}-time" => $query->time
                ]);

                $no++;
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Register Config Files
        |--------------------------------------------------------------------------
        |
        | Now we will register the "app" configuration file. If the file exists in
        | your configuration directory it will be loaded; otherwise, we'll load
        | the default version. You may register other files below as needed.
        |
        */

        Log::withContext(['sapi' => PHP_SAPI]);
        foreach (File::files(base_path('config')) as $file) {
            $this->app->configure($file->getBasename('.php'));
        }
    }
}
