<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ?>
<?php include("includes/header1.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subject, $sel_page); ?>
			<br />
			<a href="new_subject.php">+ Добави нова глава</a>

                        <pre><font face="Verdana, Arial, Helvetica, sans-serif"><a href="staff.php">  <u>Назад към менюто</u></a></font></pre>                    
		</td>
		<td id="page">
		<?php if (!is_null($sel_subject)) { // subject selected ?>
			<h2><?php echo $sel_subject['menu_name']; ?></h2>
		<?php } elseif (!is_null($sel_page)) { // page selected ?>
			<h2><?php echo $sel_page['menu_name']; ?></h2>
			<div class="page-content">
				<?php echo $sel_page['content']; ?>
			</div>
			<br />
			<a href="edit_page.php?page=<?php echo urlencode($sel_page['id']); ?>">Редактирай страницата</a>
		<?php } else { // nothing selected ?>
			<h2>Избери глава или страница за редактиране</h2>
		<?php } ?>
		</td>
	</tr>
</table>
<?php require("includes/footer1.php"); ?>
