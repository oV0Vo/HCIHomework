<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\SportRankServiceImpl;

class SportRankServiceProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\SportRankService';
	
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
		$this->app->singleton($this->provideModel, function(){ 
			return new SportRankServiceImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
