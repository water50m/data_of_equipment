<?php

include("../../module/condb.php");

session_start();
$otp_expiry_time = 10 * 60 ; // 10 นาทีในหน่วยวินาที
$current_time = time();
$next_current_time = $current_time + 600;
$getemail = $_SESSION["email"];
$getotp = $_POST['otp'];

if($_POST['otp']) {
    $stmt = $pdo->prepare("SELECT * FROM reset_password WHERE otp = :otp");
    $stmt->execute(['otp' => $getotp]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo $current_time-$otp_creation_time;
        if (($next_current_time - $current_time) >= 0) {
            
            if ($getemail == $result["email"]) {
                header('Location: Ui_enter_new_password.php');
                exit; 
            } else {    
                echo '<script>alert("OTP incorrect. Please try again.")</script>';
            }
        } else {
            echo '<script>alert("OTP has expired. Please try again.")</script>';
        }
    } else {
        echo '<script>alert("Invalid OTP. Please try again.")</script>';
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <title>Input OTP</title>

    <style>
        .form-gap {
            padding-top: 70px;
        }
    </style>
</head>

<body onload="startOTPTimer()">
    <div class="form-gap">
        <div class="container mt-4" style="border: 2px solid #BEBEBE; border-radius: 25px; max-width: 620px;">
            <div class="row">
                <div class="col col-md-offset-4 mt-5 mb-5 ml-0 mr-0">

                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Enter OTP?</h2>
                            <p>You can reset your password here.</p>
                            <p>Sent OTP to <?= $getemail ?></p>

                            <form action="" id="register-form" role="form" autocomplete="off" class="form" method="post">
                                <div class="form-group">
                                    <div class="input-group mb-3" style="box-sizing: border-box; width: 70%; margin-left: 80px;">
                                        <input id="email" name="email" style="border-radius: 5px;"
                                            class="form-control" type="hidden" value="<?= $getemail ?>" required>
                                    </div>
                                    <div class="input-group mb-3" style="box-sizing: border-box; width: 70%; margin-left: 80px;">
                                        <input id="otp" name="otp" placeholder="Enter OTP" style="border-radius: 5px;"
                                            class="form-control" type="text" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-lg btn-primary btn-block"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Reset Password</button>

                               
                                <p>Remaining time: <span id="otpTimer"></span></p><a href = "../../module/login/send_mail.php" onclick="restartOTPTimer()">Sent email again</a>



                                <p class="form-check-label mb-0 mt-3">Don't have an account? <a
                                        href="../../view/ui_login/Ui_register.php" class="link-danger">Register</a>
                                </p>
                                <p class="form-check-label">already account? <a
                                        href="../../view/ui_login/Ui_login.php" class="link-danger">Sign in</a></p>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function startOTPTimer() {
            var timerDisplay = document.getElementById('otpTimer');
            var count;

            if (localStorage.getItem('otpCount')) {
                count = localStorage.getItem('otpCount');
            } else {
                count = 10 * 60; // 10 นาทีในหน่วยวินาที
                localStorage.setItem('otpCount', count);
            }

            function countDown() {
                var minutes = Math.floor(count / 60);
                var seconds = count % 60;
                timerDisplay.textContent = minutes + 'm ' + seconds + 's';
                count--;

                localStorage.setItem('otpCount', count);

                if (count >= 0) {
                    setTimeout(countDown, 1000);
                } else {
                    alert("OTP has expired. Please try again.");
                    localStorage.removeItem('otpCount');
                }
            }

            countDown();
        }

        function restartOTPTimer() {
            localStorage.removeItem('otpCount'); // Clear the stored time
            startOTPTimer(); // Restart the timer
        }

        startOTPTimer();





    </script>
</body>

</html>


