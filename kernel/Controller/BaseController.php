<?php

namespace Kernel\controller;

use Kernel\Request\Request;
use Kernel\View\View;

class BaseController
{

	private View $view;
	private Request $request;

	public function setView(View $view)
	{
		$this->view = $view;
	}

	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

	public function view(): View
	{
		return $this->view;
	}

	public function request(): Request
	{
		return $this->request;
	}


}