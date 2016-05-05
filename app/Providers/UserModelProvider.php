<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\UserModelImpl;

class UserModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	protected $provideModel = 'App\Contracts\UserModel';
	
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
			return new UserModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
