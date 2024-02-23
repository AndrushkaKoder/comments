<?php include TEMPLATE . '/head.php'; ?>

<?php
/**
 * @var array $post
 * @var array $comments
 */
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
					<?php foreach ($comments as $comment): ?>
						<div class="comment p-2 mb-2 d-flex justify-content-between align-items-center"
						     style="border: 1px solid black;"
						     data-post="<?= $post['id'] ?>"
						     data-comment="<?= $comment['id'] ?>">
							<div class="comment_date">
								<span><?= $comment['created_at'] ?></span>
							</div>
							<div class="comment_content">
								<p style="margin: 0; padding: 0"><?= $comment['text'] ?></p>
							</div>
							<div class="comment_actions">
								<button type="button" data-answer class="btn btn-success">answer</button>
								<button type="button" data-edit class="btn btn-primary">edit</button>
								<button type="button" data-delete class="btn btn-danger">delete</button>
							</div>
						</div>
					<?php if (false) :?>
							<div class="comment p-2 mb-2 d-flex justify-content-between align-items-center"
							     style="border: 1px solid black;"
							     data-post="<?= $post['id'] ?>"
							     data-comment="<?= $comment['id'] ?>">
								<div class="comment_date">
									<span><?= $comment['created_at'] ?></span>
								</div>
								<div class="comment_content">
									<p style="margin: 0; padding: 0"><?= $comment['text'] ?></p>
								</div>
								<div class="comment_actions">
									<button type="button" data-answer class="btn btn-success">answer</button>
									<button type="button" data-edit class="btn btn-primary">edit</button>
									<button type="button" data-delete class="btn btn-danger">delete</button>
								</div>
							</div>
					<?php endif;?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="add_comment" style="max-width: 60%; margin: auto">
			<form action="/comments/add" method="post">
				<h5>Добавить комментарий</h5>
				<input type="text" class="form-control comment_input" name="comment">
				<input type="hidden" class="comment_input" name="post_id" value="<?= $post['id'] ?>">
				<button type="submit" class="btn btn-success mt-3">Сохранить</button>
			</form>
		</div>
	</div>
</main>

<?php include TEMPLATE . '/footer.php' ?>
