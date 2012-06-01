<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2();
print_manage_menu();
?>

<br/>

<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">

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
			<?php echo plugin_lang_get( 'send_edit_bugnote' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_edit_bugnote" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_edit_bugnote' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_edit_bugnote" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_edit_bugnote' ) ) ? 'checked="checked" ' : ''?>/>
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
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_view' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'add_send_quick_msg_txt' ) ?>
			<br>
		</td>
		<td class="center">
			<label><input type="radio" name="add_send_quick_msg" value="1" <?php echo ( ON == plugin_config_get( 'add_send_quick_msg' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="add_send_quick_msg" value="0" <?php echo ( OFF == plugin_config_get( 'add_send_quick_msg' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
</table>

<br>

<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_add_jabber_user' ) ?>
		</td>
	</tr>
	<tr class="row-category">
		<td class="category">
			<?php echo plugin_lang_get( 'config_users' ) ?>
		</td>
		<td class="category">
			<?php echo plugin_lang_get( 'action' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
	  <form action="<?php echo plugin_page( 'add_xmpp_user_page.php' ) ?>" method="post">
		<td class="center">
			<select name="user_id[]" multiple="multiple" size="8">
				<?php 
				$user_table = db_get_table( 'mantis_user_table' );
				$id_table = plugin_table('xmpp_login_proj', 'JabberNotifierSystem');
				$query = "SELECT id, realname, username FROM $user_table WHERE id not in (select user_id from $id_table) order by realname;";
				$res = db_query($query);
				while($row = db_fetch_array($res)) {
					if ($row['realname'] == '') { $user_name = $row['username']; } else { $user_name = $row['realname']; }
					echo '<option value="' . $row['id'] . '">' .  $user_name . '</option>';
				}
				?>
			</select>
		</td>
		<td class="center">
		   <input type="submit" class="button" value="<?php echo plugin_lang_get( 'add_btn_txt' ) ?>" />
		</td>
	  </form>	
	</tr>
</table>

<br>

<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_jabber_login_list' ) ?>
		</td>
	</tr>
	<tr class="row-category">
		<td class="category"><?php echo plugin_lang_get( 'config_user' ) ?></td>
		<td class="category"><?php echo plugin_lang_get( 'config_xmpp_login' ) ?></td>
		<td class="category"><?php echo plugin_lang_get( 'action' ) ?></td>
	</tr>	
	<?php 
		$table = plugin_table('xmpp_login_proj', 'JabberNotifierSystem');
		$query = "SELECT  user_id, xmpp_login FROM $table;";
		$res = db_query($query);
		while($row = db_fetch_array($res)) {
	?>	
	<tr  <?php echo helper_alternate_class() ?>>
		<td> <?php echo user_get_realname($row['user_id']) ?></td>
		<td> <?php echo $row['xmpp_login'] ?></td>
		<td class="center">
		<form action="<?php echo plugin_page( 'edit_xmpp_login_page.php' ) ?>" method="post">
			<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>"/>
			<input type="hidden" name="xmpp_login" value="<?php echo $row['xmpp_login'] ?>"/>
			<input type="submit" class="button-small" value="Изменить" />
		</form>	
		<form action="<?php echo plugin_page( 'delete_xmpp_login_page.php' ) ?>" method="post">
			<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>"/>
			<input type="hidden" name="xmpp_login" value="<?php echo $row['xmpp_login'] ?>"/>
			<input type="submit" class="button-small" value="Удалить" />
		</form>	
		</td>
	</tr>
	<?php } ?>
</table>

<br>

<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_manage_users' ) ?>
		</td>
	</tr>
	<tr class="row-category">
		<td class="category">
			<?php echo plugin_lang_get( 'config_manage_users_name' ) ?>
		</td>
		<td class="category">
			<?php echo plugin_lang_get( 'config_manage_users_proj' ) ?>
		</td>
		<td class="category">
			<?php echo plugin_lang_get( 'config_manage_users_proj_add' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td >
		</td>
		<td class="center">
		</td>
		<td class="center">
		</td>
	</tr>
</table>

<br>

<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="center">
			<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
		</td>
	</tr>
</table>

</form>

<?php
html_page_bottom1( __FILE__ );