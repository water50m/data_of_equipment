<?php
require_once('../../vendor/autoload.php'); // Include the TCPDF library

$data = $_GET['data'];


session_start();


function saveToPdf($data) {
    $decodedData = urldecode($data);

// Unserialize the data back into an array
    $receivedArray = unserialize($decodedData);
    
// Assuming $result contains the database query result


        // Create a new TCPDF instance
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Products Report');

        // Add a page
        $pdf->AddPage();
        

        // Set font
        $pdf->SetFont('freeserif', '', 12);

        // Start the table
        $pdf->writeHTML('<table border="1">
                            
                            <tr>
                            <th class="text-center">Number</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">asset_number</th>
                            <th class="text-center">status</th>
                            <th class="text-center">organization</th>
                            <th class="text-center">location</th>
                            <th class="text-center">Image</th>
                               
                            </tr>');

                            foreach ($receivedArray as $rows) {
                                foreach ($rows as $row){
            // Add a table row for each database row
            $pdf->writeHTML("<table border='1'>
                            <tr>
                            <td class='text-center'>
                                    <td >
                            <td >
                                {$row['Item']}
                            </td>
                            <td class='text-center'>
                                {$row['asset_number']}
                            </td>
                            <td>
                                {$row['status']}
                            </td>
                            <td class='text-center'>
                                {$row['agency']}
                            </td>
                            <td class='text-center'>
                                {$row['location']}
                            </td>
                            <td class='text-center'>
                            
                             </td>
  
                            </tr>");
        }
    }
        // End the table
        $pdf->writeHTML('</table>', true, false, false, false, '');

        // Output the PDF to a file (you can use 'I' to output to the browser)
        $pdf->Output('products_report.pdf', 'I');
    
} 


?>
