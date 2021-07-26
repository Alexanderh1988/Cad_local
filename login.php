<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Cad_local/core/init.php';

session_start();

$_SESSION['start'] = time(); // Taking now logged in time.
// Ending a session in 30 minutes from the starting time.
$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);

$id = isset($_SESSION["id"]) ? $_SESSION["id"] : null;

if (!empty($id)) {
    header('Location: index.php');
}

if ($_POST) {

    $getUsers = "SELECT * FROM `users` where full_name='" . $_POST['username'] . "'";
    $results = $db->query($getUsers);
    $row = $results->fetch_array(MYSQLI_NUM);

    if (isset($row)) {

        $clave = implode("", array_slice($row, 3, 1));
        $id = implode("", array_slice($row, 0, 1));

        if ($_POST['pass'] == $clave) {

            $_SESSION["id"] = $id;
            header('Location: index.php');

        }
    } else {
        ?> <h4>Datos de ingreso incorrectos</h4><?php
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login V12</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/img-01.jpg');">
        <div class="wrap-login100 p-t-190 p-b-30">
            <form class="login100-form validate-form" action="" method="POST">
                <div class="login100-form-avatar">
                    <!--                    <img src="images/avatar-01.jpg" alt="AVATAR">-->
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdmQEqIVtrKcBmDCxbRWkEARZ14r4ceFFxYYeJoWRyV17xi2lX-VKLyO3QB3d6mgAhNeY&usqp=CAU"
                         alt="AVATAR">
                </div>

                <span class="login100-form-title p-t-20 p-b-45">
						identifiquese
					</span>

                <h2>

                </h2>

                <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
                    <input class="input100" type="text" name="username" placeholder="Usuario">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                    <input class="input100" type="password" name="pass" placeholder="Clave">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
                </div>

                <div class="container-login100-form-btn p-t-10">
                    <button class="login100-form-btn" value="submit" type="submit">
                        Entrar
                    </button>
                </div>


                <!--                <div class="text-center w-full p-t-25 p-b-230">-->
                <!--                    <a href="#" class="txt1">-->
                <!--                        Forgot Username / Password?-->
                <!--                    </a>-->
                <!--                </div>-->

                <div class="text-center w-full">
                    <!--						<a class="txt1" href="#">-->
                    <!--							Create new account-->
                    <!--							<i class="fa fa-long-arrow-right"></i>						-->
                    <!--						</a>-->
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>