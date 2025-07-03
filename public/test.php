<?php
echo "PHP funciona correctamente!";
echo "<br>Versión de PHP: " . phpversion();
echo "<br>Directorio actual: " . __DIR__;
echo "<br>Variables de entorno:";
echo "<pre>";
print_r($_ENV);
echo "</pre>";
?>
