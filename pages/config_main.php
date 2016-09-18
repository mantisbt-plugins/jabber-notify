<?php
/*
   Copyright 2012 Nikitin Artem (AcanthiS)

	E-Mail : acanthis@ya.ru
	ICQ    : 411746920

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2();
print_manage_menu();
?>

<br/>
<table align="center" class="width50" cellspacing="1" style="border:none">
	<tr >
		<td style="text-align:right;">
			[  <?php echo plugin_lang_get( 'main_plugin_config' ) ?> ]
			[ <a href=" <?php echo plugin_page( 'config_xmpp_login', true ) ?> "> <?php echo plugin_lang_get( 'xmpp_plugin_config' ) ?></a> ]
			[ <a href=" <?php echo plugin_page( 'config_custom_proj_user', true ) ?> "> <?php echo plugin_lang_get( 'custom_proj_user_plugin_config' ) ?></a> ]
		</td>
	</tr>
</table>

<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">
<?php echo form_security_field( 'plugin_JabberNotifySystem_manage_config' ) ?>
<table align="center" class="width50" cellspacing="1" style="border-bottom:none;">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_jabber' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?> >
		<td class="category">
			<?php echo plugin_lang_get( 'config_jabber_server' ) ?><br>
			<span class="small"><?php echo plugin_lang_get( 'config_jabber_ex_srv' ) ?></span>
		</td>
		<td class="left" width="50%">
			<input tabindex="6" type="text" name="jbr_server" size="30" maxlength="255" value="<?php echo plugin_config_get( 'jbr_server' ) ?>">:<input tabindex="6" type="text" name="jbr_port" size="2" maxlength="4" value="<?php echo plugin_config_get( 'jbr_port' ) ?>">
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'config_jabber_timeout' ) ?>
		</td>
		<td class="left">
			<input tabindex="6" type="text" name="jbr_timeout" size="40" maxlength="255" value="<?php echo plugin_config_get( 'jbr_timeout' ) ?>">
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'config_jabber_login' ) ?>
		</td>
		<td class="left">
			<input tabindex="6" type="text" name="jbr_login" size="40" maxlength="255" value="<?php echo plugin_config_get( 'jbr_login' ) ?>">
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'config_jabber_pwd' ) ?>
		</td>
		<td class="left">
			<input tabindex="6" type="password" name="jbr_pwd" size="40" maxlength="255" value="<?php echo plugin_config_get( 'jbr_pwd' ) ?>">
		</td>
	</tr>
</table>


<table align="center" class="width50" cellspacing="1" style="border-bottom:none;">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'send_msg' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_new_bug' ) ?>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="send_mes_new_bug" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_bug' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="send_mes_new_bug" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_bug' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_new_bugnote' ) ?>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="send_mes_new_bugnote" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_bugnote' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center" width="10%">
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
			<?php echo plugin_lang_get( 'send_del_bugnote' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_del_bugnote" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_del_bugnote' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_del_bugnote" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_del_bugnote' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
</table>

<table align="center" class="width50" cellspacing="1" style="border-bottom:none;">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'action_notif_setting' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_new_resp' ) ?>
			<br>
			<span class="small"><?php echo plugin_lang_get( 'send_new_resp_com' ) ?></span>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_new_assign" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_assign' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_new_assign" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_new_assign' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_move_bugnote' ) ?>
			<br>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_move_bug" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_move_bug' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_move_bug" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_move_bug' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_del_bug' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_del_bug" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_del_bug' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_del_bug" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_del_bug' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_mes_up_prior' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_prior" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_up_prior' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_prior" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_up_prior' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_mes_up_category' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_category" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_up_category' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_category" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_up_category' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_mes_up_view' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_view" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_up_view' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_view" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_up_view' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_mes_add_note' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_add_note" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_add_note' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_add_note" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_add_note' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_mes_up_status' ) ?>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_status" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_up_status' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center">
			<label><input type="radio" name="send_mes_up_status" value="0" <?php echo ( OFF == plugin_config_get( 'send_mes_up_status' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'send_new_state_10' ) ?>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="send_mes_new_state_10" value="1" <?php echo ( ON == plugin_config_get( 'send_mes_new_state_10' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center" width="10%">
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

<table align="center" class="width50" cellspacing="1" style="border-bottom:none;">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_view' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'add_send_quick_msg' ) ?>
			<br>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="add_send_quick_msg" value="1" <?php echo ( ON == plugin_config_get( 'add_send_quick_msg' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="add_send_quick_msg" value="0" <?php echo ( OFF == plugin_config_get( 'add_send_quick_msg' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
</table>

<table align="center" class="width50" cellspacing="1" style="border-bottom:none;">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'edit_xmpp_user' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
		<td class="category">
			<?php echo plugin_lang_get( 'change_user_xmpp_login' ) ?>
			<br>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="change_xmpp_login" value="1" <?php echo ( ON == plugin_config_get( 'change_xmpp_login' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'enabled' ) ?></label>
		</td>
		<td class="center" width="10%">
			<label><input type="radio" name="change_xmpp_login" value="0" <?php echo ( OFF == plugin_config_get( 'change_xmpp_login' ) ) ? 'checked="checked" ' : ''?>/>
				<?php echo plugin_lang_get( 'disabled' ) ?></label>
		</td>
	</tr>
</table>

<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="center">
			<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
		</td>
	</tr>
</table>
</form><br>

<?php
html_page_bottom1( __FILE__ );
?>
