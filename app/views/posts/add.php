<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card card-body bg-light mt-5">
				<h2>Create a new ad</h2>
				<p>Please fill all of the following fields: </p>
				
				<form action="<?= URLROOT; ?>/posts/add" method="post" enctype="multipart/form-data">
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
						 <div class="input-group">
						<select name="condition" id="condition" class="form-control form-control-lg <?= (!empty($data['condition_error'])) ? 'is-invalid' : ''; ?>">
							<option value="">Select One</option>
							<option value="New" <?php echo (isset($_POST['condition']) && $_POST['condition'] == 'New') ? 'selected="selected"' : ''; ?>>New</option>
						    <option value="Used - Like New" <?php echo (isset($_POST['condition']) && $_POST['condition'] == 'Used - Like New') ? 'selected="selected"' : ''; ?>>Used - Like New</option>
						    <option value="Used - Very Good" <?php echo (isset($_POST['condition']) && $_POST['condition'] == 'Used - Very Good') ? 'selected="selected"' : ''; ?>>Used - Very Good</option>
						    <option value="Used - Good" <?php echo (isset($_POST['condition']) && $_POST['condition'] == 'Used - Good') ? 'selected="selected"' : ''; ?>>Used - Good</option>
						    <option value="Used - Acceptable" <?php echo (isset($_POST['condition']) && $_POST['condition'] == 'Used - Acceptable') ? 'selected="selected"' : ''; ?>>Used - Acceptable</option>
						</select>

						<div class="input-group-append">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
							 	<i class="fas fa-info-circle"></i>
							</button>
						</div>
						
						<span class="invalid-feedback"><?= $data['condition_error']; ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="price">Price: <sup>*</sup></label>
						<input type="number" name="price" min="0" step=".50"class="form-control form-control-lg <?= (!empty($data['price_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['price']; ?>">
						<span class="invalid-feedback"><?= $data['price_error']; ?></span>
					</div>	
					<div class="form-group">
						<label for="img-upload">Select image to upload: </label>
						<br>
						<input type="file" name="img-upload" id="img-upload" class="<?= (!empty($data['img_error'])) ? 'is-invalid' : ''; ?>">
						<span class="invalid-feedback"><?= $data['img_error']; ?></span>
					</div>
					<div class="row">
						<div class="col">
							<input type="submit" value="Create Ad" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?= URLROOT; ?>/posts/listings" class="btn btn-secondary btn-block">Back</a>
						</div>
					</div>		
				</form>
			</div>
		</div>	
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Book Condition Guidelines</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <strong>New:</strong> A brand-new copy with cover and original protective wrapping intact. Books with markings of any kind on the cover or pages, books marked as "Bargain" or "Remainder," or with any other labels attached, may not be listed as New condition.
	        <hr>
			<strong>Used - Like New:</strong> Item may have minor cosmetic defects (marks, wears, cuts, bends, crushes) on the cover, spine, pages or dust cover. Dust cover is intact and pages are clean and not marred by notes. Item may contain remainder marks on outside edges. Item may be missing bundle media.
			<hr>
			<strong>Used - Very Good:</strong> Item may have minor cosmetic defects (marks, wears, cuts, bends, crushes) on the cover, spine, pages or dust cover. Shrink wrap, dust covers, or boxed set case may be missing. Item may contain remainder marks on outside edges, which should be noted in listing comments. Item may be missing bundled media.
			<hr>
			<strong>Used - Good:</strong> All pages and cover are intact (including the dust cover, if applicable). Spine may show signs of wear. Pages may include limited notes and highlighting. May include "From the library of" labels. Shrink wrap, dust covers, or boxed set case may be missing. Item may be missing bundled media.
			<hr>
			<strong>Used - Acceptable:</strong> All pages and the cover are intact, but shrink wrap, dust covers, or boxed set case may be missing. Pages may include limited notes, highlighting, or minor water damage but the text is readable. Item may but the dust cover may be missing. Pages may include limited notes and highlighting, but the text cannot be obscured or unreadable.
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>