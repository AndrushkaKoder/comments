<?php

function dotNotationPath($path)
{
	return preg_replace('/\.+/', '/', $path);
}

