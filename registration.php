<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Regi</title>
  <?php include "assets/links/links.php" ?>
  <style>
    .card {
      background-color: #f39f86;
      background-image: linear-gradient(315deg, #f39f86 0%, #f9d976 74%);
      border: none;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .card:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      transition: opacity 0.3s ease-in-out;
    }

    .card-body h2 {
      color: #161831;
    }

    button {
      width: 120px;
      height: 40px;
      outline: none;
      color: #fff;
      background: #161831;
      cursor: pointer;
      position: relative;
      z-index: 0;
      border-radius: 12px;
      font-size: medium;
      font-weight: bolder;
      border: none;
    }

    button:before {
      content: '';
      background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
      position: absolute;
      top: -2px;
      left: -2px;
      background-size: 300%;
      z-index: -1;
      filter: blur(5px);
      width: calc(100% + 4px);
      height: calc(100% + 4px);
      animation: glowing 20s linear infinite;
      opacity: 0;
      transition: opacity .3s ease-in-out;
      border-radius: 10px;
    }

    button:active {
      color: #161831;
    }

    button:active:after {
      background: transparent;
    }

    button:hover:before {
      opacity: 1;
    }

    button:after {
      z-index: -1;
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background: #161831;
      left: 0;
      top: 0;
      border-radius: 10px;
    }

    @keyframes glowing {
      0% {
        background-position: 0 0;
      }

      50% {
        background-position: 400% 0;
      }

      100% {
        background-position: 0 0;
      }
    }
  </style>
</head>

<body class="bg-light">

  <?php
  include 'config.php';

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $pwd = password_hash($password, PASSWORD_BCRYPT);
    $cpwd = password_hash($cpassword, PASSWORD_BCRYPT);

    $searchQuery = "select * from register where username='$username' ";
    $resultQuery = mysqli_query($con, $searchQuery);

    $noRow = mysqli_num_rows($resultQuery);
    if ($noRow > 0) {
  ?>
      <script>
        alert('user already exist');
      </script>
      <?php
    } else {
      if ($password === $cpassword) {
        $insertQuery = "insert into register(username,password) values('$username','$pwd')";
        $runInsert = mysqli_query($con, $insertQuery);

        if ($runInsert) {

          $idSearch = "select * from register where username='$username' ";
          $resultSearch = mysqli_query($con, $idSearch);
          $addedRow = mysqli_fetch_assoc($resultSearch);
          $userId = $addedRow['id'];
          $_SESSION['userId'] = $userId;
          $_SESSION['username'] = $username;

          header('location:addInfo.php');
        }
      } else {
      ?>
        <script>
          alert('password are not matching');
        </script>
  <?php
      }
    }
  }

  ?>

  <section class="vh-100 ">
    <div class="mask d-flex align-items-center h-100">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body">
                <h2 class="text-uppercase text-center mb-3">Create an account</h2>
                <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Username" name="username" type="text" id="form3Example1cg" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Password" name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-1">
                    <input required placeholder="Enter Confirm Password" type="password" name="cpassword" id="form3Example4cdg" class="form-control form-control-lg" />
                  </div>

                  <div class="form-check d-flex justify-content-center mb-2">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                    <label class="form-check-label" for="form2Example3g">
                      I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center">
                    <button type="submit" name="submit">Register</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>