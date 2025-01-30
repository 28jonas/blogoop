<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $blog = Blog::find_by_id($id);
    if($blog){
        $blog->soft_delete();
        header("Location: blog-admin.php").
        exit;
    }else{
        echo "User not found";
    }
}

if(isset($_GET['restore'])){
	$id = $_GET['restore'];
	$blog = Blog::find_by_id($id);
	if($blog){
		$blog->restore();
		header("Location: blog-admin.php").
		exit;
	}else{
		echo "Blog not found";
	}
}

?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Blogs
                </h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="active-tab" data-bs-toggle="tab"
                                data-bs-target="#active-tab-pane" type="button" role="tab" aria-controls="active-tab-pane"
                                aria-selected="true">Active BLogs
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive-tab-pane"
                                type="button" role="tab" aria-controls="inactive-tab-pane" aria-selected="false">Inactive Blogs
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="active-tab-pane" role="tabpanel"
                         aria-labelledby="active-tab">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>author_id</th>
                                <th>photo_id</th>
                                <th>title</th>
                                <th>description</th>
                                <th>Created_at</th>
                                <th>Deleted at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $blog = Blog::find_all(); ?>
                            <?php foreach ($blog as $blogs): ?>
                                <?php if($blogs->deleted_at == '0000-00-00 00:00:00'): ?>							<tr>
                                    <td><?= $blogs->id; ?></td>
                                    <td><span><img height="40" width="40" class="avatar me-3"
                                                   src="../admin/assets/static/images/faces/8.jpg"
                                                   alt=""></span><?= $blogs->author_id; ?></td>
                                    <td><?= $blogs->photo_id; ?></td>
                                    <td><?= $blogs->title; ?></td>
                                    <td><?= $blogs->description; ?></td>
                                    <td><?= $blogs->created_at; ?></td>
                                    <td><?= $blogs->deleted_at; ?></td>
                                    <td class="d-flex justify-content-around">
                                        <a href="blog-admin.php?delete=<?= $blogs->id; ?>"
                                           onclick="return confirm('Weet je zeker dat je deze blog post wil verwijderen?')">
                                            <i class="bi bi-trash text-danger"></i>
                                        </a>
                                        <a href="edit-blog.php?id=<?= $blogs->id; ?>">
                                            <i class="bi bi-eye text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="inactive-tab-pane" role="tabpanel" aria-labelledby="inactive-tab">
                        <table class="table table-striped" id="table2">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>author_id</th>
                                <th>photo_id</th>
                                <th>title</th>
                                <th>description</th>
                                <th>Created_at</th>
                                <th>Deleted at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $blog= Blog::find_all(); ?>
                            <?php foreach ($blog as $blogs): ?>
                                <?php if($blogs->deleted_at !== '0000-00-00 00:00:00'): ?>
                                    <tr>
                                        <td><?= $blogs->id; ?></td>
                                        <td><span><img height="40" width="40" class="avatar me-3"
                                                       src="../admin/assets/static/images/faces/8.jpg"
                                                       alt=""></span><?= $blogs->author_id; ?></td>
                                        <td><?= $blogs->photo_id; ?></td>
                                        <td><?= $blogs->title; ?></td>
                                        <td><?= $blogs->description; ?></td>
                                        <td><?= $blogs->created_at; ?></td>
                                        <td><?= $blogs->deleted_at; ?></td>
                                        <td class="d-flex justify-content-around">
                                            <a href="blog-admin.php?restore=<?= $blogs->id; ?>"
                                               onclick="return confirm('Weet je zeker dat je deze blog wil herstellen?')">
                                                <i class="bi bi-bootstrap-reboot text-warning"></i>
                                            </a>
                                            <a href="edit-blog.php?id=<?= $blogs->id; ?>">
                                                <i class="bi bi-eye text-primary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
require_once("includes/widget.php");
require_once("includes/footer.php");
?>