<?php

function dotNotationPath($path)
{
	return preg_replace('/\.+/', '/', $path);
}

function config(string $file, string $key)
{
	$configFile = include CONFIG . "/{$file}.php";
	if (is_array($configFile))
		return $configFile[$key] ?? null;
}

function notFound(): void
{
	http_response_code(404);
	exit("<h1>Page not found</h1> <a href='/'>go back</a>");
}
