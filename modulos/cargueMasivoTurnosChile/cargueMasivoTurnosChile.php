<?php
include(RAI_RUTA_TURNOS . './plantilla/plantilla.php');
include(RAI_RUTA_TURNOS . './PHPExcel/Classes/PHPExcel.php');
include(RAI_RUTA_TURNOS . './PHPExcel/Classes/PHPExcel/Reader/Excel2007.php');
include(RAI_RUTA_TURNOS . './conexion/conexion.php');
include(RAI_RUTA_TURNOS . './listar/listas.php');
global $wpdb;
ini_set('max_execution_time', 0);
?>
<br>
<div class="page-heading">       
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card ancho">
                    <div class="card-header">
                        <h5 class="card-title titulo">Cargue masivo turnos Chile</h5>
                        <a style="margin-top: -54px; margin-left: 93%" href="../wp-content/plugins/turnos/modulos/plantillaCargue/plantillaChile.xlsx" download="Plantilla turnos.xlsx" class="btn btn-primary me-1 mb-1" > Plantilla</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="basicInput">Semana</label>
                                <fieldset class="form-group">
                                    <select class="form-select"  name="semanaAnio" id="semanaAnio" onchange="cargueMes()">
                                        <option value="">Seleccionar</option>
                                        <?php echo $fechas ?>
                                    </select>
                                </fieldset>  
                            </div> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="tab-content py-3 px-3 px-sm-0 " id="nav-tabContent">
                                    <div class="mdl-grid" style="padding-left:5px;margin-right:5px; justify-content: center">
                                        <div class="col-3" id="agente" style=" background: #B2DFDB; border-radius: 5px ; color: #000 ; display: none"  >
                                            <b> &nbsp;Numero de empleado  ya existe &nbsp;</b>
                                        </div>
                                        &nbsp;
                                        <div class="col-3" id="empleado" style=" background: #FFF9C4; border-radius: 5px ; color: #000; display: none"  >
                                            <b> &nbsp;Empleado  no existe&nbsp;</b>
                                        </div>
                                        &nbsp;
                                        <div class="col-3" id="tx" style=" background: #EF9A9A; border-radius: 5px ; color: #000; display: none"  >
                                            <b> &nbsp;Tx ya existe&nbsp;</b>
                                        </div>
                                        &nbsp;
                                    </div>

                                    <div class="dropzone-area">
                                        <div class="row" id="seOcultaCarga">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <form name="importa" method="POST"  enctype="multipart/form-data" >
                                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                                        <span class="input-group-btn">
                                                            <button id="fake-file-button-browse" disabled="" type="button" class="btn btn-primary me-1 mb-1">
                                                            <b>SELECCIONAR</b>
                                                            </button>                                                             
                                                        </span>
                                                        <input type="file" name="excel" id="files-input-upload" class="form-control input-sm"  style="display:none">
                                                        <input type="text" id="fake-file-input-name" disabled="disabled"  class="form-control input-sm" placeholder="Seleccione un archivo" >
                                                        <input type="hidden" value="TxtVer" name="action" />
                                                        <input type="hidden"  name="TxtSemanaAnio" id="semanaAnio1"/>

                                                        <span class="input-group-btn">
                                                            <button type='submit' class="btn btn-primary me-1 mb-1"  disabled="" id="fake-file-button-upload">
                                                         <b> CARGAR</b>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!--===================Fin Boton cargar Archivo===================-->
                                    <!--===================Fin Cargar Archivo===================-->
                                    <?php
                                    $quienCrea = $user_general;
                                    $action = NULL;
                                    $archivo = NULL;
                                    extract($_POST);
                                    if ($action == "TxtVer") {
                                        $archivo = $_FILES['excel']['name']; //captura el nombre del archivo
                                        $_SESSION['archi'] = $_FILES['excel']['name'];
                                        $_SESSION['TxtSemanaAnio'] = $_POST["TxtSemanaAnio"];
                                        $tipo = $_FILES['excel']['type']; //captura el tipo de archivo (2003 o 2007)
                                        $destino = RAI_RUTA_TURNOS . './archivos/bak_' . $archivo; //lugar donde se copiara el archivo
                                        if (copy($_FILES['excel']['tmp_name'], $destino)) { //si dese copiar la variable excel (archivo).nombreTemporal a destino (bak_.archivo) (si se ha dejado copiar)
                                            $archiv = RAI_RUTA_TURNOS . './archivos/bak_' . $_SESSION['archi'];
                                            $inputFileType = PHPExcel_IOFactory::identify($archiv);
                                            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                            $objPHPExcel = $objReader->load($archiv);
                                            $sheet = $objPHPExcel->getSheet(0);
                                            $highestRow = $sheet->getHighestRow();
                                            $highestColumn = $sheet->getHighestColumn();
                                            $idContador = 2;
                                            $agenteAlert = 0;
                                            $txAlert = 0;
                                            $empleadoAlert = 0;
                                            ?>
                                            <div class="mdl-grid" style="padding-left:5px;margin-right:5px; justify-content: center">
                                                <?php
                                                for ($row = 1; $row < 2; $row++) {
                                                    $columnaAgente = $sheet->getCell("A" . $row)->getValue();
                                                    $columnaTx = $sheet->getCell("B" . $row)->getValue();

                                                    $error = 0;

                                                    if ($columnaAgente != 'IDMETA') {
                                                        ?>
                                                        <script> $(function () {
                                                                alertas = document.getElementById("botonImportar");
                                                                alertas.style.display = 'none';
                                                            });
                                                        </script>
                                                        <div class="col-3" style=" background: #FFCDD2; border-radius: 5px ; color: #000"  >
                                                            <b> &nbsp;La columna Numero de empleado no corresponde&nbsp;</b>
                                                        </div>
                                                        &nbsp;
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!--===================Fin Cargar Archivo===================-->
                                            <!--===================Tabla===================-->
                                            <input id="OcultarBotnArchivo" value="1" hidden="">
                                            <div class="mdl-grid" style="padding-left:5px;margin-right:5px; justify-content: center; margin-top: 5%">
                                                <table id="turnos" class="table table-bordered table-striped tablaAjuste"  style="font-size: 11px">
                                                    <thead>
                                                        <tr>
                                                            <th>N</th>
                                                            <th>Idmeta</th>
                                                            <th>Centro</th>
                                                            <th>Apellido</th>
                                                            <th>Nombre</th>
                                                            <th>Rut</th>
                                                            <th>N_Empleado</th>
                                                            <th>Servicio</th>
                                                            <th>Duracion_Turno</th>
                                                            <th>Hora_Desde</th>
                                                            <th>Descanso_20</th>
                                                            <th>Descanso_30</th>
                                                            <th>Descanso_10</th>
                                                            <th>Hora_Hasta</th>
                                                            <th>L</th>
                                                            <th>M</th>
                                                            <th>X</th>
                                                            <th>J</th>
                                                            <th>V</th>
                                                            <th>S</th>
                                                            <th>D</th>            
                                                            <th>Campa&ntilde;a</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        for ($row = 2; $row <= $highestRow; $row++) {
                                                            $columnaAgente = $sheet->getCell("A" . $row)->getValue();
                                                            $columnaTx = $sheet->getCell("B" . $row)->getValue();
                                                            ?>
                                                            <tr> 
                                                                <td><span><b><?php echo $idContador ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("A" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("B" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("C" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("D" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("E" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("F" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("G" . $row)->getValue(); ?></b></span></td>

                                                                <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("H" . $row)->getValue(), 'hh:mm'); ?></b></span></td>
                                                                <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("I" . $row)->getValue(), 'hh:mm'); ?></b></span></td>
                                                                <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("J" . $row)->getValue(), 'hh:mm'); ?></b></span></td>
                                                                <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("K" . $row)->getValue(), 'hh:mm'); ?></b></span></td>
                                                                <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("L" . $row)->getValue(), 'hh:mm'); ?></b></span></td>
                                                                <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("M" . $row)->getValue(), 'hh:mm'); ?></b></span></td>



                                                                <td><span><b><?php echo $sheet->getCell("N" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("O" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("P" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("Q" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("R" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("S" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("T" . $row)->getValue(); ?></b></span></td>
                                                                <td><span><b><?php echo $sheet->getCell("U" . $row)->getValue(); ?></b></span></td>

                                                            </tr> 
                                                            <?php
                                                            $idContador++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>   
                                                <br>
                                                <form name="importa" method="POST"  enctype="multipart/form-data" >
                                                    <input type="hidden" value="upload" name="action" />
                                                    <div class="col-sm-8 " style="margin-left: 45%" id="botonImportar">
                                                        <input name="archibo" value="<?php echo $_SESSION['archi'] ?>" type="hidden">
                                                        <input name="TxtSemanaAnio2" value="<?php echo $_SESSION['TxtSemanaAnio'] ?>" type="hidden">

                                                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                            <button type='submit' class="btn btn-primary me-1 mb-1" >
                                                           <b> Importar</b>
                                                            </button>
                                                        </div> 
                                                    </div>
                                                </form>
                                                <br>
                                                <br>
                                            </div>
                                            <!--===================Fin tabla===================-->
                                            <?php
                                            if ($agenteAlert > 0) {
                                                ?>
                                                <input id="cargueAgente" value="1" hidden="">
                                                <?php
                                            }
                                            if ($empleadoAlert > 0) {
                                                ?>
                                                <input id="cargueEmpleado" value="1" hidden="">
                                                <?php
                                            }
                                            if ($txAlert > 0) {
                                                ?>
                                                <input id="cargueTx" value="1" hidden="">
                                                <?php
                                            }
                                        }
                                    }
                                    /* ======================= Accion Cargar a la base de Datos =========================== */
                                    extract($_POST);
                                    if ($action == "upload") {
                                        $archivo = $_POST['archibo'];
                                        $semanaAnio2 = $_POST['TxtSemanaAnio2'];
                                        $destino = RAI_RUTA_TURNOS . './archivos/bak_' . $archivo;
                                        if (file_exists(RAI_RUTA_TURNOS . './archivos/bak_' . $archivo)) {
                                            $objReader = new PHPExcel_Reader_Excel2007();
                                            $objPHPExcel = $objReader->load(RAI_RUTA_TURNOS . './archivos/bak_' . $archivo);
                                            $objFecha = new PHPExcel_Shared_Date();
                                            $objPHPExcel->setActiveSheetIndex(0);
                                            $i = 2;
                                            $param = 0;
                                            $contador = 0;
                                            $suma = 0;
                                            while ($param == 0) {
                                                $idMeta = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                                                $centro = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                                                $apellido = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                                                $nombre = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                                                $rut = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
                                                $numeroEmpleado = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                                                $servicio = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
                                                $duracionTurno = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue(), 'hh:mm');
                                                $horaDesde = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue(), 'hh:mm');
                                                $descanso20 = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue(), 'hh:mm');
                                                $descanso30 = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue(), 'hh:mm');
                                                $descanso10 = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue(), 'hh:mm');
                                                $horaHastas = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('M' . $i)->getCalculatedValue(), 'hh:mm');


                                                $lunes = $objPHPExcel->getActiveSheet()->getCell('N' . $i)->getCalculatedValue();
                                                $martes = $objPHPExcel->getActiveSheet()->getCell('O' . $i)->getCalculatedValue();
                                                $miercoles = $objPHPExcel->getActiveSheet()->getCell('P' . $i)->getCalculatedValue();
                                                $jueves = $objPHPExcel->getActiveSheet()->getCell('Q' . $i)->getCalculatedValue();
                                                $viernes = $objPHPExcel->getActiveSheet()->getCell('R' . $i)->getCalculatedValue();
                                                $sabado = $objPHPExcel->getActiveSheet()->getCell('S' . $i)->getCalculatedValue();
                                                $domingo = $objPHPExcel->getActiveSheet()->getCell('T' . $i)->getCalculatedValue();
                                                $campa = $objPHPExcel->getActiveSheet()->getCell('U' . $i)->getCalculatedValue();


                                                if ($nombre !== NULL) {

                                                    if ($lunes !== NULL) {
                                                        $diaDesL = date('d', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 2 . ' day'));
                                                        $mesDesL = date('m', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 2 . ' day'));
                                                        $anoDesL = date('Y', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 2 . ' day'));


                                                        $sqlLunes = "INSERT INTO `{$wpdb->prefix}co_turnos`  (`idMeta`, `centro`, `apellido`, `nombre`,
                                                                `rut`, `numeroEmpleado`, `servicio`, `duracionTurno`, `horaDesde`, `descanso20`, `descanso30`, 
                                                                `descanso10`, `horaHastas`,  `quienCarga`, `semanaAnio` ,`codigo`  ,`campania`  ,`lugar`,`dia`,`fechaDia`) VALUES ('$idMeta', '$centro', '$apellido', 
                                                                    '$nombre', '$rut', '$numeroEmpleado', '$servicio', '$duracionTurno', '$horaDesde',
                                                                '$descanso20', '$descanso30', '$descanso10', '$horaHastas',  '$quienCrea', '$semanaAnio2', '$lunes','$campa','CHILE','Lunes','$anoDesL-$mesDesL-$diaDesL');";

                                                        $conexion->query($sqlLunes);
                                                    }
                                                    if ($martes !== NULL) {
                                                        $diaDesM = date('d', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 3 . ' day'));
                                                        $mesDesM = date('m', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 3 . ' day'));
                                                        $anoDesM = date('Y', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 3 . ' day'));
                                                        $sqlMartes = "INSERT INTO `{$wpdb->prefix}co_turnos`  (`idMeta`, `centro`, `apellido`, `nombre`,
                                                                `rut`, `numeroEmpleado`, `servicio`, `duracionTurno`, `horaDesde`, `descanso20`, `descanso30`, 
                                                                `descanso10`, `horaHastas`,  `quienCarga`, `semanaAnio` ,`codigo`  ,`campania`  ,`lugar`,`dia`,`fechaDia`) VALUES ('$idMeta', '$centro', '$apellido', 
                                                                    '$nombre', '$rut', '$numeroEmpleado', '$servicio', '$duracionTurno', '$horaDesde',
                                                                '$descanso20', '$descanso30', '$descanso10', '$horaHastas', '$quienCrea', '$semanaAnio2', '$martes','$campa','CHILE','Martes','$anoDesM-$mesDesM-$diaDesM');";

                                                        $conexion->query($sqlMartes);
                                                    }
                                                    if ($miercoles !== NULL) {

                                                        $diaDesMi = date('d', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 4 . ' day'));
                                                        $mesDesMi = date('m', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 4 . ' day'));
                                                        $anoDesMi = date('Y', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 4 . ' day'));
                                                        $sqlMiercoles = "INSERT INTO `{$wpdb->prefix}co_turnos`  (`idMeta`, `centro`, `apellido`, `nombre`,
                                                                `rut`, `numeroEmpleado`, `servicio`, `duracionTurno`, `horaDesde`, `descanso20`, `descanso30`, 
                                                                `descanso10`, `horaHastas`,  `quienCarga`, `semanaAnio` ,`codigo`  ,`campania`  ,`lugar`,`dia`,`fechaDia`) VALUES ('$idMeta', '$centro', '$apellido', 
                                                                    '$nombre', '$rut', '$numeroEmpleado', '$servicio', '$duracionTurno', '$horaDesde',
                                                                '$descanso20', '$descanso30', '$descanso10', '$horaHastas', '$quienCrea', '$semanaAnio2', '$miercoles','$campa','CHILE','Miercoles','$anoDesMi-$mesDesMi-$diaDesMi');";

                                                        $conexion->query($sqlMiercoles);
                                                    }
                                                    if ($jueves !== NULL) {
                                                        $diaDesJ = date('d', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 5 . ' day'));
                                                        $mesDesJ = date('m', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 5 . ' day'));
                                                        $anoDesJ = date('Y', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 5 . ' day'));

                                                        $sqlJueves = "INSERT INTO `{$wpdb->prefix}co_turnos`  (`idMeta`, `centro`, `apellido`, `nombre`,
                                                                `rut`, `numeroEmpleado`, `servicio`, `duracionTurno`, `horaDesde`, `descanso20`, `descanso30`, 
                                                                `descanso10`, `horaHastas`,  `quienCarga`, `semanaAnio` ,`codigo`  ,`campania`  ,`lugar`,`dia`,`fechaDia`) VALUES ('$idMeta', '$centro', '$apellido', 
                                                                    '$nombre', '$rut', '$numeroEmpleado', '$servicio', '$duracionTurno', '$horaDesde',
                                                                '$descanso20', '$descanso30', '$descanso10', '$horaHastas', '$quienCrea', '$semanaAnio2', '$jueves','$campa','CHILE','Jueves','$anoDesJ-$mesDesJ-$diaDesJ');";

                                                        $conexion->query($sqlJueves);
                                                    }
                                                    if ($viernes !== NULL) {
                                                        $diaDesV = date('d', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 6 . ' day'));
                                                        $mesDesV = date('m', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 6 . ' day'));
                                                        $anoDesV = date('Y', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 6 . ' day'));

                                                        $sqlViernes = "INSERT INTO `{$wpdb->prefix}co_turnos`  (`idMeta`, `centro`, `apellido`, `nombre`,
                                                                `rut`, `numeroEmpleado`, `servicio`, `duracionTurno`, `horaDesde`, `descanso20`, `descanso30`, 
                                                                `descanso10`, `horaHastas`,  `quienCarga`, `semanaAnio` ,`codigo`  ,`campania`  ,`lugar`,`dia`,`fechaDia`) VALUES ('$idMeta', '$centro', '$apellido', 
                                                                    '$nombre', '$rut', '$numeroEmpleado', '$servicio', '$duracionTurno', '$horaDesde',
                                                                '$descanso20', '$descanso30', '$descanso10', '$horaHastas', '$quienCrea', '$semanaAnio2', '$viernes','$campa','CHILE','Viernes','$anoDesV-$mesDesV-$diaDesV');";

                                                        $conexion->query($sqlViernes);
                                                    }
                                                    if ($sabado !== NULL) {

                                                        $diaDesS = date('d', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 7 . ' day'));
                                                        $mesDesS = date('m', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 7 . ' day'));
                                                        $anoDesS = date('Y', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 7 . ' day'));

                                                        $sqlSabado = "INSERT INTO `{$wpdb->prefix}co_turnos`  (`idMeta`, `centro`, `apellido`, `nombre`,
                                                                `rut`, `numeroEmpleado`, `servicio`, `duracionTurno`, `horaDesde`, `descanso20`, `descanso30`, 
                                                                `descanso10`, `horaHastas`,  `quienCarga`, `semanaAnio` ,`codigo`  ,`campania`  ,`lugar`,`dia`,`fechaDia`) VALUES ('$idMeta', '$centro', '$apellido', 
                                                                    '$nombre', '$rut', '$numeroEmpleado', '$servicio', '$duracionTurno', '$horaDesde',
                                                                '$descanso20', '$descanso30', '$descanso10', '$horaHastas', '$quienCrea', '$semanaAnio2', '$sabado','$campa','CHILE','Sabado','$anoDesS-$mesDesS-$diaDesS');";

                                                        $conexion->query($sqlSabado);
                                                    }
                                                    if ($domingo !== NULL) {
                                                        $diaDesD = date('d', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 8 . ' day'));
                                                        $mesDesD = date('m', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 8 . ' day'));
                                                        $anoDesD = date('Y', strtotime('01/01 +' . ($semanaAnio2 - 1) . ' weeks first day +' . 8 . ' day'));

                                                        $sqlDomingo = "INSERT INTO `{$wpdb->prefix}co_turnos`  (`idMeta`, `centro`, `apellido`, `nombre`,
                                                                `rut`, `numeroEmpleado`, `servicio`, `duracionTurno`, `horaDesde`, `descanso20`, `descanso30`, 
                                                                `descanso10`, `horaHastas`,  `quienCarga`, `semanaAnio` ,`codigo`  ,`campania`  ,`lugar`,`dia`,`fechaDia`) VALUES ('$idMeta', '$centro', '$apellido', 
                                                                    '$nombre', '$rut', '$numeroEmpleado', '$servicio', '$duracionTurno', '$horaDesde',
                                                                '$descanso20', '$descanso30', '$descanso10', '$horaHastas', '$quienCrea', '$semanaAnio2', '$domingo','$campa','CHILE','Domingo','$anoDesD-$mesDesD-$diaDesD');";

                                                        $conexion->query($sqlDomingo);
                                                    }
                                                }

                                                $suma = $suma + 1;
                                                if ($objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue() == NULL) {
                                                    $param = 1;
                                                }
                                                $i++;
                                                $contador = $contador + 1;
                                            }
                                            $totalIngresados = $contador - 1;
                                            ?>
                                            <script>
                                                Swal.fire({
                                                    title: 'Cargue exitoso',
                                                    icon: "success",
                                                    text: 'Registros cargados: <?php echo $suma - 1 ?> de <?php echo $totalIngresados ?>'
                                                });
                                            </script>
                                            <?php
                                        }
                                        unlink(RAI_RUTA_TURNOS . './archivos/bak_' . $archivo);
                                    }
                                    ?>
                                </div>               
                            </div>

                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    /*=======================Cargue Archivo masivo===============================*/
    document.getElementById('fake-file-button-browse').addEventListener('click', function () {
        document.getElementById('files-input-upload').click();
    });

    document.getElementById('files-input-upload').addEventListener('change', function () {
        document.getElementById('fake-file-input-name').value = this.value;
        document.getElementById('fake-file-button-upload').removeAttribute('disabled');
    });
    /*=======================Fin Cargue Archivo masivo===============================*/
</script>


