<?php
$archivo = 'recursos/ejemplo.docx';

if (file_exists($archivo)) {
    echo "El documento existe.";
} else {
    echo "El documento no existe.";
}


?>