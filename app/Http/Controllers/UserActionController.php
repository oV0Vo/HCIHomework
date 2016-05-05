<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\UserActionModel;

class UserActionController extends Controller
{
	
	public function __construct(UserActionModel $model)
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
        return "UserActionController";
    }
			
	public function newUserAction(Request $request)
	{
		$content = $request['content'];
		return 'newUserACTION';
	}
			
	public function reply(Request $request)
	{
		$actionId = $request['actionId'];
		$content = $request['content'];
		return 'reply';
	}
			
	public function praise(Request $request)
	{
		$actionId = $request['actionId'];
		return 'praise';
	}

}
