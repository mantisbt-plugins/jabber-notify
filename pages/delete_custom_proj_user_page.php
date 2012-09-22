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
<div align="center">
<hr size="1" width="50%" />
<?php echo plugin_lang_get( 'cust_prj_usr_del_quest' ) ?>
<br>
<?php echo plugin_lang_get( 'user' ) ?> : <?php echo user_get_realname(gpc_get_string( 'user_id', '' ))?><br>
<form method="post" action="<?php echo plugin_page( 'delete_custom_proj_user.php' ) ?>">
<input type="hidden" name="user_id" value="<?php echo gpc_get_string( 'user_id', '' ) ?>"/><br>
<input type="submit" class="button" value="<?php echo plugin_lang_get( 'del_xmpp_user_msg_btn_txt' ) ?>" />
</form>
<hr size="1" width="50%" />

<?php
html_page_bottom1( __FILE__ );
?>