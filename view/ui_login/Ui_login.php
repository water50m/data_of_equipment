<?php

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Registration</title>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>
<body>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="../../picture/sign_in.png"
                    class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="../../module/login/login.php" method="POST">
                <div class="" >
                        <p class="h1 fw-bold mb-0 me-3 mx-1 mx-md-2 mt-4">Sign in</p>
                        
                        <div class="divider d-flex align-items-center my-4"></div>

                        <!-- Email input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="email">Email address</label>
                            <input type="text" name = "email/username"  class="form-control form-control-lg" placeholder="Enter Username or Email" required/>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" name = "password_log"  class="form-control form-control-lg" placeholder="Enter password" required/>
                        </div>

                        <div class="d-flex justify-content-between align-items-center ">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                        <div class="hide text-lg-start mt-1 pt-2">
                            <p class="form-check-label mb-0">Don't have an account? <a href="../../view/ui_login/Ui_register.php" class="link-danger">Register</a></p>
                            <p class="form-check-label">If you forgot password? <a href="../../view/ui_login/Ui_forgot_password.php" class="link-danger">Forgot Password</a></p>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body> 
</html>
