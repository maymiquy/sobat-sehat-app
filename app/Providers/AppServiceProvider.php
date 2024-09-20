<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		$APP_ENV = env('APP_ENV');
		if ($APP_ENV === 'production') {
			URL::forceScheme('https');
		} else {
			null;
		}
	}
}
