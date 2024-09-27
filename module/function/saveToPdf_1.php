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
        $pdf->SetPageOrientation('L');

        // Add a page with correct width and height for landscape
        $pdf->AddPage('L', 'A4');
        

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Products Report');

        // Add a page
        

        // Set font
        $pdf->SetFont('freeserif', '', 12);

        // Start the table
        $pdf->writeHTML("<table border='1'>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>asset_number</th>
                                <th>  status</th>
                                <th>organization</th>
                                <th>location</th>
                                <th>Image</th>
                               
                            </tr>");

            foreach ($receivedArray as $row) {
               
            // Add a table row for each database row
            $pdf->writeHTML("<table border='1'>
                            <tr>
            
                                <td>{$row[0]}</td>
                                <td>{$row['Item']}</td>
                                <td>{$row['asset_number']}</td>
                                <td> {$row['status']}</td>
                                <td>{$row['agency']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['Note']}</td>
                                
                            </tr>");
        }
       
        // End the table
        $pdf->writeHTML('</table>', true, false, false, false, '');

        // Output the PDF to a file (you can use 'I' to output to the browser)
        $pdf->Output('products_report.pdf', 'I');
        
        
} 

if(!empty($data)){
    saveToPdf($data);
   
}else{
    echo 'No data';
}
?>
