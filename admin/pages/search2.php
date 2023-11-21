<?php
include '../../php_code/connection.php';
if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql = "SELECT name,id,jamb_reg,department,course,mode_of_entry FROM userdata WHERE name LIKE '{$input}%' and status='0' or jamb_reg LIKE '{$input}%' and status='0' or department LIKE '{$input}%' and status='0' or course LIKE '{$input}%' and status='0' or mode_of_entry LIKE '{$input}%' and status='0'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        $numRow = mysqli_num_rows($query);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_assoc($query)) {?>
        <tr>

                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['name']; ?>
</p>

                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['jamb_reg']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['department']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['course']; ?>
</span>
                      </td>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['mode_of_entry']; ?>
</span>
                      </td>

                    </tr>



        <?php

            }
        }
    }

} elseif (empty($input)) {
    $sql = "SELECT name,id,jamb_reg,department,course,mode_of_entry FROM userdata where status='0'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        $numRow = mysqli_num_rows($query);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_assoc($query)) {?>
        <tr>

                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['name']; ?>
</p>

                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['jamb_reg']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['department']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['course']; ?>
</span>
                      </td>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['mode_of_entry']; ?>
</span>
                      </td>

                    </tr>



        <?php

            }
        }
    }
}
?>