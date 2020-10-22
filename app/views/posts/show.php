<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
	<div class="col col-sm-12 col-md-6 show-img">
		<img src="<?= URLROOT; ?>/<?= $data['post']->img_file_name; ?>" class="img-fluid mb-3">
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="book-info">
			<span class="emp">Title: </span> <?= $data['post']->title; ?>
		</div>
		<div class="book-info">
			<span class="emp">Author: </span><?= $data['post']->author; ?>
		</div>
		<div class="book-info">
			<span class="emp">Description: </span><?= $data['post']->description; ?>
		</div>
		<div class="book-info">
			<div class="input-group-append">
				<span class="emp">Condition: </span> 
				<div class="mr-2"> 
					<?= $data['post']->book_condition; ?>
				</div>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
				 	<i class="fas fa-info-circle"></i>
				</button>
			</div>
		</div>
		<div class="book-info">
			<span class="emp">Book price: </span><?= $data['post']->book_price; ?>
		</div>
		<div class="book-info">
			<span class="emp">Posted: </span>
			<?php
				$created_at = new DateTime($data['post']->books_created_at);
				echo date_format($created_at,'F d, Y');
			?>
		</div>
	</div>
</div>

<!-- Modal -->
<?php require APPROOT . '/views/inc/modal.php'; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>