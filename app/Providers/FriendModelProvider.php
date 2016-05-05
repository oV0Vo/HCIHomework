<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\FriendModelImpl;

class FriendModelProvider extends ServiceProvider
{
	
    protected $defer = true;
	
	public $provideModel = 'App\Contracts\FriendModel';
	
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
			return new FriendModelImpl();
		});

    }
	
    public function provides()
    {
        return [$this->provideModel];
    }
}
