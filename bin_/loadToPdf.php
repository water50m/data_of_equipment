<?php
// Include the TCPDF library
require_once('vendor/autoload.php');

// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('HTML Table to PDF');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('times', '', 12);

// HTML table content (replace this with your actual HTML table)
$htmlTable = '<table border="1">
                 <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                 </tr>
                 <tr>
                     <td>1</td>
                     <td>John Doe</td>
                     <td>john@example.com</td>
                 </tr>
                 <tr>
                     <td>2</td>
                     <td>Jane Doe</td>
                     <td>jane@example.com</td>
                 </tr>
             </table>';

// Output the HTML table to PDF
$pdf->writeHTML($htmlTable, true, false, true, false, '');

// Output the PDF to a file (you can use 'I' to output to the browser)
$pdf->Output('table_to_pdf.pdf', 'D');
