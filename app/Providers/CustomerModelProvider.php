<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\CustomerModelImpl;

class CustomerModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\CustomerModel';
	
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
			return new CustomerModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
