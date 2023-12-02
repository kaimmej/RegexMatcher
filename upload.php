<?php

include 'const.php';

$error = SUCCESS_CODE;
$result = array();
$response = array();

// HINT: https://www.php.net/manual/en/features.file-upload.post-method.php
// FILL IN YOUR CODE BELOW

// Check request method
if($_SERVER["REQUEST_METHOD"] !== 'POST') {
    $error |= 1; // Add 1 (001 in binary) to the status_code
}

if (isset($_FILES['name'])) {
    $uploadDirectory = "./uploads/";
    $uploadedFile = $_FILES['name'];
} else {
}
// $uploadDirectory = "./uploads/";
// $uploadedFile = $_FILES["regex_file"];

// if no file was provided, we update the status code by adding 2
// ERROR_ARG_FILE_NOT_PROVIDED (4): the request is invalid because the parameter filename is not provided
if (empty($uploadedFile) || $uploadedFile["error"] !== UPLOAD_ERR_OK) {
    $error |= 4; // Add 4 (100 in binary) to the status_code
} else {
    // process the uploaded file
    $fileName = $uploadedFile["name"];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileSize = $uploadedFile["size"];

    if( strtolower($fileExtension) !== "txt") {
        $error |= 4; // Add 4 (100 in binary) to the status_code

    } else {
        $uploadPath = $uploadDirectory . $fileName;
        if(move_uploaded_file($uploadedFile["tmp_name"], $uploadPath)) {

            // Open the file for reading.
            $file = fopen($uploadPath, 'r');

            // Read each line of the file.
            while (($line = fgets($file)) !== false) {
                // Trim the line to remove any trailing or leading whitespace.
                $trimmedLine = trim($line);

                // Add the line to the result array.
                $result[] = "<span>" . $trimmedLine . '</span>';

                    
            }
            // Close the file.
            fclose($file);

    } else {
            $error |= 2; // Add 2 (010 in binary) to the status_code  
        }
    }
}

// FILL IN YOUR CODE ABOVE

$response["status_code"] = $error;
$response["result_sets"] = $result;
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);