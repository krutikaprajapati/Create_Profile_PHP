<?php
session_start();
if (!$_SESSION['username']) {
  header('location:registration.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>show</title>
  <?php include "assets/links/links.php" ?>
  <style>
    .card {
      background-color: #70b2d9;
      background-image: linear-gradient(315deg, #70b2d9 0%, #39e5b6 74%);
      border: none;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .card:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      transition: opacity 0.3s ease-in-out;
    }

    input {
      background-color: #d9e4f5;
      background-image: linear-gradient(315deg, #d9e4f5 0%, #f5e3e6 74%);
    }
  </style>
</head>

<body class="bg-light">

  <nav class="navbar navbar-inverse bg-dark">
    <div class="container-fluid">
      <div class="navbar-header">
      </div>

      <button class="bg-warning p-2" style="border: none;"><a href="logout.php" style="text-decoration:none;">LogOut</a></button>
    </div>
  </nav>
  <div class="container mt-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-5">
        <div class="card p-4 text-center">
          <div class="row">
            <div class="col-md-12 border-right no-gutters">
              <div class="py-2"><img src="<?php echo $_SESSION['photo']; ?>" style="height: 7rem;width:7rem;" class="rounded" alt="Userimg">

                <div class="form-outline d-flex mb-1 mt-4">
                  <!-- <label for="html" class="mt-2">Username:</label> -->

                  <input value="Username: <?php echo $_SESSION['username']; ?>" type="text" name="name" id="form3Example4cdg" class="form-control form-control-lg border-0" />
                </div>
                <div class="form-outline d-flex mb-1 mt-4">
                  <!-- <label for="html" class="mt-2">Name:</label> -->

                  <input value="Name: <?php echo $_SESSION['name']; ?>" type="text" name="name" id="form3Example4cdg" class="form-control form-control-lg border-0" />
                </div>

                <div class="form-outline d-flex mb-1 mt-4">
                  <!-- <label for="html" class="mt-2">Enroll.:</label> -->
                  <input value="Enrollment number: <?php echo $_SESSION['enrollment_no']; ?>" type="text" name="enrollment_no" id="form3Example4cdg" class="form-control form-control-lg border-0" />
                </div>


                <div class="form-outline d-flex mb-1 mt-4">
                  <!-- <label for="html" class="mt-2">Email:</label> -->
                  <input value="Email Id: <?php echo $_SESSION['email']; ?>" type="email" name="email" id="form3Example4cdg" class="form-control form-control-lg border-0" />
                </div>


                <div class="form-outline d-flex mb-1 mt-4">
                  <!-- <label for="html" class="mt-2"> City:</label> -->
                  <input value="City: <?php echo $_SESSION['city']; ?>" type="text" name="text" id="form3Example4cdg" class="form-control form-control-lg border-0" />
                </div>


                <div class="form-outline d-flex mb-1 mt-4">
                  <!-- <label for="html" class="mt-2">Ph. num:</label> -->
                  <input value="Phone number: <?php echo $_SESSION['phone_no']; ?>" type="text" name="Phone_no" id="form3Example4cdg" class="form-control form-control-lg border-0" />
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="d-flex  mt-3">
                  <button type="submit" style="border-radius: 12px;><a href="logout.php" style="text-decoration: none;">logOut</a></button>
                </div> -->
</body>

</html>