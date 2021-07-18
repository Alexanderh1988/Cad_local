<?php
//servidor
require_once $_SERVER['DOCUMENT_ROOT'] . '/Cad_local/core/init.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

session_start();

if (empty($_SESSION["id"])) {

//en el server
    header('Location: login.php');

}

//$factor = 86400;

if ($_POST) {

    if ($_POST['destroysession'])
    {
        session_destroy();
        header("Location: login.php");

    }

    $numero = (int)$_POST['num'];
    $i = 0;

    while ($i < $numero) {

        if ($_POST['operation']) {

            if ($_POST['' . (string)$i . '&tiempo'] == null) {
                //  if(!isset($_POST[''.(String)$i.'&tiempo'])) {
                $tiempo = 0;
            } else {
                $tiempo = $_POST['' . (string)$i . '&tiempo'] * $factor + time();
            }

            $partid = $_POST['' . (string)$i . '&partid'];
            $descriptor = $_POST['' . (string)$i . '&descriptor'];
            $oem = $_POST['' . (string)$i . '&oem'];
            $extra = $_POST['' . (string)$i . '&extra'];
            $proyecto = $_POST['' . (string)$i . '&proyecto'];
            $fecha = date('Y-m-d');

            /*        <input type="hidden" value="operation" value="<?php if (!isset($_GET['editar']))   'grabar'; else echo 'editar'; ?>">*/

            if ($_POST['operation'] == "grabar") {

                $insertsql = "INSERT INTO `cad_table`(`partid`, `descriptor`, `oem`, `extra`,`proyecto`,`fecha`) 
                        VALUES ('$partid','$descriptor','$oem','$extra','$proyecto','$fecha')";
                $db->query($insertsql);
            }

            //aqui editar
        }

        $i++;

    }

    if ($_POST['editId']) {

        $editId = (int)$_POST['editId'];
        $descriptor = (string)$_POST['descriptor'];
        $oem = (string)$_POST['oem'];
        $extra = (string)$_POST['extra'];
        $proyecto = (string)$_POST['proyecto'];
        $fecha = (string)date('Y-m-d');

        $updatesql = "UPDATE `cad_table` SET `descriptor`='" . $descriptor . "',
                       `oem`='" . $oem . "', `extra`='" . $extra . "',`proyecto`='" . $proyecto . "',
                       `fecha`='" . $fecha . "' WHERE id=$editId";

        $db->query($updatesql);

    }

}  //final de POST principal

if ($_GET) {

    $numero = (int)$_GET['add'];

    $delete = $_GET['delete'];

    if(isset($delete)){
        session_destroy();
        header("Location: login.php");
    }

    $getPartNumber = "SELECT * FROM `cad_table` ORDER BY ID DESC LIMIT 1";

    $result = $db->query($getPartNumber);

    while ($row = mysqli_fetch_array($result)) {
        //hecho "Nombre tabla:" . $row['partid'];

        $partid = (int)$row['partid'] + 1;

    }
}

?>
<head>
    <title>Base de datos CAD</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstraptrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>

    <!--no funciona post con el siguiente codigo-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--<link rel="style    sheet" href="/resources/demos/style.css">-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--<link rel="stylesheet" href="css.css">
    <script src="myscripts.js"></script>-->

    <link rel="stylesheet" href="css.css">
    <script src="scripts.js"></script>

</head>


 <button onclick="location.href = 'index.php?delete=1';" id="myButton"  type="button"
         class="btn btn-danger pull-right btn-sm" style="width:200px">Cerrar sesion
 </button>

<!--<form style="width:200px; margin-left: 80%;height: 60px" action="index.php">-->
<!--    <input name="destroysession" class="btn btn-danger pull-right btn-sm" type="submit" value="Cerrar sesion"/>-->
<!--</form>-->

