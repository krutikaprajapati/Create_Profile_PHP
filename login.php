<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>login</title>
  <?php include "assets/links/links.php" ?>

  <style>
    .card {
      background-color: #ffac81;
      background-image: linear-gradient(315deg, #ffac81 0%, #ff928b 74%);
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

    $userQuery = "select * from register where username='$username' ";
    $userExist = mysqli_query($con, $userQuery);

    if ($userExist) {

      $dbRow = mysqli_fetch_assoc($userExist);
      $dbpwd = $dbRow['password'];

      $verifypwd = password_verify($password, $dbpwd);
      if ($verifypwd) {
        $dbuserId = $dbRow['id'];

        $searchQuery = "select * from details where userId='$dbuserId' ";
        $runsearchQuery = mysqli_query($con, $searchQuery);
        $detailsRow = mysqli_fetch_assoc($runsearchQuery);

        $_SESSION['username'] = $username;

        $_SESSION['name'] = $detailsRow['name'];
        $_SESSION['enrollment_no'] = $detailsRow['enrollment_no'];
        $_SESSION['email'] = $detailsRow['email'];
        $_SESSION['city'] = $detailsRow['city'];
        $_SESSION['photo'] = $detailsRow['photo'];
        $_SESSION['phone_no'] = $detailsRow['phone_no'];

        header('location:showInfo.php');
      } else {
  ?>
        <script>
          alert("password invalid");
        </script>
      <?php
      }
    } else {
      ?>
      <script>
        alert("User not Exist");
      </script>
  <?php
    }
  }

  ?>
  <section class="vh-100 bg-image">
    <div class="mask d-flex align-items-center h-100">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card " style="border-radius: 15px;">
              <div class="card-body">
                <h2 class="text-uppercase text-center mb-3">Login</h2>
                <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Username" name="username" type="text" id="form3Example1cg" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Password" name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  </div>

                  <div class="d-flex justify-content-center">
                    <button type="submit" name="submit">Login</button>
                  </div>

                  <p class="text-center text-muted mt-2 mb-0">New User?<a href="registration.php" class="fw-bold text-body"><u>Register</u></a></p>

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