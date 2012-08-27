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
?>

<br>
<form method="post" action="<?php echo plugin_page( 'add_custom_proj_user.php' ) ?>">
<table align="center" class="width50" cellspacing="1">
<tr>
	<td class="form-title" colspan="2"><?php echo plugin_lang_get( 'add_projects' )?></td>
</tr>

<!-- Username -->
<tr class="row-1">
	<td class="category" width="30%"><?php echo plugin_lang_get( 'user' ) ?></td>
	<td width="70%">
		<?php echo user_get_realname(gpc_get_string( 'user_id', '' ))?>
		<input type="hidden" name="user_id" value="<?php echo gpc_get_string( 'user_id', '' ) ?>"/>
	</td>
</tr>
<tr class="row-1">
	<td class="category" width="30%"><?php echo plugin_lang_get( 'projects' ) ?></td>
	<td>
		<?php
		$proj_table_mantis = db_get_table( 'mantis_project_table' );
		$proj_table_plug   = plugin_table('user_proj', 'JabberNotifierSystem');
		$user_id           = gpc_get_string( 'user_id', '' );
		$query_proj        = "SELECT proj_id FROM $proj_table_plug WHERE user_id = $user_id;";
		$res               = db_query($query_proj);
		while($row = db_fetch_array($res)) {
			$proj_str = $row['proj_id'];
		}
		$query = "SELECT id, name FROM $proj_table_mantis WHERE id not in ($proj_str) order by name;";
		$res = db_query($query);
		$arr = explode(',', $proj_str);
		if (db_num_rows($res) != 0) {
			echo '<select name="project_id[]" multiple="multiple" size="8">';
			while($row = db_fetch_array($res)) { echo '<option value="' . $row['id'] . '">' .  $row['name'] . '</option>'; }
			echo '</select>';
		} else {
			echo plugin_lang_get( 'err_add_proj' );
		}
		?>
	</td>
</tr>
</table><br>
<div align="center">
<input type="submit" class="button" value="<?php echo plugin_lang_get( 'add_projects_btn_txt' ) ?>" />
</div>
</form>

<?php
html_page_bottom1( __FILE__ );
?>