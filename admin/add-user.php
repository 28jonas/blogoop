<?php
require_once("includes/header.php");
ob_start();
require_once("includes/sidebar.php");
require_once("includes/content-top.php");
$the_message="";
if(isset($_SESSION['the_message'])){
    $the_message=$_SESSION['the_message'];
    unset($_SESSION['the_message']);
}
if(isset($_POST['submit'])){
    $user = new User();
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->password = $_POST['password'];

    $user->create();

    if(!empty($user)){
        $the_message = "New user: ".$user->first_name." ".$user->last_name." created!";
    }else{
        $the_message = "User could not be added";
    }

    /*Zet boodschap in de sessie voor gebruik na redirect*/
    $_SESSION['the_message'] = $the_message;

    /*Voer een redirect uit naar dezelfde pagina(zonder post-data*/
    header("location:" .$_SERVER['PHP_SELF']);
    exit();
}

?>
<div class="col-12">
    <?php if(!empty($the_message)): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            <?php echo $the_message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add users</h4>
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
                                               placeholder="Typ your username" id="first-name-icon" name="username">
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
                                               id="email-id-icon" name="first_name">
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
                                               id="mobile-id-icon" name="last_name">
                                        <div class="form-control-icon">
                                            <i class="bi bi-phone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" placeholder="Password"
                                               id="password-id-icon" name="password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
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

