<?php require APPROOT . '/views/inc/header.php'; ?>

<?php if(!empty($data['posts'])) : ?>
	<h3>These are your results:</h3>
	<?php foreach($data['posts'] as $post ) : ?>
		<div class="card bg-light">
			<a href="<?= URLROOT ?>/posts/show/<?= $post->id_books ?>" ><?= $post->title; ?></a>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<h3>Sorry, no results found.</h3>
<?php endif; ?>	

<?php require APPROOT . '/views/inc/footer.php'; ?>
