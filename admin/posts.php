<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");
?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Posts
                </h5>
            </div>
            <div class="row">
                <?php $posts = Post::find_all_posts(); ?>
                <?php foreach($posts as $post): ?>
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="col">

                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $post->titel; ?></h4>
                                        <p class="card-text">
                                            <?= $post->beschrijving; ?>
                                        </p>
                                    </div>
                                    <img class="img-fluid w-100" src="./assets/compiled/jpg/banana.jpg" alt="Card image cap">
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <span><?= $post->datum ?> ></span>
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