<?php
$bd_oracle = "emapap";
$servidor_oracle = "192.168.1.3";
$puerto_oracle = "1521";
$usuario_oracle = "abilling";
$clave_oracle = "ivangv";

// Crear la conexión
$conn = oci_connect($usuario_oracle, $clave_oracle, "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=$servidor_oracle)(PORT=$puerto_oracle)))(CONNECT_DATA=(SERVICE_NAME=$bd_oracle)))");

if (!$conn) {
    $m = oci_error();
    echo "No se pudo realizar la conexión a la base de datos: " . $m['message'] . "\n";
    exit;
} else {
    echo "Conexión exitosa a la base de datos Oracle.\n";
}

// Realizar operaciones en la base de datos...

// Cerrar la conexión
oci_close($conn);
?>
