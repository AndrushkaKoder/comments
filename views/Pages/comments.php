<?php
echo '<ul class="mt-3">';
foreach ($comments as $comment) { ?>
	<li data-comment="<?= $comment['id'] ?>" class="comment mt-3" style="position: relative">
		<div style="border: 1px solid black; width: 100%">
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
		<?php if ($comment['children']): ?>
			<?php recursiveComments($comment['children']); ?>
		<?php endif; ?>
	</li>
	<?php
}
echo '</ul>';