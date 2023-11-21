  <?php
//fetch.php
include '../../php_code/connection.php';
if (isset($_POST["student_id"])) {
    $query = "SELECT * FROM userdata WHERE id = '" . $_POST["student_id"] . "'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}
?>
