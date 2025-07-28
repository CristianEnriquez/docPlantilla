<?php
include_once('tbs_class.php');         // TinyButStrong
include_once('tbs_plugin_opentbs.php'); // OpenTBS plugin

$meses = [
      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

/*
 Convertir a mayúsculas
$mayusculas = strtoupper($texto);
 Convertir a minúsculas
$minusculas = strtolower($texto); 
 Primera letra en mayúscula
$primeraMayuscula = ucfirst($texto); 
 Primera letra de cada palabra en mayúscula
$palabrasMayusculas = ucwords($texto); 
*/

$plantilla = 'recursos/plantilla.docx'; 

// Crear carpeta temporal
$tmp_dir = __DIR__ . '/tmp_docs';
if (!file_exists($tmp_dir)) {
    mkdir($tmp_dir, 0777, true);
}

$archivos_generados = [];

foreach ($meses as $mes) {
    $TBS = new clsTinyButStrong;
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
    $TBS->LoadTemplate($plantilla, OPENTBS_ALREADY_UTF8);
    $numAn = "2025";
    $TBS->MergeField('MESMAYUS', (string)strtoupper($mes));
    $TBS->MergeField('MESMINUS', (string) strtolower($mes));
    $TBS->MergeField('AÑO', $numAn);
    $TBS->MergeField('NOMBRE', "Cristian Enriquez");

    $nombre_docx = "Informe".(string) strtolower($mes)." ".$numAn.".docx";
    $ruta_completa = "$tmp_dir/$nombre_docx";
    $TBS->Show(OPENTBS_FILE, $ruta_completa);
    $archivos_generados[] = $ruta_completa;
}

// Crear el ZIP
$zip_file = 'documentos_plantilla.zip';
$zip_path = __DIR__ . '/' . $zip_file;
$zip = new ZipArchive();
if ($zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    foreach ($archivos_generados as $archivo) {
        $zip->addFile($archivo, basename($archivo));
    }
    $zip->close();
}

// Eliminar archivos temporales DOCX
foreach ($archivos_generados as $archivo) {
    unlink($archivo);
}
rmdir($tmp_dir);

// Descargar el ZIP
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . $zip_file);
header('Content-Length: ' . filesize($zip_path));
readfile($zip_path);

// Eliminar el zip después de la descarga
unlink($zip_path);
exit;
?>