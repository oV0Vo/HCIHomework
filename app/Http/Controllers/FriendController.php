<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\FriendModel;

class FriendController extends Controller
{
	
	public function __construct(FriendModel $model)
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
		$friends = $this->model->getFreindBriefs($userId);
		$datas['friends'] = $friends;
		return view('friend', $datas);
    }
	
	public function deleteFriend(Request $request)
	{
		$userId = $request['userId'];
		return 'deleteFriend';
	}
 		
	public function addFriend(Request $request)
	{
		$userId = Session::get('userId');
		$friendId = $request['id'];
		if($friendId) {
			$addSuccess = $this->model->addFriend($userId, $friendId);
			return $addSuccess ?"true" : "false";
		}
	}
 		
	public function getFriendBriefsByPage(Request $request)
	{
		$page = $request['page'];
		return 'getFriendBriefsByPage';
	}
 		
	public function commentToFriend(Request $request)
	{
		$friendId = $request['friendId'];
		$content = $request['content'];
		return 'commentToFriend';
	}
}
