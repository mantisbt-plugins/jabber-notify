<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2();
print_manage_menu();
?>

<br/>
<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">
<?php echo form_security_field( 'plugin_JabberNotifySystem_manage_config' ) ?>
<table align="center" class="width50" cellspacing="1">
<tr>
	<td class="form-title" colspan="3">
		<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_jabber' ) ?>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'config_jabber_server' ) ?>
	</td>
<td class="left">
	<input tabindex="6" type="text" name="jbr_server" size="40" maxlength="255" value="<?php echo ( plugin_config_get( 'jbr_server' )) ?>">:<input tabindex="6" type="text" name="jbr_port" size="5" maxlength="4" value="<?php echo ( plugin_config_get( 'jbr_port' )) ?>">
	</td>
</tr>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'config_jabber_login' ) ?>
	</td>
	<td class="left">
		<input tabindex="6" type="text" name="jbr_login" size="40" maxlength="255" value="<?php echo ( plugin_config_get( 'jbr_login' )) ?>">
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'config_jabber_pwd' ) ?>
	</td>
	<td class="left">
		<input tabindex="6" type="password" name="jbr_pwd" size="40" maxlength="255" value="<?php echo ( plugin_config_get( 'jbr_pwd' )) ?>">
	</td>
</tr>
</table>

<br>

<table align="center" class="width50" cellspacing="1">
<tr>
	<td class="form-title" colspan="3">
		<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'send_msg' ) ?>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_resp' ) ?>
		<br>
		<span class="small"><?php echo plugin_lang_get( 'send_new_resp_com' ) ?></span>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_resp" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_resp' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_resp" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_resp' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_bugnote' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_bugnote" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_bugnote' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_bugnote" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_bugnote' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_state_10' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_10" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_10' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_10" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_state_10' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_state_20' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_20" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_20' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_20" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_state_20' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_state_30' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_30" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_30' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_30" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_state_30' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_state_40' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_40" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_40' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_40" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_state_40' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_state_50' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_50" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_50' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_50" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_state_50' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_state_80' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_80" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_80' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_80" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_state_80' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo plugin_lang_get( 'send_new_state_90' ) ?>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_90" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_90' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="send_mes_new_state_90" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_state_90' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo plugin_lang_get( 'disabled' ) ?></label>
	</td>
</tr>
</table>

<br>

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
		Список юзеров
	</td>
</tr>
</table>

<p class="center">
	<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
</p>
</form>

<?php
html_page_bottom1( __FILE__ );
