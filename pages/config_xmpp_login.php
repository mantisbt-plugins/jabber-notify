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

require_once( 'JabberNotifierSystem_API.php' );
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2();
print_manage_menu();

// Check row count xmpp_login table.
$table = plugin_table( 'xmpp_login', 'JabberNotifierSystem' );
$query = "SELECT * FROM $table;";
$res   = db_query( $query );

if ( db_num_rows( $res ) == 0 ) {
  $style = '';
  $view_table = 0;
} else {
  $style = 'border-bottom:none;';
  $view_table = 1;
}
?>

<br/>
<table align="center" class="width50" cellspacing="1" style="border:none">
	<tr>
		<td style="text-align:right;";>
			[ <a href=" <?php echo plugin_page( 'config_main', true ) ?> "> <?php echo plugin_lang_get( 'main_plugin_config' ) ?></a> ]
			[ <?php echo plugin_lang_get( 'xmpp_plugin_config' ) ?> ]
			[ <a href=" <?php echo plugin_page( 'config_custom_proj_user', true ) ?> "> <?php echo plugin_lang_get( 'custom_proj_user_plugin_config' ) ?></a> ]
		</td>
	</tr>
</table>

<table align="center" class="width50" cellspacing="1" style="<?php echo $style ?>">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_add_jabber_user' ) ?>
		</td>
	</tr>
	<tr class="row-category">
		<td class="category">
			<?php echo plugin_lang_get( 'config_users' ) ?>
		</td>
		<td class="category" width="30%">
			<?php echo plugin_lang_get( 'action' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
	  <form action="<?php echo plugin_page( 'add_xmpp_user.php' ) ?>" method="post">
		<td class="center">
			<select name="user_id[]" multiple="multiple" size="8">
				<?php
				$user_table = db_get_table( 'mantis_user_table' );
				$id_table = plugin_table( 'xmpp_login', 'JabberNotifierSystem' );
				$query = "SELECT id, realname, username FROM $user_table WHERE id not in (select user_id from $id_table) order by realname;";
				$res = db_query( $query );
				while( $row = db_fetch_array($res) ) {
					$user_name = get_username( $row['id'] );
					echo '<option value="' . $row['id'] . '">' . $user_name . '</option>';
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

<?php if ($view_table) { ?>

<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_jabber_login_list' ) ?>
		</td>
	</tr>
	<tr class="row-category">
		<td class="category"><?php echo plugin_lang_get( 'user' ) ?></td>
		<td class="category"><?php echo plugin_lang_get( 'xmpp_login' ) ?></td>
		<td class="category"><?php echo plugin_lang_get( 'action' ) ?></td>
		<td class="category" width="10%"><?php echo plugin_lang_get( 'disabled_chanche_login' ) ?></td>
	</tr>
	<?php
		$table = plugin_table( 'xmpp_login', 'JabberNotifierSystem' );
		$user_table_mantis = db_get_table( 'mantis_user_table' );
		$query = "SELECT user_id, xmpp_login, chng_login FROM $table order by xmpp_login;";
		$res = db_query( $query );
		while( $row = db_fetch_array( $res ) ) {
			$change = $row['chng_login'];
			$user_id = $row['user_id'];
			if ( $change == 1 ) { $user_color_style = "background-color:#FCBDBD;"; } else { $user_color_style = ""; }
			$can_change = $row['chng_login'] == 1 ? 'checked="CHECKED"' : null;
	?>
	<tr  <?php echo helper_alternate_class() ?> style="<?php echo $user_color_style ?>">
		<td> <?php echo "<a href=" . $g_path . "manage_user_edit_page.php?user_id=$user_id\" target=\"_blank\">" . get_username( $user_id ) . "</a>" ?></td>
		<td width="40%"> <?php echo $row['xmpp_login'] . '@' . plugin_config_get( 'jbr_server' ); ?></td>
		<td class="center" width="20%">
		<form action="<?php echo plugin_page( 'edit_xmpp_login_page.php' ) ?>" method="post">
			<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>"/>
			<input type="hidden" name="xmpp_login" value="<?php echo $row['xmpp_login'] ?>"/>
			<input type="submit" class="button-small" value="<?php echo plugin_lang_get( 'change_btn_txt' ) ?>" />
		</form>
		<form action="<?php echo plugin_page( 'delete_xmpp_login_page.php' ) ?>" method="post">
			<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>"/>
			<input type="hidden" name="xmpp_login" value="<?php echo $row['xmpp_login'] ?>"/>
			<input type="submit" class="button-small" value="<?php echo plugin_lang_get( 'del_btn_txt' ) ?>" />
		</form>
		</td>
		<td class="center">
			<form action="<?php echo plugin_page( 'change_can_xmpp_login.php' ) ?>" method="post">
				<input type="checkbox" name="change" value="1" <?php  echo $can_change  ?> />
				<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>"/>
				<input type="submit" class="button-small" value="<?php echo lang_get( 'ok' ) ?>" />
			</form>
		</td>
	</tr>
	<?php } ?>
</table>
<br>

<?php
}
html_page_bottom1( __FILE__ );
?>