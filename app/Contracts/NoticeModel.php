<?php

namespace App\Contracts;

interface NoticeModel
{
	public function addNotice($senderId, $receiverId, $content);
}
