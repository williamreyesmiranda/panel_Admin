<?php
session_start();
if (!empty($_SESSION['active'])){
    header('location: panel_admin/');
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>K-misetas y K-misetas SAS</title>
   
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleee.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
   <link rel="shortcut icon" href="images/icono.png" />
</head>

<body style="background: url(images/<?php echo $aleatorio=(rand(4, 6));?>.png); background-size: cover; width 100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; ">
    
    <div class="">
               
            
                    <div class="col-lg-4 " style="background:#000000cd; position:fixed ; right: 0%; height:100vh;">
                        <div  class="auth-form-transparent text-center p-3 mx-auto">
                            <div class="brand-logo">
                                <img style="width:300px; margin-bottom:50px;" src="images/logo_kamisetas.png" alt="logo">
                            </div>
                            <form  action="" class="pt-3 " method="POST" id="formLogin">
                                <div class="form-group mb-5 ">
                                    <div class="input-group rounded">
                                        <div class="input-group-prepend bg-transparent ">
                                            <span class="input-group-text bg-transparent border-right-0 "  style="font-size:25px; padding:10px ">
                                                <i class="mdi mdi-account-outline  text-kmisetas"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control bg-transparent form-control-lg border-left-0 text-kmisetas" id="usuario" name="usuario" placeholder="Usuario" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text bg-transparent border-right-0 " style="font-size:25px; padding:10px ">
                                                <i class="mdi mdi-lock-outline text-kmisetas"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg  bg-transparent border-left-0 text-kmisetas" id="password" name="password" placeholder="Contraseña">
                                    </div>
                                </div>
                                <!-- <p style="text-align: right;"> <a href="recuperar.php" class="auth-link text-kmisetas">¿Olvidaste tus datos?</a></p> -->

                                <div style="margin-top: 30px;">
                                    <button type="submit" name="submit" id="submit" style="background-color:  #00a8a8; padding:15px 50px 15px 50px; border-radius:50px; font-weight:600;">Ingresar    </button>

                                </div>


                            </form>

                        </div >
                        <div style="position:absolute; bottom:0%; margin:0% 20%">
                        <p class="text-white font-weight-medium" >Copyright &copy; <?php echo date('Y')?> K-misetas y K-misetas S.A.S.</p>
                        </div>
                        
                    </div>
                    
                    

                        

                   

                </div>

            
            <!-- content-wrapper ends -->
       
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
    <script src="js/ajax.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
   
    <!-- endinject -->
</body>

</html>