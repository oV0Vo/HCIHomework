<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\UserActionModelImpl;

class UserActionModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\UserActionModel';
	
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
			return new UserActionModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
