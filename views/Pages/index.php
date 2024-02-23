<?php include TEMPLATE . '/head.php' ?>
<?php
/**
 * @var array $posts
 */
?>
	<main>
		<div class="container py-4">

			<div class="p-5 mb-4 bg-body-tertiary rounded-3">
				<div class="container-fluid py-5">
					<h1 class="display-5 fw-bold">
						Posts
					</h1>
					<p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the
						one in previous versions of Bootstrap. Check out the examples below for how you can remix and
						restyle it to your liking.</p>
					<button class="btn btn-primary btn-lg" type="button">Example button</button>
				</div>
			</div>

			<?php if ($posts): ?>
				<div class="row align-items-md-stretch">
					<?php foreach ($posts as $post): ?>
						<div class="col-md-6">
							<div class="h-100 p-5 bg-body-tertiary border rounded-3">
								<h2><?= $post['title'] ?></h2>
								<p><?= $post['description'] ?></p>
								<a href="/posts?post_id=<?= $post['id'] ?>"
								   class="btn btn-outline-secondary">Подробнее</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div class="row">
					<div class="col-12">
						<h2>Постов нет =(</h2>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</main>
<?php include TEMPLATE . '/footer.php' ?>