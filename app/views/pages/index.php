<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container ">
	<div class="row">
		<div class="col-md-6 mx-auto">
			<form action="<?= URLROOT; ?>/posts/search" method="post">
				<div class="form-group">
					<div class="text-center">
						<img class="mb-3" src="img/logo.png" class="rounded">
					</div>

					<div class="form-group has-search">
					    <span class="fa fa-search form-control-feedback"></span>
					    <input type="text" name="title" class="form-control" placeholder="Search for a book">
					 </div>

					<!-- <input type="text" name="title" class="form-control" placeholder="Search for a book" value="">
					<span class="invalid-feedback"></span> -->
				</div>	
			</form>
		</div>
	</div>
</div>

<h3>Recently Added:</h3>
<div class="row">
	
		<?php foreach($data['posts'] as $post ) : ?>
			<div class="col-md-3 mb-3">
				<div class="card">
					<a href="<?= URLROOT ?>/posts/show/<?= $post->id_books?>"><?= $post->title; ?></a>
				</div>
			</div>
		<?php endforeach; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>