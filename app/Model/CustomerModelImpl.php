<?php

namespace App\Model;

use DB;

use App\Contracts\CustomerModel;

class CustomerModelImpl implements CustomerModel
{
	public function deleteCustomer($userId, $customerId)
	{
		
	}
	
	public function addCustomer($userId, $customerId) 
	{
		
	}

	public function getCustomerBriefs($userId) {
		$customers = DB::select("SELECT id, nickname, avatar
					FROM customer_teacher JOIN user ON (userId = id)
					WHERE teacherId = ?", [$userId]);
		return $customers;
	}
}
