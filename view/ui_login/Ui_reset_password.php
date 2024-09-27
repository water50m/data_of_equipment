<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Password Reset</title>
    
</head>
<body>
    <div class="form-gap">
        <div class="container mt-4" style="border: 2px solid #BEBEBE; border-radius: 25px; max-width: 620px;">
            <div class="row">
                <div class="col col-md-offset-4 mt-5 mb-5 ml-0 mr-0">

                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>

                            <form action="../../module/login/update_password.php" id="reset-password-form" role="form" autocomplete="off" class="form" method="post">
                                <div class="form-group">
                                    <div class="input-group mb-3" style="box-sizing: border-box; width: 70%; margin-left: 80px;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                        <input id="new-password" name="new-password" placeholder="New Password" style="border-radius: 5px;" class="form-control" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3" style="box-sizing: border-box; width: 70%; margin-left: 80px;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="Confirm_New_Password" name="Confirm_New_Password" placeholder="Confirm New Password " style="border-radius: 5px;" class="form-control" type="text">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-lg btn-primary btn-block">Reset Password</button>

                                <p class="form-check-label mb-0 mt-3">Don't have an account? <a href="../../view/ui_login/Ui_register.php" class="link-danger">Register</a></p>
                                <p class="form-check-label">Already have an account? <a href="../../view/ui_login/Ui_login.php" class="link-danger">Sign in</a></p>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
