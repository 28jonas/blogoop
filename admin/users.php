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
						<th>Klantnr</th>
						<th>username</th>
						<th>paswoord</th>
						<th>Voornaam</th>
						<th>Familienaam</th>
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
							<td><?= $user->last_name; ?></td
						</tr>
                    <?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>

	</section>
<?php
require_once("includes/widget.php");
require_once("includes/footer.php");
?>