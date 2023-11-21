<?php
include '../../php_code/connection.php';
if (isset($_POST['template'])) {
    header('Content-Type:text/csv; charset=utf-8');
    header('Content-Disposition:attachment; filename=template.csv');
    $field = fopen("php://output", "w");
    fputcsv($field, array('JAMB REG.NO/MATRIC NO', 'FULLNAME', 'DEPARTMENT', 'COURSE OF STUDY', 'MODE OF ENTRY'));
    fclose($field);

}
