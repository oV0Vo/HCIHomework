<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\HealthDataModelImpl;

class HealthDataModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\HealthDataModel';
	
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
			return new HealthDataModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
