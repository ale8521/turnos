<?php

$year = date("Y");
$month = date("m");
$day = date("d");

# Obtenemos el numero de la semana
$semanaO = date("W", mktime(0, 0, 0, $month, $day, $year));
$semana = ($semanaO -1) + 1;
$fechas = "";
$fechasAtras = "";
$mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

for ($sema = $semana; $sema < ($semana + 13); $sema++) {
    for ($i = 0; $i < 8; $i++) {
        if ($i == 0) {      # Primer dia
            $diaDes = date('d', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 2 . ' day'));
            $mesDes = date('m', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 2 . ' day'));
            $anoDes = date('Y', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 2 . ' day'));
        }
        if ($i == 7) {      # Ultimo dia
            $diaFin = date('d', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 8 . ' day'));
            $mesFin = date('m', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 8 . ' day'));
            $anoFin = date('Y', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 8 . ' day'));

            $fechas .= " <option value='" . $sema . "'> Semana del " . $diaDes . " de " . $mes[$mesDes - 1] . " de " . $anoDes . " al " . $diaFin . " de " . $mes[$mesFin - 1] . " de " . $anoFin . " </option>";
        }
    }
}


for ($sema = $semana - 5 ; $sema < $semana; $sema++) {
    for ($i = 0; $i < 8; $i++) {
        if ($i == 0) {      # Primer dia
            $diaDes = date('d', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 2 . ' day'));
            $mesDes = date('m', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 2 . ' day'));
            $anoDes = date('Y', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 2 . ' day'));
        }
        if ($i == 7) {      # Ultimo dia
            $diaFin = date('d', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 8 . ' day'));
            $mesFin = date('m', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 8 . ' day'));
            $anoFin = date('Y', strtotime('01/01 +' . ($sema - 1) . ' weeks first day +' . 8 . ' day'));

            $fechasAtras .= " <option value='" . $sema . "'> Semana del " . $diaDes . " de " . $mes[$mesDes - 1] . " de " . $anoDes . " al " . $diaFin . " de " . $mes[$mesFin - 1] . " de " . $anoFin . " </option>";
        }
    }
}