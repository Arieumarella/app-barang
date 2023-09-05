<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/login/fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/login/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/login/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/login/css/style.css">

  <link rel="icon" href="<?= base_url(); ?>assets/login/Logo - pu.png" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/login/Logo - pu.png" type="image/x-icon">

  <title>App - Barang</title>
</head>
<body>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="<?= base_url(); ?>assets/login/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Sign In</h3>
                <p class="mb-4">Silakan masukan Username dan Password. <?= $this->session->flashdata('psn'); ?></p>

              </div>
              <form action="<?= base_url(); ?>Login/prs_login" method="POST">
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" required>

                </div>
                <div class="form-group last mb-4">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" required>

                </div>

                <div class="d-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                </div>

                <input type="submit" value="Log In" class="btn btn-block btn-primary">

              </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
  <script src="<?= base_url(); ?>assets/login/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url(); ?>assets/login/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/login/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/login/js/main.js"></script>
</body>
</html>