<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header1.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			&nbsp;
		</td>
		<td id="page">
			<h2>Меню на персоналът</h2>
			<p>Добре дошъл, <?php echo $_SESSION['username']; ?>.</p>
			<ul>
				<li><a href="content.php">Редактиране съдържанието на уебсайта</a></li>
				<li><a href="new_user.php">Добавяне на потребителски персонал</a></li>
				<li><a href="logout.php">Отписване</a></li>
			</ul>
		</td>
	</tr>
</table>
<?php include("includes/footer1.php"); ?>
