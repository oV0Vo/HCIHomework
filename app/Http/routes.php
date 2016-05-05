<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('home', ['middleware' => 'auth', 'uses' => 'MainController@getIndex']);

Route::get('healthPlan', ['middleware' => 'auth', 'uses' => 'HealthPlanController@getIndex']);
Route::get('healthPlan/getHistoryPlanByPage', ['middleware' => 'auth', 'uses' => 'HealthPlanController@getHistoryPlanByPage']);
Route::get('healthPlan/newHealthPlan', ['middleware' => 'auth', 'uses' => 'HealthPlanController@newHealthPlan']);
Route::get('healthPlan/newHealthPlan/commitPlan', ['middleware' => 'auth', 'uses' => 'HealthPlanController@commitPlan']);

Route::get('healthData', ['middleware' => 'auth', 'uses' => 'HealthDataController@getIndex']);
Route::get('healthData/getStatsByCondition', ['middleware' => 'auth', 'uses' => 'HealthDataController@getStatsByCondition']);
Route::get('healthData/getDatasByDate', ['middleware' => 'auth', 'uses' => 'HealthDataController@getDatasByDate']);

Route::get('healthAdvice', ['middleware' => 'auth', 'uses' => 'HealthAdviceController@getIndex']);
Route::get('healthAdvice/getAdviceByPage', ['middleware' => 'auth', 'uses' => 'HealthAdviceController@getAdviceByPage']);
Route::get('healthAdvice/getReceivedAdviceByTeacher', ['middleware' => 'auth', 'uses' => 'HealthAdviceController@getReceivedAdviceByTeacher']);
Route::get('healthAdvice/addAdvice', ['middleware' => 'auth', 'uses' => 'HealthAdviceController@addAdvice']);
Route::get('healthAdvice/importAdvice', ['middleware' => 'auth', 'uses' => 'HealthAdviceController@importAdvice']);

Route::get('healthTeacher', ['middleware' => 'auth', 'uses' => 'HealthTeacherController@getIndex']);
Route::get('healthTeacher/getTeacherBriefsByPage', ['middleware' => 'auth', 'uses' => 'HealthTeacherController@getTeacherBriefsByPage']);
Route::get('healthTeacher/deleteTeacher', ['middleware' => 'auth', 'uses' => 'HealthTeacherController@deleteTeacher']);
Route::get('healthTeacher/addTeacher', ['middleware' => 'auth', 'uses' => 'HealthTeacherController@addTeacher']);
Route::get('healthTeacher/getHotTeacher', ['middleware' => 'auth', 'uses' => 'HealthTeacherController@getHotTeacher']);

Route::get('friend', ['middleware' => 'auth', 'uses' => 'FriendController@getIndex']);
Route::get('friend/deleteFriend', ['middleware' => 'auth', 'uses' => 'FriendController@deleteFriend']);
Route::get('friend/add', ['middleware' => 'auth', 'uses' => 'FriendController@addFriend']);
Route::get('friend/getFriendBriefsByPage', ['middleware' => 'auth', 'uses' => 'FriendController@getFriendBriefsByPage']);
Route::get('friend/commentToFriend', ['middleware' => 'auth', 'uses' => 'FriendController@commentToFriend']);

Route::get('sportRank', ['middleware' => 'auth', 'uses' => 'SportRankController@getIndex']);
Route::get('sportRank/getRankByCondition', ['middleware' => 'auth', 'uses' => 'SportRankController@getRankByCondition']);

Route::get('userAction', ['middleware' => 'auth', 'uses' => 'UserActionController@getIndex']);
Route::get('userAction/newUserAction', ['middleware' => 'auth', 'uses' => 'UserActionController@newUserAction']);
Route::get('userAction/reply', ['middleware' => 'auth', 'uses' => 'UserActionController@reply']);
Route::get('userAction/praise', ['middleware' => 'auth', 'uses' => 'UserActionController@praise']);

Route::get('activity', ['middleware' => 'auth', 'uses' => 'ActivityController@getIndex']);
Route::get('activity/getLatestActivity', ['middleware' => 'auth', 'uses' => 'ActivityController@getLatestActivity']);//@delete
Route::get('activity/getHotActivity', ['middleware' => 'auth', 'uses' => 'ActivityController@getHotActivity']);//@delete
Route::get('activity/manage', ['middleware' => 'auth', 'uses' => 'ActivityController@activityManage']);
Route::get('activity/getByCondition', ['middleware' => 'auth', 'uses' => 'ActivityController@getByCondition']);
Route::get('activity/myActivity', ['middleware' => 'auth', 'uses' => 'ActivityController@getMyActivity']);
Route::get('activity/publishActivity', ['middleware' => 'auth', 'uses' => 'ActivityController@publishActivity']);
Route::get('activity/join', ['middleware' => 'auth', 'uses' => 'ActivityController@attendActivity']);
Route::get('activity/getUserPublishByPage', ['middleware' => 'auth', 'uses' => 'ActivityController@getUserPublishByPage']);
Route::get('activity/getUserJoinByPage', ['middleware' => 'auth', 'uses' => 'ActivityController@getUserJoinByPage']);
Route::get('activity/delete', ['middleware' => 'auth', 'uses' => 'ActivityController@deleteActivity']);

Route::get('setting', ['middleware' => 'auth', 'uses' => 'SettingController@getIndex']);
Route::get('setting/update', ['middleware' => 'auth', 'uses' => 'SettingController@update']);

Route::get('customer', ['middleware' => 'auth', 'uses' => 'CustomerController@getIndex']);
Route::get('customer/delete', ['middleware' => 'auth', 'uses' => 'CustomerController@deleteCustomer']);

Route::get('teacherAd', ['middleware' => 'auth', 'uses' => 'TeacherAdController@getIndex']);
Route::get('teacherAd/newAd', ['middleware' => 'auth', 'uses' => 'TeacherAdController@newAd']);
Route::get('teacherAd/getMyAdByPage', ['middleware' => 'auth', 'uses' => 'TeacherAdController@getMyAdByPage']);

Route::get('userInfo/update', ['middleware' => 'auth', 'uses' => 'UserController@updateUserInfo']);
Route::get('userManage', ['middleware' => 'auth', 'uses' => 'UserController@getIndex']);
Route::get('searchUser', ['middleware' => 'auth', 'uses' => 'UserController@search']);
Route::get('userManage/delete', ['middleware' => 'auth', 'uses' => 'UserController@deleteUser']);
Route::get('userPriorityManage', ['middleware' => 'auth', 'uses' => 'UserController@priorityManage']);
Route::get('userPriorityManage/modify', ['middleware' => 'auth', 'uses' => 'UserController@modifyPriority']);
Route::get('userManage/getUserDetail', ['middleware' => 'auth', 'uses' => 'UserController@getUserDetail']);
Route::get('hasNickname', ['middleware' => 'auth', 'uses' => 'UserController@hasNickname']);
Route::get('hasAccount', ['middleware' => 'auth', 'uses' => 'UserController@hasAccount']);

Route::get('notice', ['middleware' => 'auth', 'uses' => 'NoticeController@getIndex']);
Route::get('index', 'IndexController@getIndex');
Route::get('signInIndex', 'UserController@signInIndex');
Route::get('signIn', 'UserController@signIn');
Route::get('exitLogin', ['middleware' => 'auth', 'uses' => 'UserController@exitLogin']);
Route::get('signUpIndex', 'UserController@signUpIndex');
Route::get('signUp', 'UserController@signUp');
Route::get('signUp/redirect', 'UserController@signUpRedirect');

Route::get('test', 'TestController@getIndex');