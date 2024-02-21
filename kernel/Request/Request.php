<?php

namespace Kernel\Request;

class Request
{
	private array $get;
	private array $post;
	private array $files;
	private array $server;
	private array $session;
	private array $cookies;

	public function __construct($get, $post, $files, $server, $session, $cookies)
	{
		$this->get = $get;
		$this->post = $post;
		$this->files = $files;
		$this->server = $server;
		$this->session = $session;
		$this->cookies = $cookies;
	}

	public static function createSelfFromGlobals(): self
	{
		return new self(
			$_GET,
			$_POST,
			$_FILES,
			$_SERVER,
			$_SESSION,
			$_COOKIE
		);
	}

	public function uri()
	{
		return preg_replace('/\?+.*/', '', $this->server['REQUEST_URI']);
	}

	public function httpMethod(): string
	{
		return $this->server['REQUEST_METHOD'];
	}

	public function input(string $key): ?string
	{
		return $this->get[$key] ?? $this->post[$key] ?? null;
	}

	public function all(): array
	{
		return array_merge($this->get, $this->post, $this->files);
	}

}