<div id="login-form" style="width: 95%;">  <!-- 1 -->
    <h2 class="text-center">&nbsp&nbsp CAD datos

        <?php
        // var_dump($_POST[''.$i.'&tiempo']).' - '.var_dump(isset($_POST[''.$i.'&tiempo']));
        ?>
    </h2>

    <div data-role="header">
        <!-- <h1>jQuery Mobile : Reflow</h1> -->
    </div>

    <div role="main" class="ui-content">   <!-- 2 -->

        <!--  <form action="index.php" method="post">  -->

        <form action="index.php" method="post">

            <table data-role="table" class="ui-responsive table-stroke">

                <!-- Set the Data-role the Table , the reflow is applied by   default-->
                <thead>
                <tr>
                    <th>Numero de parte</th>
                    <th>Descripcion</th>
                    <th>OEM</th>
                    <th>Extra</th>
                    <th>Proyecto</th>
                    <th>Fecha</th>

                    <!-- aca no funciona post -->
                </tr>
                </thead>
                <tbody>

                <!-- //aca no funciona post -->

                <?php

                if (isset($_GET['delete'])) {

                    $deleteid = $_GET['id'];
                    $deleteidquery = "DELETE FROM `cad_table` WHERE id=$deleteid";
                    $db->query($deleteidquery);
                    header("Location: index.php?todo");

                }
                //muestra los ultimos 10 para que no haya una lista tan grande
                if (isset($_GET['todo'])) {
                    $sql = "SELECT * FROM `cad_table` ";
                } //else if(!isset($_GET['todo'])) {
                else {
                    $sql = "SELECT * FROM `cad_table` ORDER BY id ASC LIMIT 10";
                }
                if (isset($_POST['busqueda'])) {

                    $BusquedaParcial = (string)$_POST['busqueda'];
                    //$sql = "SELECT * FROM cad_table";
                    $sql = "SELECT * FROM cad_table WHERE partid LIKE '%" . $BusquedaParcial . "%' 
                    OR  descriptor LIKE '%" . $BusquedaParcial . "%'
                    OR  oem LIKE '%" . $BusquedaParcial . "%'
                    OR  extra LIKE '%" . $BusquedaParcial . "%'
                    OR  proyecto LIKE '%" . $BusquedaParcial . "%'";

                }
                if (isset($_GET['editar'])) {
                    $editId = (int)$_GET['editar'];
                }

                $total = 0;
                $k = 0;

                //  $sql = "SELECT * FROM cad_table";

                $featured = $db->query($sql);

                while ($dato = mysqli_fetch_assoc($featured)):

                    $id = $dato['id'];
                    $partId = $dato['partid'];
                    $descriptor = $dato['descriptor'];
                    $oem = $dato['oem'];
                    $extra = $dato['extra'];
                    $proyecto = $dato['proyecto'];
                    $fecha = $dato['fecha'];

                    ?>
                    <tr>
                        <td><?php
                            if (strlen($partId) == 1) {
                                echo "000-00" . ($partId);
                            } else if (strlen($partId) == 2) {
                                echo "000-0" . ($partId);
                            } else if (strlen($partId) == 3) {
                                echo "000-" . ($partId);
                            } else if (strlen($partId) == 4) {
                                echo "000-" . ($partId);
                            };
                            ?></td>
                        <?php

                        $editId = isset($editId) ? $editId : -1;

                        if ($id == $editId) {  //solo se edita la fla que se quiere editar.
                            ?>

                            <input name="editId" value="<?php echo $editId ?>" type="hidden"/>
                            <td><input value="<?= $descriptor; ?>" type="text" name="descriptor"></td>
                            <td><input value="<?= $oem; ?>" type="text" name="oem"></td>
                            <td><input value="<?= $extra; ?>" type="text" name="extra"></td>
                            <td><input value="<?= $proyecto; ?>" type="text" name="proyecto"></td>
                            <td><h4> <?= date('Y-m-d'); ?>  </h4></td>


                        <?php } else {
                            ?>

                            <td><?= $descriptor; ?></td>
                            <td><?= $oem; ?></td>
                            <td><?= $extra; ?></td>
                            <td><?= $proyecto; ?></td>
                            <td><?= $fecha; ?>
                                <a style="display: none;" data-ajax="false" href="index.php?delete&id=<?= $id; ?>"
                                   class="eliminar">
                                    <span class="glyphicon glyphicon-trash pull-right"></span>
                                    <a style="display: none;" data-ajax="false"
                                       href="index.php?editar=<?= $id; ?>&id=<?= $id; ?>"
                                       class="editar">
                                        <span class="glyphicon glyphicon-pencil pull-right"></span>
                                    </a>
                            </td>

                        <?php } ?>
                    </tr>
                <?php

                endwhile;

                $numero = 0; ?>

                <!--  <form action="index.php" method="post">  -->

                <?php
                if (isset($_GET['add'])) {

                    $numero = isset($_GET['add']) ? (int)$_GET['add'] : 0;
                    $numero = (int)$_GET['add'];

                    if ((int)$_GET['add'] == 0) $numero = 1;
                    if ((int)$_GET['add'] == 1) $numero = 2;
                    if ((int)$_GET['add'] == 2) $numero = 3;
                    if ((int)$_GET['add'] == 3) $numero = 4;
                    if ((int)$_GET['add'] == 4) $numero = 5;
                    if ((int)$_GET['add'] == 5) $numero = 6;
                    if ((int)$_GET['add'] == 6) $numero = 7;

                    $i = 0;
                    while ($i < $numero) {
                        ?>
                        <tr>
                            <th><h4> <?php

                                    if (strlen($partid + $i) == 1) {
                                        echo "000-00" . ($partid + $i);
                                    } else if (strlen($partid + $i) == 2) {
                                        echo "000-0" . ($partid + $i);
                                    } else if (strlen($partid + $i) == 3) {
                                        echo "000-" . ($partid + $i);
                                    } else if (strlen($partid + $i) == 4) {
                                        echo "000-" . ($partid + $i);
                                    }

                                    ?>  </h4></th>

                            <input type="hidden" value="<?= $partid + $i; ?>" name="<?= $i; ?>&partid">

                            <td><input type="text" name="<?= $i; ?>&descriptor"></td>
                            <td><input type="text" name="<?= $i; ?>&oem"></td>
                            <td><input type="text" name="<?= $i; ?>&extra"></td>
                            <td><input type="text" name="<?= $i; ?>&proyecto"></td>
                            <td><h4> <?= date('Y-m-d'); ?>  </h4></td>

                        </tr>

                        <?php $i++;
                    }
                } ?>

                </tbody>

            </table>

            <div class="ui-field-contain">
                <hr>
                <?php if (isset($_GET['add']) || isset($_GET['editar'])) { ?>

                    <button data-theme="c" type="submit" data-inline="true" href="index.php">  <!--onclick="callme()"-->
                        <?php if (!isset($_GET['editar'])) echo 'Guardar datos'; else echo 'Guardar edicion'; ?>
                    </button>

                    <input type="hidden" name="operation"
                           value="<?php if (!isset($_GET['editar'])) echo 'grabar'; else echo 'editar'; ?>">

                <?php } ?>

                <!-- <input data-theme="a" type="hidden" ame="fechaingreso" value="<?= date("d/m/Y"); ?>"> -->
                <input data-theme="a" type="hidden" name="num" value="<?= $numero; ?>">
                <!-- <input data-theme="a" type="hidden" name="tiempovar" value="<?= time(); ?>"> -->

                <a data-ajax="false" href="index.php?add=<?= $numero; ?>" data-role="button"
                   data-inline="true">Agregar </a>

                <!--   <a data-theme="e" rel="external" href="index.php" data-role="button" data-inline="true"
                          data-theme="b">Actualizar</a> -->

                <a data-theme="d" rel="external" onclick="editar();" data-role="button" data-inline="true"
                   data-theme="b"> Editar </a>

                <a data-theme="c" rel="external" href="index.php" data-role="button" data-inline="true"
                   data-theme="b">Cancelar</a>

                <a data-theme="c" rel="external" href="index.php?todo" data-role="button" data-inline="true"
                   data-theme="b">Mostrar todo</a>

                <a data-theme="c" rel="external" onclick="mostrar();" data-role="button" data-inline="true"
                   data-theme="b">Eliminar</a>

                <input type="text" data-role="none" placeholder="Escriba" name="busqueda">

                <button data-theme="c" value="submit" type="submit" data-inline="true">Buscar</button>

        </form>

        <!--  <a data-theme="c" rel="external" onclick="mostrar();" data-role="button" data-inline="true"
                             data-theme="b">Repetir (solo fecha)</a>
                    <input data-inline="true" display="hidden" data-theme="a" type="number" name="num"
                           value="<?= $numero; ?>"> -->

        <!--        <a data-theme="c" rel="external" href="historico.php" data-role="button" data-inline="true"
                   data-theme="b"
                   class="btn btn-secondary pull-right">Ver historial</a>-->

    </div>

</div>          <!-- 1 -->
</div>    <!-- 2 -->

</form>

</body>




