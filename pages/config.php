<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2();
print_manage_menu();
?>

<br/>
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<table align="center" class="width50" cellspacing="1">

<tr>
	<td class="form-title" colspan="3">
		<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config' ) ?>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'addbug_text' ) ?>
	</td>
	<td class="center">
	<select name="user_id[]" multiple="multiple" size="10">
						<?php print_project_user_list_option_list( $f_project_id ) ?>
	</select>
	<br/>
	<input type="submit" class="button" value="Добавить" />
	</td>
	<td class="center">
		
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'update_state_bug_text' ) ?>
	</td>
	<td class="center">
	<select name="user_id[]" multiple="multiple" size="10">
						<?php print_project_user_list_option_list( $f_project_id ) ?>
	</select>
	<br/>
	<input type="submit" class="button" value="Добавить" />
	</td>
	<td class="center">
		
	</td>
</tr>

<tr>
	<td class="center" colspan="3">
		<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
	</td>
</tr>

</table>
</form>

<?php
html_page_bottom1( __FILE__ );
