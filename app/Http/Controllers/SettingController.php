<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Contracts\UserModel;

class SettingController extends Controller
{
	
	public function __construct(UserModel $model)
	{
		$this->model = $model;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$userId = Session::get('userId');
		$user = $this->model->getUserDetail($userId)[0];
		$datas['user'] = $user;
        return view('setting', $datas);
    }
		
	public function update(Request $request)
	{
		$nickname = $request['nickname'];
		$city = $request['city'];
		$favariteSports  = $request['favariteSports '];
		$briefIntro  = $request['briefIntro '];
		return 'update';
	}
	
}
