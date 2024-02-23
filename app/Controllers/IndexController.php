<?php

namespace App\Controllers;

use Kernel\Controller\BaseController;
use App\Models\Post;

class IndexController extends BaseController
{
	public function index()
	{
		$model = new Post();
		$posts = $model::select();

		$this->view()->page('Pages.index', ['posts' => $posts]);
	}

}