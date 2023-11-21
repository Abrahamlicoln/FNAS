<?php
require_once 'vendor/autoload.php';
require_once 'src/PhpSpreadsheet/IOFactory.php';
require_once 'src/PhpSpreadsheet/Spreadsheet.php';
require_once 'src/PhpSpreadsheet/Worksheet/Worksheet.php';
require_once 'src/PhpSpreadsheet/Cell/DataType.php';
require_once 'src/PhpSpreadsheet/Cell/Cell.php';

// include mysql database configuration file
include_once '../../php_code/connection.php';

if (isset($_POST['bulk'])) {

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['upload']['name'])) {

        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['upload']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);

        // Parse data from CSV file line by line
        // Parse data from CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Get row data
            $jamb_reg = $getData[0];
            $name = $getData[1];
            $department = $getData[2];
            $course = $getData[3];
            $mode = $getData[4];

            // If user already exists in the database with the same email
            $query = "SELECT id FROM userdata WHERE jamb_reg = '" . $getData[0] . "'";

            $check = mysqli_query($connection, $query);

            if ($check->num_rows > 0) {
            } else {
                mysqli_query($connection, "INSERT INTO userdata (jamb_reg, name, department, course, mode_of_entry) VALUES ('" . $jamb_reg . "', '" . $name . "', '" . $department . "', '" . $course . "', '" . $mode . "')");
            }
        }

        // Close opened CSV file
        fclose($csvFile);
        echo "
        <script>
        alert('Student Record Uploaded Succesfully!!');
        window.location.href = 'dashboard.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Please Select a Valid CSV File');
        window.location.href = 'dashboard.php';
        </script>
        ";
    }
}
