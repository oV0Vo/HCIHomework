<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\TeacherAdModelImpl;

class TeacherAdModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\TeacherAdModel';
	
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
			return new TeacherAdModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
