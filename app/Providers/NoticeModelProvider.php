<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\NoticeModelImpl;

class NoticeModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\NoticeModel';
	
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
			return new NoticeModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
