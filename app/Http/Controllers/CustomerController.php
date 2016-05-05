<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\CustomerModel;
use App\Contracts\HealthAdviceModel;

class CustomerController extends Controller
{
	
	public function __construct(CustomerModel $customerModel, HealthAdviceModel $healthAdviceModel)
	{
		$this->customerModel = $customerModel;
		$this->healthAdviceModel = $healthAdviceModel;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$userId = Session::get('userId');
		$customers = $this->customerModel->getCustomerBriefs($userId);
		$datas['friends'] = $customers;
		return view('customer', $datas);
    }

	public function deleteCustomer(Request $request)
	{
		$userId = $request['userId'];
	}
 	
	public function newAdvice(Request $request)
	{
		$receivorId = $request['userId'];
		$content = $request['content'];

		$this->healthAdviceModel;
		return $content;
	}
 	
}
