<?php
include_once('tbs_class.php');       // TinyButStrong
include_once('tbs_plugin_opentbs.php'); // OpenTBS plugin

$TBS = new clsTinyButStrong(); 
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

$archivo = 'recursos/ejemplo.docx';

$TBS->LoadTemplate($archivo, OPENTBS_ALREADY_UTF8);

$TBS->MergeField('A1', 'Hola Mundo');
//print_r($TBS);

$TBS->Show(OPENTBS_DOWNLOAD, 'salida.docx');


?>