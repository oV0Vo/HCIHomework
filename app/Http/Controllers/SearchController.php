<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\UserModel;
use App\Contracts\ActivityModel;

class SearchController extends Controller
{

    protected $userModel;

    protected $activityModel;

    public function __construct(UserModel $userModel, ActivityModel $activityModel)
    {
        $this->userModel = $userModel;
        $this->activityModel = $activityModel;
    }

    public function searchUser(Request $request)
    {
        $key = $request['key'];
        return view('');
    }
    /*
public function searchActivity(Request $request)
{
   $key = $request['key'];
}

public function searchTeacher(Request $request)
{
   $key = $request['key'];
}*/

}
