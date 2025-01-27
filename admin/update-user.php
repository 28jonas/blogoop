<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");

if(empty($_GET['id'])){
    header("Location: users.php");
}

$user = USER::find_by_id($_GET['id']);

if(isset($_POST['updateUser'])){
    if($user){
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->save();
        header("Location: users.php");
    }
}

?>

<div class="col-12">
    <?php /*if(!empty($the_message)): */?><!--
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            <?php /*echo $the_message */?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
        </div>
    --><?php /*endif; */?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update users</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" method="post">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                               placeholder="Username Input" id="first-name-icon" name="username" value="<?php echo $user->username; ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="form-group has-icon-left">
                                    <label for="email-id-icon">First name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Type your firstname"
                                               id="email-id-icon" name="first_name" value="<?php echo $user->first_name; ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Last name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="last name"
                                               id="mobile-id-icon" name="last_name" value="<?php echo $user->last_name; ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-phone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <input type="submit" name="updateUser" class="btn btn-primary me-1 mb-1" value="Update">
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
?>

