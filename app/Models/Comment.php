<?php

namespace App\Models;

use Kernel\Database\Database;

class Comment extends Database
{
	protected static string $table = 'comments';
}