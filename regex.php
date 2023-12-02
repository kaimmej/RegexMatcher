<?php

include 'const.php';

$error = SUCCESS_CODE;
$pattern = "";
$result = array();
$response = array();

// FILL IN YOUR CODE BELOW


// Check request method
if($_SERVER["REQUEST_METHOD"] !== 'GET') {
    $error |= 1; // Add 1 (001 in binary) to the status_code
}
$regexText = $_GET['pattern'];
$fileName = $_GET['filename'];
// Is the parameter provided? 
if (empty($regexText)) {
    $error |= 2; // Add 4 (100 in binary) to the status_code
} 
if (empty($fileName)) {
    $error |= 4; // Add 4 (100 in binary) to the status_code
} 
else {
    // we know there is a fileName to parse... 

    // we need to check whether the file exists.
    $uploadDirectory = "./uploads/";
    $filepath = $uploadDirectory . $fileName;
    if (file_exists($filepath)) {

            // we now want to read each line of the file
            // Open the file for reading.
            $file = fopen($filepath, 'r');

            // Read each line of the file.
            while (($line = fgets($file)) !== false) {
                // Trim the line to remove any trailing or leading whitespace.
                $trimmedLine = trim($line);

                // Add the line to the result array.
                if (preg_match("/$regexText/", $trimmedLine)) { // if its a successful match, we want the color to be salmon

                    // if there is a match, we split the string into the match and the resulting text... 
                    $replacement =  "<span style='background-color: orange'>" . $regexText . '</span>';
                    $matchedLine = preg_replace("/$regexText/",$replacement, $trimmedLine);

                    // add the color to the specific location of hte match(s)
                    $result[] = "<span style='background-color: turquoise'>" . $matchedLine . '</span>';
                } else {
                    $result[] = "<span style='background-color: salmon'>" . $trimmedLine  . '</span>';
                }   
            }
            // Close the file.
            fclose($file);

    } else {
        $error |= 8; // Add 8 (1000 in binary) to the status_code
    }
}

// FILL IN YOUR CODE ABOVE


$response["status_code"] = $error;
$response["pattern"] = $pattern;
$response["result_sets"] = $result;
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);

?>



