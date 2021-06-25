<?php

/* ////////////////////////////Tabla Turnos//////////////////////////////////////// */

$sqlTurnos = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}co_turnos (
  `id_turnos` INT NOT NULL AUTO_INCREMENT,
  `idMeta` VARCHAR(100) NULL,
  `centro` VARCHAR(100) NULL,
  `apellido` VARCHAR(100) NULL,
  `nombre` VARCHAR(100) NULL,
  `rut` VARCHAR(100) NULL,
  `numeroEmpleado` VARCHAR(100) NULL,
  `servicio` VARCHAR(100) NULL,
  `duracionTurno` VARCHAR(100) NULL,
  `horaDesde` VARCHAR(100) NULL,
  `descanso20` VARCHAR(100) NULL,
  `descanso30` VARCHAR(100) NULL,
  `descanso10` VARCHAR(100) NULL,
  `horaHastas` VARCHAR(100) NULL, 
  `pausa1` VARCHAR(100) NULL,
  `pausa2` VARCHAR(100) NULL,
  `pausa3` VARCHAR(100) NULL,
  `pausa4` VARCHAR(100) NULL,
  `pausa5` VARCHAR(100) NULL,
  `pausa6` VARCHAR(100) NULL,
  `pausa7` VARCHAR(100) NULL,
  `pausa8` VARCHAR(100) NULL,
  `semanal` VARCHAR(100) NULL,
  `obra` VARCHAR(100) NULL,
  `fechaCreacion` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `quienCarga` VARCHAR(100) NULL,
  `semanaAnio` VARCHAR(100) NULL,
  `codigo` VARCHAR(100) NULL,
  `campania` VARCHAR(100) NULL,
  `lugar` VARCHAR(100) NULL,
  `dia` VARCHAR(100) NULL,
  `fechaDia` DATE NULL,
  `categoria` VARCHAR(100) NULL,
PRIMARY KEY (`id_turnos`));";

$wpdb->query($sqlTurnos);


