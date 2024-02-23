<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Kernel\controller\BaseController;

class PostController extends BaseController
{

	private Post $postTable;
	private Comment $commentTable;

	public function __construct()
	{
		$this->postTable = new Post();
		$this->commentTable = new Comment();
	}

	public function index()
	{
		$post = $this->postTable::first($this->request()->input('post_id'));
		$comments = $this->commentTable::select(['post_id' => $post['id']]);


		if (!$post) $this->redirect('/');
		$this->view()->page('Pages.post', ['post' => $post, 'comments' => $comments]);
	}

	public function add()
	{
		$postId = $this->request()->input('post_id');
		$comment = htmlspecialchars($this->request()->input('comment'));
		$parentComment = $this->request()->input('parent');

		if ($comment) {
			$commentId = $this->commentTable::insert([
				'text' => $comment,
				'post_id' => $postId,
				'parent_id' => $parentComment ?? null
			]);
		}

		$this->redirect("/posts?post_id={$postId}");
	}

	public function remove()
	{
		$postId = $this->request()->input('id');
		if ($postId) $this->commentTable::delete(['id' => $postId]);
	}

	public function edit()
	{
		$postId = $this->request()->input('post_id');
		$comment = htmlspecialchars($this->request()->input('comment_edit'));
		$commentId = $this->request()->input('comment_id');
		if($comment && $commentId) {
			$this->commentTable::update(intval($commentId), [
				'text' => $comment,
			]);
		}

		$this->redirect("/posts?post_id={$postId}");
	}

	public function answer()
	{
		$comment = htmlspecialchars($this->request()->input('comment_answer'));
		$postId = $this->request()->input('post_id');
		if($comment) {
			$this->commentTable::insert([
				'text' => $comment,
				'parent_id' => intval($this->request()->input('comment_id')),
				'post_id' => intval($this->request()->input('post_id'))
			]);
		}

		$this->redirect("/posts?post_id={$postId}");
	}


}