<?php

namespace App\Model;

use DB;

use App\Contracts\NoticeService;
use App\Contracts\NoticeModel;

class NoticeServiceImpl implements NoticeService
{
	
	protected $model;
	
	public function __construct($app)
	{
		$this->model = $app['App\Contracts\NoticeModel'];
	}
	 
	public function addNotice($senderId, $receiverId, $content)
	{
		
	}
}
