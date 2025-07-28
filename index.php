<?php
include_once('tbs_class.php');       // TinyButStrong
include_once('tbs_plugin_opentbs.php'); // OpenTBS plugin

$TBS = new clsTinyButStrong(); 
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

//$archivo = 'recursos/ejemplo.docx';
$archivo = 'recursos/plantilla.docx';

$TBS->LoadTemplate($archivo, OPENTBS_ALREADY_UTF8);

$nombreArchivo="julio 2025";
$TBS->MergeField('FECHA', 'JULIO DE 2025');
$TBS->MergeField('NOMBRE', 'CRISTIAN ENRIQUEZ');
//print_r($TBS);

$TBS->Show(OPENTBS_DOWNLOAD, 'Informe técnico servicio MOVIL AVANZADO M2M_'.$nombreArchivo.'.docx');


?>