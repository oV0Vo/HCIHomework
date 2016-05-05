<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\SportRankService;

class SportRankController extends Controller
{
	
	public function __construct(SportRankService $service)
	{
		$this->service = $service;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return "SportRankController";
    }
		
	public function getRankByCondition(Request $request)
	{
		$viewType = $request['viewType'];
		return 'getRankByCondition';
	}
	
}
