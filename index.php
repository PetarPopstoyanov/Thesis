<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo public_navigation($sel_subject, $sel_page); ?>
		</td>
		<td id="page">
			<?php if ($sel_page) { ?>
				<h2><?php echo htmlentities($sel_page['menu_name']); ?></h2>
				<div class="page-content">
					<?php echo strip_tags(nl2br($sel_page['content']), "<b><i><u><hr><br><p><a><div><img><html><head><title><body><font>"); ?>
				</div>
			<?php } else { ?>
				<h2>Добре дошли в Пежо Клуб България</h2>
                                <div align="center"><img src="images/first_page.jpg" width="1000" height="500" /></div>

			<?php } ?>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>