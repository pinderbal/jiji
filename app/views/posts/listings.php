<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?= URLROOT; ?>/posts/add" class="btn btn-primary">Post ad</a>
<hr>
<?php foreach ($data['post'] as $post) :?>
	<div class="inline-block">
		<?= $post->title ?>
		<br>
		<img src="../<?= $post->img_file_name ?>" class= "mb-3" width="100" height="100">
		<br>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="<?= URLROOT; ?>/posts/edit/<?= $post->id_books ?>" class="btn btn-dark">Edit</a>
			<form class="pull-right" action=<?= URLROOT; ?>/posts/delete/<?= $post->id_books; ?> method=post>
				<input type="submit" value="Delete" class="btn btn-danger">
			</form>
		</div>
	</div>
	<hr>
<?php endforeach ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>