<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");

if(isset($_GET['delete'])){
	$user_id = $_GET['delete'];
	$user = User::find_by_id($user_id);
	if($user){
		$user->soft_delete();
		header("Location: users.php").
		exit;
	}else{
		echo "User not found";
	}
}

?>
	<section class="section">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">
					Users
				</h5>
			</div>
			<div class="card-body">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="active-tab" data-bs-toggle="tab"
						        data-bs-target="#active-tab-pane" type="button" role="tab" aria-controls="active-tab-pane"
						        aria-selected="true">Active Users
						</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive-tab-pane"
						        type="button" role="tab" aria-controls="inactive-tab-pane" aria-selected="false">Inactive
							Users
						</button>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="active-tab-pane" role="tabpanel"
					     aria-labelledby="active-tab">
						<table class="table table-striped" id="table1">
							<thead>
							<tr>
								<th>Klantnr</th>
								<th>username</th>
								<th>paswoord</th>
								<th>Voornaam</th>
								<th>Familienaam</th>
								<th>Created_at</th>
								<th>Deleted at</th>
								<th>Actions</th>
							</tr>
							</thead>
							<tbody>
                            <?php $active_users = User::find_all(); ?>
                            <?php foreach ($active_users as $user): ?>
                                <?php if($user->deleted_at == '0000-00-00 00:00:00'): ?>							<tr>
									<td><?= $user->id; ?></td>
									<td><span><img height="40" width="40" class="avatar me-3"
									               src="../admin/assets/static/images/faces/8.jpg"
									               alt=""></span><?= $user->username; ?></td>
									<td><?= $user->password; ?></td>
									<td><?= $user->first_name; ?></td>
									<td><?= $user->last_name; ?></td>
									<td><?= $user->created_at; ?></td>
									<td><?= $user->deleted_at; ?></td>
									<td class="d-flex justify-content-around">
										<a href="users.php?delete=<?= $user->id; ?>"
										   onclick="return confirm('Weet je zeker dat je deze gebruiker wil verwijderen?')">
											<i class="bi bi-trash text-danger"></i>
										</a>
										<a href="edit_user.php?id=<?= $user->id; ?>">
											<i class="bi bi-eye text-primary"></i>
										</a>
									</td>
								</tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="tab-pane fade" id="inactive-tab-pane" role="tabpanel" aria-labelledby="inactive-tab">
						<table class="table table-striped" id="table2">
							<thead>
							<tr>
								<th>Klantnr</th>
								<th>username</th>
								<th>paswoord</th>
								<th>Voornaam</th>
								<th>Familienaam</th>
								<th>Created_at</th>
								<th>Deleted at</th>
								<th>Actions</th>
							</tr>
							</thead>
							<tbody>
                            <?php $inactive_users = User::find_all(); ?>
                            <?php foreach ($inactive_users as $user): ?>
                                <?php if($user->deleted_at !== '0000-00-00 00:00:00'): ?>
									<tr>
										<td><?= $user->id; ?></td>
										<td><span><img height="40" width="40" class="avatar me-3"
										               src="../admin/assets/static/images/faces/8.jpg"
										               alt=""></span><?= $user->username; ?></td>
										<td><?= $user->password; ?></td>
										<td><?= $user->first_name; ?></td>
										<td><?= $user->last_name; ?></td>
										<td><?= $user->created_at; ?></td>
										<td><?= $user->deleted_at; ?></td>
										<td class="d-flex justify-content-around">
											<a href="users.php?restore=<?= $user->id; ?>"
											   onclick="return confirm('Weet je zeker dat je deze gebruiker wil herstellen?')">
												<i class="bi bi-bootstrap-reboot text-warning"></i>
											</a>
											<a href="edit_user.php?id=<?= $user->id; ?>">
												<i class="bi bi-eye text-primary"></i>
											</a>
										</td>
									</tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

<script>
    // Selecteer de nav-tabs en de tabel
    const navTabs = document.querySelectorAll('.nav-tabs li');
    const table = document.getElementById('table1');

    // Voeg een event listener toe aan de nav-tabs
    navTabs.forEach((tab) => {
        tab.addEventListener('click', (e) => {
            // Haal de actieve status op van de geklikte tab
            const isActive = e.target.textContent === 'Active';

            // Filter de tabel op basis van de actieve status
            const rows = table.rows;
            rows.forEach((row) => {
                const deletedAt = row.cells[6].textContent; // Kolom 6 is de deleted_at kolom
                if (isActive && deletedAt !== '') {
                    row.style.display = 'none';
                } else if (!isActive && deletedAt === '') {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        });
    });
</script>

<?php
require_once("includes/widget.php");
require_once("includes/footer.php");
?>