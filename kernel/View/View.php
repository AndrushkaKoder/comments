<?php

namespace Kernel\View;

class View
{
	public function page(string $path, array $data): void
	{
		$filepath = VIEWS . '/' . dotNotationPath($path) . '.php';

		if (!is_file($filepath))
			throw new \ViewNotFoundException('view not found!');

		extract($data);
		include_once $filepath;
	}
}