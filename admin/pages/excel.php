<?php
include '../../php_code/connection.php';
$output = "";
if (isset($_POST['toexcel'])) {
    $excel = $_POST['toexcel'];
    $sql = "SELECT name,jamb_reg,department,course,date_of_birth,gender,current_level FROM userdata WHERE status='1'";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0) {
        $output .= '<h1 style="text-align:center;">LIST OF REGISTERED STUDENT</h1>';
        $output .= '
    <table class="table">
    <tr>
    <th>FULLNAME</th>
    <th>MATRIC. NO/JAMB REG.NO</th>
    <th>DEPARTMENT</th>
    <th>COURSE OF STUDY</th>
    <th>DATE OF BIRTH</th>
    <th>GENDER</th>
    <th>CURRENT LEVEL</th>
    </tr>
    <style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
    </style>
    ';
        while ($row = mysqli_fetch_array($query)) {
            $output .= '
           <tr>
                         <td>' . $row["name"] . '</td>
                         <td>' . $row["jamb_reg"] . '</td>
                         <td>' . $row["department"] . '</td>
       <td>' . $row["course"] . '</td>
       <td>' . $row["date_of_birth"] . '</td>
       <td>' . $row["gender"] . '</td>
       <td>' . $row["current_level"] . '</td>
                    </tr>
        ';
        }
        $output .= '</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition: attachment; filename=fnas.xls');
        echo $output;
    }
}
