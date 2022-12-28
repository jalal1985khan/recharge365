<?php
session_start();
   /**********************index.php**/
   require_once('includes/global-functions.php');
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="styles/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="styles/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="styles/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="styles/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="styles/dist/css/adminlte.min.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form  action="includes/exec/login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="username" name="mobile">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" onclick="toggle_pass()">
                                <label for="remember">
                    Show Password
                  </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
 



            
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

  


<!-- jQuery -->
<script src="styles/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="styles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="styles/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="styles/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="styles/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>

function toggle_pass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    <?php
   /**********************index.php**/
   if(isset($_SESSION['msg'])){
?>
    Toast.fire({
        icon: 'error',
        title: '<?php echo $_SESSION['msg'];?>'
      }) 
<?php
 unset($_SESSION['msg']);//if user refresh index.php after 1st time it will not see the message
   }
?>
   
  });

 
</script>
</body>
</html>
  
