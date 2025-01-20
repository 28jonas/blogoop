<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");
?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Users
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                    <tr>
                        <?php
                        //dynamisch kolommen ophalen uit database
                        /*$user = new User();
                        $result = $user->find_all_users(); deze 2 lijnen vervangen dan lijn hieronder*/
                        $result = User::find_all_users();

                        $fields = mysqli_fetch_fields($result);
                        foreach($fields as $field){
                            echo "<th>" . htmlspecialchars($field->name, ENT_QUOTES, 'UTF-8') . "</th>";
                        }

                        ?>
                        <!--	                <th>Klantnr</th>-->
                        <!--	                <th>username</th>-->
                        <!--	                <th>paswoord</th>-->
                        <!--	                <th>Voornaam</th>-->
                        <!--	                <th>Familienaam</th>-->
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(mysqli_num_rows($result)>0):?>
                        <?php while($row = mysqli_fetch_array($result)):?>
                            <tr>
                                <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row['password'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8') ?></td
                            </tr>
                        <?php endwhile;?>
                    <?php else: ?>

                    <?php endif; ?>

                    </tbody>
                </table>
	            <?php echo "ophalen van 1 user";
	            $result = User::find_user_by_id(1);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
						echo "<br> id:". $row['id']." ".$row['username']." ".$row['password']." ".$row['first_name']." ".$row['last_name'];
					}
				} else{
					echo "0 results";
				}
	            ?>
	            <?php
	                echo "<br> object oriented van 1 user";
					$result = User::find_user_by_id(1);
					$user = new User();
					$row = mysqli_fetch_assoc($result);
					$user->id = $row['id'];
					$user->username = $row['username'];
					$user->password = $row['password'];
					$user->first_name = $row['first_name'];
					$user->last_name = $row['last_name'];
					echo "<br>" .$user->id . " " . $user->username . " " . $user->password . " " . $user->first_name . " " . $user->last_name;

	            ?>
            </div>
        </div>

    </section>
<?php
require_once("includes/widget.php");
require_once("includes/footer.php");
?>