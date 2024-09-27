<?php
require '../../vendor/autoload.php'; // Include the Composer autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet
$spreadsheet = new Spreadsheet();

// Set active sheet
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet();

// Add data to the sheet
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Type');
$sheet->setCellValue('D1', 'Price');
$sheet->setCellValue('E1', 'Amount');
$sheet->setCellValue('F1', 'Image');
$sheet->setCellValue('G1', 'Location');
$sheet->setCellValue('H1', 'Note');

// Assuming $result is your data fetched from the database
$rowNumber = 2; // Start from the second row
while ($row = mysqli_fetch_array($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['pro_id']);
    $sheet->setCellValue('B' . $rowNumber, $row['pro_name']);
    $sheet->setCellValue('C' . $rowNumber, $row['type_name']);
    $sheet->setCellValue('D' . $rowNumber, $row['price']);
    $sheet->setCellValue('E' . $rowNumber, $row['amount']);
    $sheet->setCellValue('F' . $rowNumber, $row['image']);
    $sheet->setCellValue('G' . $rowNumber, $row['location']);
    $sheet->setCellValue('H' . $rowNumber, $row['Note']);
    $rowNumber++;
}

// Save the Excel file
$writer = new Xlsx($spreadsheet);
$writer->save('output.xlsx');
