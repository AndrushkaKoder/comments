<?php

namespace App\Controllers;

use Kernel\controller\BaseController;

class PostController extends BaseController
{
	public function index()
	{
		$this->view()->page('Pages.post', ['post' => 3]);
	}

}