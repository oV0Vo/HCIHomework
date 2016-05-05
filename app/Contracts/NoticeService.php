<?php

namespace App\Contracts;

interface NoticeService
{
	public function addNotice($senderId, $receiverId, $content);
}
