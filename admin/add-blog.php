<?php
global $database;
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");

if (!$session->is_signed_in()) {
    header("location: login.php");
}

$the_message = "";

if (isset($_SESSION['the_message'])) {
    $the_message = $_SESSION['the_message'];
    unset($_SESSION['the_message']);
}
if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->user_id = $session->user_id;
    $photo->description = $_POST['title'];
    $photo->alt_text = $_POST['title'];
    $photo->set_file($_FILES['file']);

	//hier gebeurd het wegschrijven van de data, (link) naar de database
    if ($photo->save()) {

        $message = "Foto succesvol opgeladen!";
    } else {
        $message = join("<br>", $photo->errors);
    }

    $blog = new Blog();
    $blog->author_id = $session->user_id;
    $blog->photo_id = mysqli_insert_id($database->connection);
    $blog->title = $_POST['title'];
    $blog->description = $_POST['description'];


    $blog->create();

    if (!empty($blog)) {
        $the_message = "New blog post: " . $blog->title . " created!";
    } else {
        $the_message = "Blog post could not be added";
    }

    /*Zet boodschap in de sessie voor gebruik na redirect*/
    $_SESSION['the_message'] = $the_message;

    /*Voer een redirect uit naar dezelfde pagina(zonder post-data*/
    header("location:" . $_SERVER['PHP_SELF']);
    exit();
}

?>
<div class="col-12">
    <?php if (!empty($the_message)): ?>
		<div class="alert alert-success">
			<i class="bi bi-check-circle"></i>
            <?php echo $the_message ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
    <?php endif; ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Add blog post</h4>
		</div>
		<div class="card-content">
			<div class="card-body">
				<form class="form form-vertical" method="post" enctype="multipart/form-data">
					<div class="form-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group has-icon-left">
									<label for="blog-icon">Blog Titel</label>
									<div class="position-relative">
										<input type="text" class="form-control"
										       placeholder="Typ your blog title" id="blog-icon" name="title">
										<div class="form-control-icon">
											<i class="bi bi-person"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">

								<div class="form-group has-icon-left">
									<label for="email-id-icon">Description</label>
									<div class="position-relative">
                                        <textarea type="text" class="form-control"
                                                  id="email-id-icon" name="description"
                                                  placeholder="Type your firstname" rows="5"
                                                  cols="100%">
                                        </textarea>
										<div class="form-control-icon">
											<i class="bi bi-people"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="file" class="form-label">Choose photo</label>
									<input class="form-control" type="file" id="file" name="file">
								</div>
							</div>
							<div class="col-12 d-flex justify-content-end">
								<input type="submit" name="submit" class="btn btn-primary me-1 mb-1" value="submit">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
require_once("includes/widget.php");
require_once("includes/footer.php");
ob_end_flush()
?>

