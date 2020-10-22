<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-fluid">
	<div class="row mb-5">
		<div class="col-md-6 mx-auto">
			<form action="<?= URLROOT; ?>/posts/search" method="get">
				<div class="form-group">
					<div class="text-center mb-3">
						<img class="mb-3" src="img/logo.png" class="rounded">
					</div>

					<div class="form-group has-search">
					    <span class="fa fa-search form-control-feedback"></span>
					    <input type="text" name="title" class="form-control" placeholder="Search for a book">
					 </div>
				</div>	
			</form>
		</div>
	</div>
</div>
<div class="recent-title">
	<h3>Recently Added:</h3>
</div>
<div class="container-fluid d-flex justify-content-center align-items-center">
	<div class="row">
		<?php foreach($data['posts'] as $post ) : ?>
			<div class="col-md-3 mb-3 d-flex justify-content-center align-items-center">
				<a href="<?= URLROOT ?>/posts/show/<?= $post->id_books?>">
					<div class="card index-card d-flex justify-content-center align-items-center">
						<img src="<?= $post->img_file_name ?>" class= "mb-3" width="100" height="100">
						<a href="<?= URLROOT ?>/posts/show/<?= $post->id_books?>"><?= $post->title; ?></a>
						<p>$<?= $post->book_price ?></p>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>