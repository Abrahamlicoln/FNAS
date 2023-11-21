<?php
include '../../php_code/connection.php';
if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql = "SELECT id,fullname,photo,position,email,phone,courseofstudy,status,level FROM officials WHERE fullname LIKE '{$input}%'  or position LIKE '{$input}%'  or email LIKE '{$input}%' or phone LIKE '{$input}%'  or courseofstudy LIKE '{$input}%'";
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
                            <h6 class="mb-0 text-sm"><?php echo $row['fullname']; ?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['position']; ?>
</p>
                      </td>
                       <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['email']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['phone']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['courseofstudy']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['level']; ?>
</span>
                      </td>
                         <td class="align-middle text-center">
                        <?php
if ($row['status'] == "1") {

                echo '<span class="text-secondary text-xs font-weight-bold">ACTIVE';
            } else {
                echo '<span class="text-secondary text-xs font-weight-bold">INACTIVE';
            }
                echo '</span>';
                echo '</td>';
                ?>

                      <td class="align-middle text-center">
                        <form action="update3.php" class="d-inline" method="post">
                          <div class="btn-group" role="group">
                            <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="update3" class="btn btn-primary bg-gradient-info d-md-inline-flex">Update</button>
        </form>
                        </div>

                         <div class="btn-group" role="group">
                        <form action="delete2.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="delete2" class="btn btn-danger bg-gradient-danger">Delete</button>
        </div>
                        </form>
                       </div>
                         <div class="btn-group" role="group">
                        <form action="deactive.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="deactive" class="btn btn-success bg-gradient-success">DEACTIVATE</button>
        </div>
                        </form>
                       </div>
                         <div class="btn-group" role="group">
                        <form action="active.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="active" class="btn btn-primary bg-gradient-primary">ACTIVATE</button>
        </div>
                        </form>
                       </div>
                      </td>

                    </tr>



        <?php

            }
        }
    }

} elseif (empty($input)) {
    $sql = "SELECT * FROM officials";
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
                            <h6 class="mb-0 text-sm"><?php echo $row['fullname']; ?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['position']; ?>
</p>
                      </td>
                       <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['email']; ?>
</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['phone']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['courseofstudy']; ?>
</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['level']; ?>
</span>
                      </td>
                         <td class="align-middle text-center">
                        <?php
if ($row['status'] == "1") {

                echo '<span class="text-secondary text-xs font-weight-bold">ACTIVE';
            } else {
                echo '<span class="text-secondary text-xs font-weight-bold">INACTIVE';
            }
                echo '</span>';
                echo '</td>';
                ?>

                      <td class="align-middle text-center">
                        <form action="update3.php" class="d-inline" method="post">
                          <div class="btn-group" role="group">
                            <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="update3" class="btn btn-primary bg-gradient-info d-md-inline-flex">Update</button>
        </form>
                        </div>

                         <div class="btn-group" role="group">
                        <form action="delete2.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="delete2" class="btn btn-danger bg-gradient-danger">Delete</button>
        </div>
                        </form>
                       </div>
                         <div class="btn-group" role="group">
                        <form action="deactive.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="deactive" class="btn btn-success bg-gradient-success">DEACTIVATE</button>
        </div>
                        </form>
                       </div>
                        <div class="btn-group" role="group">
                        <form action="active.php" method="post">
                          <input type="hidden" class="mx-2"name="student_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="active" class="btn btn-primary bg-gradient-primary">ACTIVATE</button>
        </div>
                        </form>
                       </div>
                      </td>

                    </tr>



        <?php

            }
        }
    }
}
?>