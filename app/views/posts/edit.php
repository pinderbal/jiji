<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card card-body bg-light mt-5">
				<h2>Edit <?= $data['title'] ?></h2>
				<p>Please fill all of the following fields: </p>
				
				<form action="<?= URLROOT; ?>/posts/edit/<?php echo $data['id_books']; ?>" method="post">
					<div class="form-group">
						<label for="title">Title: <sup>*</sup></label>
						<input type="text" name="title" class="form-control form-control-lg <?= (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title']; ?>">
						<span class="invalid-feedback"><?= $data['title_error']; ?></span>
					</div>	
					<div class="form-group">
						<label for="author">Author: <sup>*</sup></label>
						<input type="text" name="author" class="form-control form-control-lg <?= (!empty($data['author_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['author']; ?>">
						<span class="invalid-feedback"><?= $data['author_error']; ?></span>
					</div>	
					<div class="form-group">
						<label for="description">Description: <sup>*</sup></label>
						<textarea name="description" class="form-control form-control-lg <?= (!empty($data['description_error'])) ? 'is-invalid' : ''; ?>"><?= $data['description']; ?></textarea>
						<span class="invalid-feedback"><?= $data['description_error']; ?></span>
					</div>
					<div class="form-group">
						<label for="condition">Choose a book condition:</label>
						<select name="condition" id="condition" class="form-control form-control-lg <?= (!empty($data['condition_error'])) ? 'is-invalid' : ''; ?>">
							<option value="">Select One</option>
							<option value="New" <?php echo (isset($data['condition']) && $data['condition'] == 'New') ? 'selected="selected"' : ''; ?>>New</option>
						    <option value="Used - Like New" <?php echo (isset($data['condition']) && $data['condition'] == 'Used - Like New') ? 'selected="selected"' : ''; ?>>Used - Like New</option>
						    <option value="Used - Very Good" <?php echo (isset($data['condition']) && $data['condition'] == 'Used - Very Good') ? 'selected="selected"' : ''; ?>>Used - Very Good</option>
						    <option value="Used - Good" <?php echo (isset($data['condition']) && $data['condition'] == 'Used - Good') ? 'selected="selected"' : ''; ?>>Used - Good</option>
						    <option value="Used - Acceptable" <?php echo (isset($data['condition']) && $data['condition'] == 'Used - Acceptable') ? 'selected="selected"' : ''; ?>>Used - Acceptable</option>
						</select>
						<span class="invalid-feedback"><?= $data['condition_error']; ?></span>
					</div>
					<div class="form-group">
						<label for="price">Price: <sup>*</sup></label>
						<input type="number" name="price" min="0" step=".50"class="form-control form-control-lg <?= (!empty($data['price_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['price']; ?>">
						<span class="invalid-feedback"><?= $data['price_error']; ?></span>
					</div>	
					<div class="row">
						<div class="col">
							<input type="submit" value="Update Ad" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?= URLROOT; ?>/posts/listings" class="btn btn-secondary btn-block">Back</a>
						</div>
					</div>		
				</form>
			</div>
		</div>	
	</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>