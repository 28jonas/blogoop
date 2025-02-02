<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");
?>
	<section class="section">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">
					Blog
				</h5>
			</div>
			<div class="row">
                <?php $blog = Blog::find_all(); ?>
                <?php foreach($blog as $blogs): ?>
                    <?php $photo = Photo::find_by_id($blogs->photo_id); ?>
					<div class="col-xl-4 col-md-6 col-sm-12">
						<div class="col">

							<div class="card">
								<div class="card-content">
									<div class="card-body">
										<h4 class="card-title"><?= $blogs->title; ?></h4>
										<p class="card-text">
                                            <?= $blogs->description; ?>
										</p>
									</div>
									<img class="img-fluid w-100" src="<?= $photo->picture_path(); ?>" alt="Card image cap">
								</div>
								<div class="card-footer d-flex justify-content-between">
									<span><?= $blogs->created_at ?></span>
									<button class="btn btn-light-primary">Read More</button>
								</div>
							</div>

						</div>
					</div>
                <?php endforeach; ?>
			</div>
		</div>

	</section>
<?php
require_once("includes/widget.php");
require_once("includes/footer.php");
?>