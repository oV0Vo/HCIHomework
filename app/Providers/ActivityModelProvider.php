<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\ActivityModelImpl;

class ActivityModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\ActivityModel';
	
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
			return new ActivityModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
