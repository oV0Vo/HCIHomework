<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\HealthTeacherModelImpl;

class HealthTeacherModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\HealthTeacherModel';
	
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
			return new HealthTeacherModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
