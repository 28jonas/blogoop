<?php
 require_once 'includes/header.php';
?>
<?php
    $the_message = "";
    if($session -> is_signed_in()){
        header("location: index.php");
    }

    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        /*check als de user bestaat in onze database*/
        $user_found = User::verify_user($username, $password);

        if($user_found){
            $session -> login($user_found);
            header("location: admin/index.php");
        }else{
            $the_message = "Wrong username or password";
        }
    } else{
        $username = "";
        $password = "";
    }
?>
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.php"><img src="./admin/assets/compiled/svg/logo.svg" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                <?php if(!empty($the_message)): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-check-circle"></i>
                        <?php echo $the_message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                    </div>
                <?php endif; ?>


                <form action="" method="post">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            Keep me logged in
                        </label>
                    </div>
                    <input type="submit" name="submit" value="Log in" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                    <!--<button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>-->
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">Don't have an account? <a href="register.php" class="font-bold">Register here</a>.</p>
                    <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>
</body>
<?php ob_end_flush(); ?>
<script src="./admin/assets/compiled/js/app.js"></script>
</html>