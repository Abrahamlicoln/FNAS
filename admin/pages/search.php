<?php
include '../../php_code/connection.php';
if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql = "SELECT name,id,jamb_reg,email_address,photo,gender,department,course,date_of_birth,current_level FROM userdata WHERE name LIKE '{$input}%' and status='1' or jamb_reg LIKE '{$input}%' and status='1' or department LIKE '{$input}%' and status='1' or course LIKE '{$input}%' and status='1' or email_address LIKE '{$input}%' and status='1'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        $numRow = mysqli_num_rows($query);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_assoc($query)) {?>
        <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../../upload/<?php echo $row['photo']; ?>" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['name']; ?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $row['email_address']; ?>
</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['jamb_reg']; ?>
</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['department']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['course']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['date_of_birth']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['gender']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['current_level']; ?>
</span>
                      </td>

                      <td class="align-middle text-center">

                        <form action="update.php" class="d-inline" method="post">
                          <div class="btn-group" role="group">
                            <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="update" class="btn btn-primary bg-gradient-info d-md-inline-flex">Update</button>
        </form>
                        </div>

                         <div class="btn-group" role="group">
                        <form action="delete.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="delete" class="btn btn-danger bg-gradient-danger">Delete</button>
        </div>
                        </form>
                       </div>
                      </td>

                    </tr
        <?php

            }
        }
    }
    ?>
<?php
echo '</tr>';

    echo '</tbody>';
} elseif (empty($input)) {
    $sql = "SELECT name,id,jamb_reg,email_address,photo,gender,department,course,date_of_birth,current_level FROM userdata where status='1'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        $numRow = mysqli_num_rows($query);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../../upload/<?php echo $row['photo']; ?>" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['name']; ?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $row['email_address']; ?>
</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['jamb_reg']; ?>
</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['department']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['course']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['date_of_birth']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['gender']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['current_level']; ?>
</span>
                      </td>

                      <td class="align-middle text-center">

                        <form action="update.php" class="d-inline" method="post">
                          <div class="btn-group" role="group">
                            <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="update" class="btn btn-primary bg-gradient-info d-md-inline-flex">Update</button>
        </form>
                        </div>

                         <div class="btn-group" role="group">
                        <form action="delete.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="delete" class="btn btn-danger bg-gradient-danger">Delete</button>
        </div>
                        </form>
                       </div>
                      </td>

                    </tr>



        <?php

            }
        }
    }
    ?>
<?php

    echo '</tr>';

    echo '</tbody>';
} else {
    echo "No Record Found";
}
?>