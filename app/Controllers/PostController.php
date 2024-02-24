<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Traits\RecursiveBuilderTrait;
use Kernel\controller\BaseController;

class PostController extends BaseController
{

	use RecursiveBuilderTrait;

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

		$commentsTree = [];
		if ($comments) {
			$commentsTree = $this->recursiveBuilder($comments);
		}

		if (!$post) notFound();
		$this->view()->page('Pages.post', ['post' => $post, 'comments' => $commentsTree]);
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
		$postId = $this->request()->input('post_id');
		if ($postId) {
			$this->commentTable::delete(['parent_id' => $postId]);
			$this->commentTable::delete(['id' => $postId]);
		}
	}

	public function edit()
	{
		$postId = $this->request()->input('post_id');
		$comment = htmlspecialchars($this->request()->input('comment'));
		$commentId = $this->request()->input('comment_id');
		if ($comment && $commentId) {
			$this->commentTable::update(intval($commentId), [
				'text' => $comment,
			]);
		}

		$this->redirect("/posts?post_id={$postId}");
	}

	public function answer()
	{
		$comment = htmlspecialchars($this->request()->input('comment'));
		$postId = $this->request()->input('post_id');
		$commentId = intval($this->request()->input('comment_id'));
		if ($comment) {
			$countComments = $this->commentTable::select(['parent_id' => $commentId]);
			if (count($countComments) < 3) {
				$this->commentTable::insert([
					'text' => $comment,
					'parent_id' => intval($this->request()->input('comment_id')),
					'post_id' => intval($this->request()->input('post_id'))
				]);
			}
		}
		$this->redirect("/posts?post_id={$postId}");
	}


}