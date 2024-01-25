<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) {
    $targetFile = "uploads/" . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);

    $spreadsheet = IOFactory::load($targetFile);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = [];

    foreach ($worksheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        $cells = [];
        foreach ($cellIterator as $cell) {
            $cells[] = $cell->getValue();
        }
        $rows[] = $cells;
    }

    // Aquí puedes enviar cada fila al servicio SOAP.
    foreach ($rows as $rowData) {
        // Aquí envías $rowData a tu función de SOAP y procesas la respuesta.
    }
}
?>
