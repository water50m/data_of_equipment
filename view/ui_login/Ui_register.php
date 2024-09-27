<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Registration</title>
</head>
<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form class="mx-1 mx-md-4" action="../../module/login/register.php" method="POST">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label for="username">Username </label>
                        <input type="username" class="form-control" name = "username" id="floatingInput" placeholder="Username" required>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" name = "email" id="floatingInput" placeholder="name@example.com" required>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label for="Phone">Phone </label>
                        <input type="Phone" class="form-control" name = "phone" id="floatingInput" placeholder="Phone" required>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name = "password" id="floatingPassword" placeholder="Password" required>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password" required>
                      </div>
                    </div>

                    <div class="form-check d-flex justify-content-center mb-3">
                      <input class="form-check-input me-2" type= "checkbox" value="" id="form2Example3c" />
                      <label class="form-check-label" for="form2Example3">
                        I agree all statements in <a href="#!">Terms of service</a>
                        Have already account? </a><a href="../../view/ui_login/Ui_login.php" class="link-danger">sign in</a>
                      </label>
                    </div>
          
                    <div class="d-flex justify-content-center  mx-4 mb-3 mb-lg-4"></div>
                      <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
                    </div>
                  </form>
                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="../../picture/ddd052d8715737ab01bc3d4806ef8d43.png"
                    class="img-fluid" alt="Sample image">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;

            if (password !== confirm_password) {
                alert("Password and Confirm Password do not match.");
                return false;
            }

            return true;
        }
    </script>
  </body>
</html>
