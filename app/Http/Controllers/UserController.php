<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\UserModel;
use App\Contracts\FriendModel;

class UserController extends Controller
{

    public function __construct(UserModel $model, FriendModel $friendModel)
    {
        $this->model = $model;
		$this->friendModel = $friendModel;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('userManage');
    }

	public function modifyPassword(Request $request)
	{
		$oldPass = $request['oldPass'];
		$newPass = $request['newPass'];
		$uid = Session::get('uid');
		if ($this->model->passwordEquals($uid, $oldPass)) {
			return $this->mdoel->modifyPassword($uid, $newPass);
		} else {
			return false;
		}
	}

    public function search(Request $request)
    {
        $type = $request['type'];
        if (is_null($type))
            $type = 0;
        $key = $request['key'];
        if (is_null($key))
            $key = '';
        $page = $request['page'];
        if (is_null($page))
            $page = 0;

        $users = null;
        if ($type == 0)
            $users = ($this->searchUserByNickname($key, $page));
        else
            $users = ($this->getUserById($key));
        $datas['users'] = $users;
        $datas['page'] = $page;
        $datas['key'] = $key;
        $datas['type'] = $type;
        $resultPageType = $request['pageType'];
        if (is_null($resultPageType))
            return view('umsearch', $datas);
        else if ($resultPageType == 1)
            return view('umsearch_edit', $datas);
        else
            return view('userSearch', $datas);
    }

    private function searchUserByNickname($key, $page)
    {
        $users = $this->model->searchByNickname($key, $page);
        return $users;
    }

    private function getUserById($key)
    {
        $user = $this->model->getUserById($key);
        return $user;
    }

    public function deleteUser(Request $request)
    {
        $userId = intval($request['id']);
        if ($userId > 0) {
            $deleteSuccess = $this->model->deleteUser($userId);
            return $deleteSuccess ? "true" : "false";
        }
    }

    public function priorityManage(Request $request)
    {
        return view('userPriorityManage');
    }

    public function modifyPriority(Request $request)
    {
        $priority = $request['priority'];
        $userId = $request['userId'];
        if ($priority && $userId) {
            $modifySuccess = $this->model->modifyPriority($userId, $priority);
            return $modifySuccess ? "true" : "false";
        }
    }

    public function getUserDetail(Request $request)
    {
        $userId = $request['userId'];
        if ($userId) {
            $userDetail = $this->model->getUserDetail($userId);
            $userSports = $this->model->getUserSports($userId);
            return [$userDetail, $userSports];
        }
    }

    public function signInIndex(Request $request)
    {
        return view('login');
    }

    public function signIn(Request $request)
    {
        $account = $request['account'];
        $password = $request['password'];
        if ($account && $password) {
            $userInfo = $this->model->getUserLoginInfo($account, $password);
            if ($userInfo) {
                Session::put('uid', $userInfo->userId);
				Session::put('nickname', $userInfo->nickname);
				Session::put('avatar', $userInfo->avatar);
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function hasNickname(Request $request)
    {
        $nickname = $request['nickname'];
        if ($nickname) {
            $nicknameExist = $this->model->hasNickname($nickname);
            return $nicknameExist ? "true" : "false";
        }
    }

    public function hasAccount(Request $request)
    {
        $account = $request['account'];
        if ($account) {
            $accountExist = $this->model->hasAccount($account);
            return $accountExist ? "true" : "false";
        }
    }

    public function signUpIndex(Request $request)
    {
        return view('signUpIndex');
    }

    public function signUp(Request $request)
    {
        $role = $request['role'];
        $sex = $request['sex'];
        $city = $request['city'];
        $nickname = $request['nickname'];
        $account = $request['account'];
        $password = $request['password'];
        $sportsStr = $request['sports'];
        if (is_null($account) || strlen($account) < 6)
            return;
        if (is_null($nickname) || strlen($nickname) == 0)
            return;
        if (is_null($password) || strlen($password) < 8)
            return;

        if (is_null($sex))
            $sex = 1;
        if (is_null($role))
            $role = 1;
        if (is_null($sportsStr))
            $sportsStr = '';
        $sports = explode(",", $sportsStr);

        $userId = $this->model->addUser($account, $password, $nickname, $city, $role, $sex, $sports);
        if ($userId) {
            Session::put("userId", $userId);
        }
        return is_null($userId) ? "false" : "true";
    }

    public function signUpRedirect(Request $request)
    {
        $nickname = $request['nickname'];
        if ($nickname) {
            return view('signUpRedirect', ["nickname" => $nickname]);
        }
    }

    public function exitLogin(Request $request)
    {
        Session::forget('uid');
        Session::forget('nickname');
        Session::forget('avatar');
        return view('login');
    }

    public function updateUserInfo(Request $request)
    {
        $userId = Session::get('userId');
        $nickname = $request['nickname'];
        $city = $request['city'];
        $signature = $request['signature'];
        if ($nickname && $city && $signature) {
            $updateSuccess = $this->model->update($userId, $nickname, $city, $signature);
            return $updateSuccess ? "true" : "false";
        }
    }

	public function userCenter(Request $reqeust)
	{
		// TODO:uid
		$uid = 1;//Session::get('uid');
		$user = $this->model->getUserDetail($uid)[0];
		$datas['user'] = $user;
        return view('userInfo', $datas);
	}

	public function webModifyPassword()
	{
		return view('modifyPassword');
	}

	public function myReceiveComment()
	{
		return view('comment', $this->friendModel->getComments(Session::get('uid'), $request['page']));
	}
		
	public function myConcern()
	{
		$page = $request['page'];
		$asc = $request['asc'];
		return view('myConcern', $this->friendModel->getUserConcerns(Session::get('uid'), 
			$page, $asc));
	}
			
	public function myFan()
	{
		$page = $request['page'];
		$asc = $request['asc'];
		return view('myConcern', $this->friendModel->getUserFans(Session::get('uid'), 
			$page, $asc));
	}
	
	public function webUser(Request $request) {
		$userId = $request['id'];
		$uid = Session::get('uid');
		if () {
			
		}
	}
}
