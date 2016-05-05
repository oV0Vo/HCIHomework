<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\NoticeService;

class NoticeController extends Controller
{
	
	public function __construct(NoticeService $model)
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
        return "NoticeController";
    }

}
