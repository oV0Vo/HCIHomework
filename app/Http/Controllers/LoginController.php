<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\UserModel;

class LoginController extends Controller
{
		
	public function __construct(UserModel $userModel)
	{
		$this->userModel = $userModel;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
	{
		return 'signIn';
    }

	public function login(Request $request) 
	{
		$account = $request['account'];
		$password = md5($request['password']);
	}
	
}
