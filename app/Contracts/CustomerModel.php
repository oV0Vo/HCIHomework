<?php

namespace App\Contracts;

interface CustomerModel
{
	public function deleteCustomer($userId, $customerId);
	
	public function addCustomer($userId, $customerId);

	public function getCustomerBriefs($userId);
}
