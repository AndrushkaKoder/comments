<?php include TEMPLATE . '/head.php'; ?>

<?php
/**
 * @var array $post
 * @var array $comments
 */
?>

<?php
function recursiveComments($comments)
{
	include 'comments.php';
}

?>

<main style="min-height: 100vh;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="title">
					<h1><?= $post['title'] ?></h1>
				</div>
				<div class="text">
					<?= $post['text'] ?>
				</div>
				<div class="time mt-5">
					<?= $post['created_at'] ?>
				</div>
			</div>
		</div>
		<hr>
		<?php if ($comments): ?>
			<div class="row">
				<div class="col-12">
					<div class="comments-wrapper" data-post="<?= $post['id'] ?>">
						<?php recursiveComments($comments); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="add_comments" style="max-width: 60%; margin: auto">
			<form action="/comments/add" method="post" class="comment_form">
				<h5>Добавить комментарий</h5>
				<input type="text" class="form-control comment_input" name="comment">
				<input type="hidden" class="comment_input" name="post_id" value="<?= $post['id'] ?>">
				<button type="submit" class="btn btn-success mt-3">Сохранить</button>
			</form>
		</div>
	</div>
</main>

<?php include TEMPLATE . '/footer.php' ?>
