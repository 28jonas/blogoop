<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");
$the_message="";
if(isset($_SESSION['the_message'])){
    $the_message=$_SESSION['the_message'];
    unset($_SESSION['the_message']);
}
/*add users*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if($_POST['action'] === 'add'){
        $user = new User();
        $user -> username = $_POST['username'];
        $user -> first_name = $_POST['first_name'];
        $user -> last_name = $_POST['last_name'];
        $user -> password = $_POST['password'];

        $user -> create();

        // Voeg de nieuwe gebruiker toe aan de database
        // Je query hier
        $success = true; // Pas aan afhankelijk van je databaseactie
        exit();
	} elseif ($_POST['action'] === 'update'){
        $user = USER::find_user_by_id($_GET['id']);
        if($user){
            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->update();
        }
	}

}

if (isset($_POST['submit'])) {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update de gebruiker in de database
    // Je query hier
    $success = true; // Pas aan afhankelijk van je databaseactie
}

if(isset($_GET['delete'])){
	$user_id = $_GET['delete'];
	$user = User::find_user_by_id($user_id);
	if($user){
		$user->delete();
		header('Location: usersmodals.php');
		exit;
	}else{
		echo "User not found";
	}
}

?>

	<script>
		console.log("action", document.getElementById("action"))
        document.addEventListener("DOMContentLoaded", function () {
            const userModal = new bootstrap.Modal(document.getElementById("userModal"));
            const userForm = document.getElementById("userForm");
            const modalTitle = document.getElementById("userModalLabel");
            const modalSubmitButton = document.getElementById("modalSubmitButton");

            // Dynamische modal openen
            function openModal(isEdit, userData = null) {
                if (isEdit) {
                    modalTitle.textContent = "Update User";
                    modalSubmitButton.textContent = "Update";
                    document.getElementById("userId").value = userData.id;
                    document.getElementById("username").value = userData.username;
                    document.getElementById("first_name").value = userData.first_name;
                    document.getElementById("last_name").value = userData.last_name;
                    document.getElementById("password").value = userData.password;
                } else {
                    modalTitle.textContent = "Add User";
                    modalSubmitButton.textContent = "Add";
                    userForm.reset();
                    document.getElementById("userId").value = "";
                }
                userModal.show();
            }

            // Voorbeeld: Handlers voor knoppen
            document.querySelectorAll(".edit-user-btn").forEach((button) => {
                button.addEventListener("click", function () {
                    const userData = {
                        id: this.dataset.id,
                        username: this.dataset.username,
                        first_name: this.dataset.first_name,
                        last_name: this.dataset.last_name,
                        password: this.dataset.password,
                    };
                    openModal(true, userData);
                });
            });

            document.querySelector(".add-user-btn").addEventListener("click", function () {
                openModal(false);
            });

            // Formulier verzenden
            userForm.addEventListener("submit", function (event) {
                event.preventDefault();
                const formData = new FormData(userForm);
                const isEdit = document.getElementById("userId").value !== "";
                const action = isEdit ? "update" : "add";
                formData.append("action", action)

                /*const url = isEdit ? "update_user.php" : "add_user.php";*/
                fetch("usersmodals.php", {
                    method: "POST",
                    body: formData,
                })
                    .then(() => {
                            location.reload();
                    })
                    .catch((error) => {
                        console.error("Error:", error); // Hier komt de fout terecht
                    });
            });
        });

	</script>
	<section class="section">
		<div class="card">
			<div class="card-header d-flex">
				<h5 class="card-title">
					Users
				</h5>
				<!--<a type="button" class="ms-4 " data-bs-toggle="modal" data-bs-target="#exampleModal">
					<i class="bi bi-person-add text-success"></i>
				</a>-->
				<a type="button" class="ms-4 add-user-btn" >
					<i class="bi bi-person-add text-success"></i>
				</a>
			</div>
			<?php if(!empty($the_message)): ?>
			<div class="alert alert-success">
				<i class="bi bi-check-circle"></i>
                <?php echo $the_message ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
			</div>
			<?php endif; ?>
			<div class="card-body">
				<table class="table table-striped" id="table1">
					<thead>
					<tr>
						<th>Klantnr</th>
						<th>username</th>
						<th>paswoord</th>
						<th>Voornaam</th>
						<th>Familienaam</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
                    <?php $users = User::find_all_users(); ?>
                    <?php foreach($users as $user):?>
						<tr>
							<td><?= $user->id; ?></td>
							<td><!--<span><img height="40" width="40" class="avatar me-3" src="../admin/assets/static/images/faces/8.jpg" alt=""></span>--><?= $user->username; ?></td>
							<td><?= $user->password;?></td>
							<td><?= $user->first_name;?></td>
							<td><?= $user->last_name; ?></td>
							<td class="d-flex justify-content-around">
								<a href="usersmodals.php?delete=<?php echo $user->id ?>"> <!--onclick="return confirm("Weet je zeker dat je deze gebruiker wil wissen?")">-->
									<i class="bi bi-trash text-danger"></i>
								</a>
								<a type="button" class="edit-user-btn">
									<i class="bi bi-eye text-success"></i>
								</a>
							</td>
						</tr>
                    <?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="userModalLabel"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="userForm" method="post">
					<div class="modal-body">
						<input type="hidden" id="userId" name="userId">
						<div class="mb-3">
							<input type="hidden" id="userId" name="userId">
							<input type="hidden" id="action" name="action">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" required>
						</div>
						<div class="mb-3">
							<label for="first_name" class="form-label">First name</label>
							<input type="text" class="form-control" id="first_name" name="first_name" required>
						</div>
						<div class="mb-3">
							<label for="last_name" class="form-label">Last name</label>
							<input type="text" class="form-control" id="last_name" name="last_name" required>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<!-- Voeg meer velden toe indien nodig -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button data-bs-dismiss="modal" type="submit" value="submit" id="modalSubmitButton" class="btn btn-primary"></button>
					</div>
				</form>
			</div>
		</div>
	</div>


<?php
require_once("includes/widget.php");
require_once("includes/footer.php");
?>