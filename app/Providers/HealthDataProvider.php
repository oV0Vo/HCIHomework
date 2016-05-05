<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\ModelImpl;

class ModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\Model';
	
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
			return new ModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
