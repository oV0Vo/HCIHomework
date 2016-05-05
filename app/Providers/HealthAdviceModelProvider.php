<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\HealthAdviceModelImpl;

class HealthAdviceModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\HealthAdviceModel';
	
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
			return new HealthAdviceModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
