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
                        <h5 class="card-title titulo">Turnos Madrid</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="basicInput">Semana</label>
                                            <fieldset class="form-group">
                                                <select class="form-select"  name="semanaAnio" id="semanaAnio">
                                                    <option value="">Seleccionar</option>
                                                    <?php echo $fechasAtras ?>
                                                    <?php echo $fechas ?>
                                                </select>
                                            </fieldset>  
                                            <div id="reSemanaAnio" class="mensaje"></div>
                                        </div>  
                                    </div>

                                    <div class="col-md-6 col-12 bajarBotones" >
                                        <button type="button"  onclick="buscarMandoEp()" class="btn btn-primary me-1 mb-1">Buscar</button>
                                        <button type="button" onclick="LimpiarEspaMan()" class="btn btn-primary me-1 mb-1">Limpiar</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div id="tablaMandoEp">
                            </div> 
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
