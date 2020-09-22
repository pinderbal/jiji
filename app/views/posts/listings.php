<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?= URLROOT; ?>/posts/add" class="btn btn-secondary">Post ad</a>

<?php foreach ($data['post'] as $post) :?>
	<div>
		<?= $post->title ?>
		<a href="<?= URLROOT; ?>/posts/edit/<?= $post->id_books ?>" class="btn btn-dark">Edit</a>
		<form class="pull-right" action=<?= URLROOT; ?>/posts/delete/<?= $post->id_books; ?> method=post>
			<input type="submit" value="Delete" class="btn btn-danger">
		</form>
	</div>
<?php endforeach ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>