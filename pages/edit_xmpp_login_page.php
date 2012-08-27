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
<form method="post" action="<?php echo plugin_page( 'edit_xmpp_login' ) ?>">
<table align="center" class="width50" cellspacing="1">
<tr>
	<td class="form-title" colspan="2"><?php echo plugin_lang_get( 'edit_xmpp_user' )?></td>
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
	<td class="category" width="30%"><?php echo plugin_lang_get( 'xmpp_login' ) ?></td>
	<td width="70%">
		<input type="text" name="xmpp_login" size="32" maxlength="50" value="<?php echo gpc_get_string( 'xmpp_login', '' ) ?>" />
	</td>
</tr>
</table><br>

<div align="center">
<input type="submit" class="button" value="<?php echo plugin_lang_get( 'edit_xmpp_user_msg_btn_txt' ) ?>" />
</form>
</div>

<?php
html_page_bottom1( __FILE__ );
?>