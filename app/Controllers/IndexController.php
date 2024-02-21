<?php

namespace App\Controllers;

use Kernel\Controller\BaseController;

class IndexController extends BaseController
{
	public function index()
	{
		$this->view()->page('Pages.index', []);
	}

}