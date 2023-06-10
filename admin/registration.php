<?php

include "./common.php";
require_once "./connect_db.php";

if (isset($_POST['register'])) {
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   $user = get_one_data("SELECT * FROM users WHERE username='$username' OR email='$email'");
   if (empty($user)) {
      $data = [
         'username' => $username,
         'email' => $email,
         'password' => $password,
      ];

      insert('users', $data);
      header("Location: ./products/list_product.php");
   }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="./assets/style/sass/style.css">
   <title>Registration</title>
</head>
<?php include './functions.php'; ?>

<body>
   <div class="grid">
      <div class="form__registration">
         <form action="./registration.php" method="post">
            <div class="modal__content">
               <div class="title">
                  <span>Welcome</span>
               </div>
               <div class="modal__body">
                  <div class="input__control">
                     <input type="text" name="username" class="form-control form__control" placeholder="Username">
                  </div>
                  <div class="input__control">
                     <input type="email" name="email" class="form-control form__control" placeholder="Email">
                  </div>
                  <div class="input__control">
                     <input type="password" name="password" class="form-control form__control" placeholder="Password">
                  </div>
                  <div class="form__check">
                     <input class="form-check-input" type="checkbox">
                     <label class="form-check-label">
                        Indeterminate checkbox
                     </label>
                  </div>
                  <div class="form__account">
                     <span>Already have an account?
                        <a href="./login.php">Login in</a> | <a href="./forgot_password.php">Recover
                           password</a>
                     </span>
                  </div>
               </div>
               <div class="modal__footer">
                  <button type="submit" name="register">Đăng kí</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</body>

</html>