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

// Check row count user_proj table.
$table = plugin_table( 'user_proj', 'JabberNotifierSystem' );
$query = "SELECT * FROM $table;";
$res = db_query( $query );

if ( db_num_rows($res) == 0 ) {
  $style = '';
  $view_table = 0;
} else {
  $style = 'border-bottom:none';
  $view_table = 1;
}
?>

<br/>
<table align="center" class="width50" cellspacing="1" style="border:none">
	<tr >
		<td style="text-align:right;">
			[ <a href=" <?php echo plugin_page( 'config_main', true ) ?> "> <?php echo plugin_lang_get( 'main_plugin_config' ) ?></a> ]
			[ <a href=" <?php echo plugin_page( 'config_xmpp_login', true ) ?> "> <?php echo plugin_lang_get( 'xmpp_plugin_config' ) ?></a> ]
			[ <?php echo plugin_lang_get( 'custom_proj_user_plugin_config' ) ?> ]
		</td>
	</tr>
</table>

<table align="center" class="width50" cellspacing="1" style="<?php echo $style ?>">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config_manage_users' ) ?>
		</td>
	</tr>
	<tr class="row-category">
		<td class="category">
			<?php echo plugin_lang_get( 'config_users' ) ?>
		</td>
		<td class="category">
			<?php echo plugin_lang_get( 'projects' ) ?>
		</td>
		<td class="category">
			<?php echo plugin_lang_get( 'action' ) ?>
		</td>
	</tr>
	<tr <?php echo helper_alternate_class() ?>>
	  <form action="<?php echo plugin_page( 'add_proj_user.php' ) ?>" method="post">
		<td class="center">
			<select name="user_id[]" multiple="multiple" size="8">
				<?php
				$user_table = db_get_table( 'mantis_user_table' );
				$proj_table = plugin_table( 'user_proj', 'JabberNotifierSystem' );
				$query = "SELECT id, realname, username FROM $user_table WHERE id not in (select user_id from $proj_table) order by realname;";
				$res = db_query( $query );
				while( $row = db_fetch_array( $res ) ) {
				if ( $row['realname'] == '' ) { $user_name = $row['username']; } else { $user_name = $row['realname']; }
					echo '<option value="' . $row['id'] . '">' . $user_name . '</option>';
				}
				?>
			</select>
		</td>
		<td class="center">
			<select name="project_id[]" multiple="multiple" size="8">
				<?php print_project_user_list_option_list2( $t_user['id'] ) ?>
			</select>
		</td>
		<td class="center">
		   <input type="submit" class="button" value="<?php echo plugin_lang_get( 'add_btn_txt' ) ?>" />
		</td>
	  </form>
	</tr>
</table>

<?php if ( $view_table ) { ?>

<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="3">
			<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'manage_custom_proj_title' ) ?>
		</td>
	</tr>
	<tr class="row-category">
		<td class="category">
			<?php echo plugin_lang_get( 'user' ) ?>
		</td>
		<td class="category">
			<?php echo plugin_lang_get( 'config_manage_users_proj' ) ?>
		</td>
		<td class="category">
			<?php echo plugin_lang_get( 'action' ) ?>
		</td>
	</tr>
	<?php
		$user_table_mantis = db_get_table( 'mantis_user_table' );
		$proj_table_mantis = db_get_table( 'mantis_project_table' );
		$proj_table_plug = plugin_table( 'user_proj', 'JabberNotifierSystem' );

		$query = "SELECT user_id, proj_id FROM $proj_table_plug;";
		$res = db_query( $query );
		while( $row = db_fetch_array( $res )) {
			$user_id = $row['user_id'];
			$query_user = "SELECT id, realname, username FROM $user_table_mantis WHERE id = $user_id;";
				$res_user = db_query( $query_user );
				while( $row_user = db_fetch_array( $res_user ) ) {
				if ( $row_user['realname'] == '' ) { $user_name = $row_user['username']; } else { $user_name = $row_user['realname']; }
					echo '<option value="' . $row_user['id'] . '">' . $user_name . '</option>';
				}
	?>
	<tr <?php echo helper_alternate_class() ?>>
		<td> <?php echo "<a href=" . $g_path . "manage_user_edit_page.php?user_id=$user_id\" target=\"_blank\">" . $user_name . "</a>" ?> </td>
		<td class="center">
			<?php
				$arr = explode( ',', $row['proj_id'] );
				foreach( $arr as $proj_id ) {
				echo '<form action="' . plugin_page( 'delete_proj_user.php' ) . '" method="post">';
				echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>';
					$query_proj = "SELECT name FROM $proj_table_mantis WHERE id = $proj_id;";
					$res_proj = db_query( $query_proj );
					while( $row_proj = db_fetch_array( $res_proj ) ) {
						echo "<a href=" . $g_path . "manage_proj_edit_page.php?project_id=$proj_id  target=\"_blank\">" . $row_proj['name'] . "</a>";
						echo '<input type="hidden" name="proj_id" value="' . $proj_id . '"/>';
						if ( count( $arr ) != 1 ) { echo '<input type="submit" class="button-small" value="' . plugin_lang_get( 'del_btn_txt' ) . '" />'; }
						echo '<br>'."\n".'</form>';
					}
				}
			?>
		</td>
		</form>
		<td class="center">
	      <form action="<?php echo plugin_page( 'add_custom_proj_user_page.php' ) ?>" method="post">
			<input type="submit" class="button" value="<?php echo plugin_lang_get( 'add_projects_btn_txt' ) ?>" />
			<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
		  </form>
		  <br>
		  <form action="<?php echo plugin_page( 'delete_custom_proj_user_page.php' ) ?>" method="post">
			<input type="submit" class="button" value="<?php echo plugin_lang_get( 'del_xmpp_user_msg_btn_txt' ) ?>" />
			<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
		  </form>
		</td>
	</tr>
	<?php } ?>
</table>
<br>
<div class="center">
	<span class="small"><?php echo plugin_lang_get( 'manage_custom_proj_warning_msg' ) ?></span>
</div>

<?php
}
html_page_bottom1( __FILE__ );
?>