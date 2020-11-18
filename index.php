<?php
session_start();
if (!empty($_SESSION['active'])){
    header('location: panel_admin/');
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>K-misetas y K-misetas SAS</title>
    <!-- base:css -->
    
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
   
  
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleee.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
   
    <!-- endinject -->
    <link rel="shortcut icon" href="images/icono.png" />
</head>

<body>
    
    <div class="container-scroller d-flex ">
        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center bg-dark">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="images/logo_kamisetas.png" alt="logo">
                            </div>
                            <h1 class="text-white py-5 text-center">Bienvenidos!</h1>
                            <h6 class="font-weight-light text-white">Inicio de sesión.</h6>
                            <form action="" class="pt-3 " method="POST" id="formLogin">
                                <div class="form-group mb-5 ">
                                    <div class="input-group rounded">
                                        <div class="input-group-prepend bg-transparent ">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline  text-kmisetas"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control bg-transparent form-control-lg border-left-0 text-kmisetas" id="usuario" name="usuario" placeholder="Usuario" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text bg-transparent border-right-0 ">
                                                <i class="mdi mdi-lock-outline text-kmisetas"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0 text-kmisetas" id="password" name="password" placeholder="Contraseña">
                                    </div>
                                </div>
                                <a href="recuperar.php" class="auth-link text-kmisetas">Recuperar Usuario y Contraseña</a>

                                <div class="my-3">
                                    <button type="submit" name="submit" id="submit"class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn rounded">Ingresar</button>

                                </div>


                            </form>

                        </div>

                    </div>
                    
                    <div style="background: url(images/<?php echo $aleatorio=(rand(1, 3));?>.png); background-size: cover;" class="col-lg-6 d-none d-lg-flex flex-row">

                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020 K-misetas y K-misetas SAS.</p>

                    </div>

                </div>

            </div>

            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="js/ajaxx.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
   
    <!-- endinject -->
</body>

</html>