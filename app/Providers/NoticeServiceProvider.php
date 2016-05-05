<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\NoticeServiceImpl;

class NoticeServiceProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\NoticeService';
	
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {	
		$this->app->singleton($this->provideModel, function($app){ 
			return new NoticeServiceImpl($app);
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
