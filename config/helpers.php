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
