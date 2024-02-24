<?php

namespace Kernel\Database;

use PDO;
use PDOException;

class Database
{
	protected static PDO $pdo;
	protected static string $table = '';

	public function __construct()
	{
		$this->connect();
	}

	private static function connect(): void
	{
		$host = config('database', 'db_host');
		$database = config('database', 'db_name');
		$user = config('database', 'db_user');
		$password = config('database', 'db_password');

		try {
			self::$pdo = new PDO("mysql:host={$host};dbname={$database}", $user, $password);
		} catch (PDOException $exception) {
			die($exception->getMessage());
		}
	}


	public static function insert(array $data)
	{
		$table = static::$table;
		$fields = array_keys($data);
		$columns = implode(', ', $fields);

		if (!$columns) return false;

		$bind = implode(', ', array_map(fn($item) => ":$item", array_values($fields)));

		$query = "INSERT INTO {$table} ($columns) VALUES ($bind)";

		$sql = self::$pdo->prepare($query);

		$sql->execute($data);

		return self::$pdo->lastInsertId();
	}

	public static function select(array $conditions = [], array $fields = [])
	{
		$table = static::$table;

		if (!static::$pdo) self::connect();
		$selectFields = count($fields) ? implode(',', $fields) : '*';
		$where = '';

		if ($conditions) {
			$where = " WHERE " . implode('AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}
		$query = "SELECT {$selectFields} FROM {$table}{$where}";

		$statement = self::$pdo->prepare($query);
		$statement->execute($conditions);

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function delete(array $conditions)
	{
		$table = static::$table;
		$where = '';

		if ($conditions) {
			$where = " WHERE " . implode(' AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}

		$query = "DELETE FROM {$table}{$where}";
		$statement = self::$pdo->prepare($query);
		$statement->execute($conditions);
	}

	public static function update(int $id, array $conditions = []): void
	{
		$table = static::$table;
		$set = '';
		if ($conditions) {
			$set = "SET " . implode(' AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}

		$query = "UPDATE {$table} {$set} WHERE id = {$id}";

		$statement = self::$pdo->prepare($query);
		$statement->execute($conditions);
	}

	public static function first($id)
	{
		$table = static::$table;
		$query = "SELECT * FROM {$table} WHERE id = {$id} LIMIT 1";
		$statement = self::$pdo->prepare($query);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_ASSOC)[0] ?? [];
	}

}