<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?= URLROOT; ?>/posts/add" class="btn btn-secondary btn-block">Post ad</a>

<?php foreach ($data['post'] as $post) :?>
	<div>
		<?= $post->title ?>
		<a href="<?= URLROOT; ?>/posts/edit/<?= $post->id_books ?>">Edit</a>
		<a href="#">Delete</a>
	</div>
<?php endforeach ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>