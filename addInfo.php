<?php
session_start();
if (!$_SESSION['username']) {
?>
  <script>
    alert("Please first register yourself");
  </script>
<?php
  header(('location:registration.php'));
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Add data</title>
  <style>
    .card {
      background-color: #ffcfdf;
      background-image: linear-gradient(315deg, #ffcfdf 0%, #b0f3f1 74%);
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

  <?php include "assets/links/links.php" ?>

</head>

<body class="bg-light">

  <?php
  include 'config.php';
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $enrollment_no = $_POST['enrollment_no'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $phone_no = $_POST['phone_no'];
    $userId = $_SESSION['userId'];

    $searchQuery = "select * from details where email='$email' ";
    $runSearchQuery = mysqli_query($con, $searchQuery);
    $emailExist = mysqli_num_rows($runSearchQuery);
    if ($emailExist > 0) {
  ?>
      <script>
        alert("Email already registered");
      </script>
      <?php
    } else {
      $filename = $_FILES['file']['name'];
      $tempname = $_FILES['file']['tmp_name'];

      $path = "assets/userImg/" . $filename;

      if (move_uploaded_file($tempname, $path)) {
        $_SESSION['photo'] = $path;
      } else {
        $path = "assets/userImg/person.jpg";
        $_SESSION['photo'] = $path;
      }


      $insertQuery = "insert into details(userId,name,enrollment_no,email,city,phone_no,photo) values('$userId','$name','$enrollment_no','$email','$city','$phone_no','$path')";
      $runInsert = mysqli_query($con, $insertQuery);

      if ($runInsert) {

        $_SESSION['name'] = $name;
        $_SESSION['enrollment_no'] = $enrollment_no;
        $_SESSION['email'] = $email;
        $_SESSION['city'] = $city;
        $_SESSION['phone_no'] = $phone_no;

        header('location:showInfo.php');
      } else {
      ?>
        <script>
          alert("Row not inserted");
        </script>
  <?php
      }
    }
  }
  ?>

  <section class="vh-100 bg-image">
    <div class="mask d-flex align-items-center h-100">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body">
                <h2 class="text-uppercase text-center mb-3">Add Your Details</h2>
                <form method="POST" enctype="multipart/form-data">
                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Your name" name="name" type="text" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Your Enrollment number" name="enrollment_no" type="text" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Your Email Id" name="email" type="email" id="form3Example4cg" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <input required placeholder="Enter City name" name="city" type="text" id="form3Example4cg" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline mb-4">
                    <input required placeholder="Enter Your Phone number" name="phone_no" id="form3Example4cg" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <label for="photo" style="font-size:1.3rem;">Add Your Photo</label><br>
                    <input type="file" id="photo" name="file">
                  </div>
                  <div class="d-flex justify-content-center mt-1">
                    <button type="submit" name="submit" style="border-radius: 12px;">Save</button>
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