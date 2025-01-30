<?php
// Include TCPDF and FPDI libraries
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');  // Adjust the path according to your folder structure
require_once('vendor/setasign/fpdi/src/autoload.php'); // Path to the FPDI library

use setasign\Fpdi\TcpdfFpdi;

// Capture form data
$name = isset($_POST['name']) ? mb_convert_encoding($_POST['name'], 'UTF-8', 'auto') : '';
$start_date = isset($_POST['start_date']) ? str_replace('-', '/', $_POST['start_date']) : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$idnumber = isset($_POST['idnumber']) ? $_POST['idnumber'] : '';

// Handle uploaded file
$fileUploadMessage = "No file uploaded.";
$imagePath = ''; // Initialize image path

if (isset($_FILES['id_picture']) && $_FILES['id_picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['id_picture']['tmp_name'];
    $fileName = $_FILES['id_picture']['name'];
    $uploadFileDir = './uploads/';
    $dest_path = $uploadFileDir . $fileName;

    if (!is_dir($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true); // Create directory if it doesn't exist
    }

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $fileUploadMessage = "File uploaded successfully!";
        $imagePath = $dest_path; // Store the path of the uploaded image
    } else {
        $fileUploadMessage = "There was an error uploading the file.";
    }
}

// Create a new FPDI object
$pdf = new TcpdfFpdi();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'generate') {
        
        // Set PDF properties
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Website');
        $pdf->SetTitle('Generated FIRST INVESTMENT FUND CONTRACT');
        $pdf->SetSubject('FIRST INVESTMENT FUND CONTRACT File Details');
        
        // Load the existing PDF
        $existingPdfPath = 'C:\xampp\htdocs\document_sharing\uploads\FIRST INVESTMENT FUND CONTRACT.pdf'; // Path to your existing PDF
        $pageCount = $pdf->setSourceFile($existingPdfPath);

        // Loop through all pages of the original PDF
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // Import the current page
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx);

            // Add data to the first page
            if ($pageNo === 1) {
                $pdf->SetFont('aealarabiya', '', 16); // Use a font that supports Arabic

                $pdf->SetXY(92, 88); // Set starting point
                $pdf->Cell(70, 10, "$name ($idnumber)", 0, 1, 'R'); // Text is right-aligned within a 70-unit wide cell

                $pdf->SetXY(5, 88);
                $pdf->Cell(50, 10, $start_date, 0, 1, 'R'); // Text is right-aligned within a 70-unit wide cell

                $pdf->SetXY(0, 165);
                $pdf->Cell(40, 10, "$ $price ", 0, 1, 'R');
            }

            // Add the image to the second page
            if ($pageNo === 2 && !empty($imagePath) && file_exists($imagePath)) {
                $pdf->SetFont('aealarabiya', '', 16); // Use a font that supports Arabic

                $pdf->SetXY(10, 220);
                $pdf->Image($imagePath, 5, 232, 120, 44, '', '', '', true);

                $pdf->SetXY(0, 200); // Set starting point
                $pdf->Cell(60, 10, $name, 0, 1, 'R'); // Text is right-aligned within a 60-unit wide cell

                $pdf->SetXY(90, 210);
                $pdf->Cell(60, 10, $start_date, 0, 1);
            }
        }

        $uploadDir = realpath('./uploads'); // Get the absolute path of the uploads directory
        if (!$uploadDir) {
            mkdir('./uploads', 0777, true); // Create the uploads directory if it doesn't exist
            $uploadDir = realpath('./uploads'); // Get the absolute path again
        }

        $savePath = $uploadDir . DIRECTORY_SEPARATOR . 'FIRST_INVESTMENT_FUND_CONTRACT_' . $idnumber . '.pdf';

        $pdf->Output($savePath, 'F'); // Save the file locally

        if ($action === 'download') {
            if (file_exists($savePath)) {
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . basename($savePath) . '"');
                readfile($savePath);
                exit;
            } else {
                echo "Error: File could not be found.";
            }
        }
        // Close and output the final PDF
        $pdf->Output('FIRST_INVESTMENT_FUND_CONTRACT_' . $idnumber . '.pdf', 'D');

    } elseif ($action === 'download') {

        // Set PDF properties
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Website');
        $pdf->SetTitle('Generated MODARABA CONTRACT');
        $pdf->SetSubject('MODARABA CONTRACT File Details');
        // Load the existing PDF
        $existingPdfPath = 'C:\xampp\htdocs\document_sharing\uploads\MODARABA CONTRACT.pdf';  // Path to your existing PDF
        $pageCount = $pdf->setSourceFile($existingPdfPath);

        // Loop through all pages of the original PDF
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // Import the current page
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx);

            // Add data to the first page
            if ($pageNo === 1) {
                $pdf->SetFont('aealarabiya', '', 16); // Use a font that supports Arabic

                $pdf->SetXY(92, 91); // Set starting point
                $pdf->Cell(70, 10,"$name ($idnumber)", 0, 1, 'R'); // Text is right-aligned within a 60-unit wide cell

                $pdf->SetXY(5, 91);
                $pdf->Cell(50, 10, $start_date, 0, 1, 'R'); // Text is right-aligned within a 70-unit wide cell

                $pdf->SetXY(0,165);
                $pdf->Cell(40, 10, "$ $price ", 0, 1, 'R');
                
            }

            // Add the image to the second page
            if ($pageNo === 2 && !empty($imagePath) && file_exists($imagePath)) {
                $pdf->SetFont('aealarabiya', '', 16); // Use a font that supports Arabic

                $pdf->SetXY(10, 220);
                $pdf->Image($imagePath, 5, 232, 120, 44, '', '', '', true);

                $pdf->SetXY(0, 197); // Set starting point
                $pdf->Cell(60, 10, $name, 0, 1, 'R'); // Text is right-aligned within a 60-unit wide cell

                $pdf->SetXY(90, 210);
                $pdf->Cell(60, 10, $start_date, 0, 1);
            }
        }

        $uploadDir = realpath('./uploads'); // Get the absolute path of the uploads directory
        if (!$uploadDir) {
            mkdir('./uploads', 0777, true); // Create the uploads directory if it doesn't exist
            $uploadDir = realpath('./uploads'); // Get the absolute path again
        }

        $savePath = $uploadDir . DIRECTORY_SEPARATOR . 'MODARABA_CONTRACT_' . $idnumber . '.pdf';

        $pdf->Output($savePath, 'F'); // Save the file locally

        if ($action === 'download') {
            if (file_exists($savePath)) {
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . basename($savePath) . '"');
                readfile($savePath);
                exit;
            } else {
                echo "Error: File could not be found.";
            }
        }

        // Close and output the final PDF
        $pdf->Output('MODARABA_CONTRACT_' . $idnumber . '.pdf', 'D');
    } else {
        echo "Invalid action.";
    }
}

?>
