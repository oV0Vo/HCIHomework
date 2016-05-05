<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\HealthPlanModelImpl;

class HealthPlanModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\HealthPlanModel';
	
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
			return new HealthPlanModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
