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

$f_jbr_server = gpc_get_string( 'jbr_server' );
$f_jbr_port = gpc_get_string( 'jbr_port' );
$f_jbr_timeout = gpc_get_string( 'jbr_timeout' );
$f_jbr_login = gpc_get_string( 'jbr_login' );
$f_jbr_pwd = gpc_get_string( 'jbr_pwd' );

$f_add_send_quick_msg = gpc_get_string( 'add_send_quick_msg' );
$f_change_xmpp_login = gpc_get_string( 'change_xmpp_login' );
$f_send_mes_new_assing = gpc_get_string( 'send_mes_new_assign' );
$f_send_mes_new_bugnote = gpc_get_string( 'send_mes_new_bugnote' );
$f_send_mes_edit_bugnote = gpc_get_string( 'send_mes_edit_bugnote' );
$f_send_mes_del_bugnote = gpc_get_string( 'send_mes_del_bugnote' );
$f_send_mes_del_bug = gpc_get_string( 'send_mes_del_bug' );
$f_send_mes_move_bug = gpc_get_string( 'send_mes_move_bug' );
$f_send_mes_new_state_10 = gpc_get_string( 'send_mes_new_state_10' );
$f_send_mes_new_state_20 = gpc_get_string( 'send_mes_new_state_20' );
$f_send_mes_new_state_30 = gpc_get_string( 'send_mes_new_state_30' );
$f_send_mes_new_state_40 = gpc_get_string( 'send_mes_new_state_40' );
$f_send_mes_new_state_50 = gpc_get_string( 'send_mes_new_state_50' );
$f_send_mes_new_state_80 = gpc_get_string( 'send_mes_new_state_80' );
$f_send_mes_new_state_90 = gpc_get_string( 'send_mes_new_state_90' );

$f_send_mes_up_prior = gpc_get_string( 'send_mes_up_prior' );
$f_send_mes_up_status = gpc_get_string( 'send_mes_up_status' );
$f_send_mes_up_category = gpc_get_string( 'send_mes_up_category' );
$f_send_mes_up_view = gpc_get_string( 'send_mes_up_view' );
$f_send_mes_add_note = gpc_get_string( 'send_mes_add_note' );

plugin_config_set( 'jbr_server', $f_jbr_server );
plugin_config_set( 'jbr_port', $f_jbr_port );
plugin_config_set( 'jbr_timeout', $f_jbr_timeout );
plugin_config_set( 'jbr_login', $f_jbr_login );
plugin_config_set( 'jbr_pwd', $f_jbr_pwd );

plugin_config_set( 'add_send_quick_msg', $f_add_send_quick_msg );
plugin_config_set( 'change_xmpp_login', $f_change_xmpp_login );
plugin_config_set( 'send_mes_new_assign', $f_send_mes_new_assing );
plugin_config_set( 'send_mes_move_bug', $f_send_mes_move_bug );
plugin_config_set( 'send_mes_new_bugnote', $f_send_mes_new_bugnote );
plugin_config_set( 'send_mes_edit_bugnote', $f_send_mes_edit_bugnote );
plugin_config_set( 'send_mes_del_bugnote', $f_send_mes_del_bugnote );
plugin_config_set( 'send_mes_del_bug', $f_send_mes_del_bug );
plugin_config_set( 'send_mes_new_state_10', $f_send_mes_new_state_10 );
plugin_config_set( 'send_mes_new_state_20', $f_send_mes_new_state_20 );
plugin_config_set( 'send_mes_new_state_30', $f_send_mes_new_state_30 );
plugin_config_set( 'send_mes_new_state_40', $f_send_mes_new_state_40 );
plugin_config_set( 'send_mes_new_state_50', $f_send_mes_new_state_50 );
plugin_config_set( 'send_mes_new_state_80', $f_send_mes_new_state_80 );
plugin_config_set( 'send_mes_new_state_90', $f_send_mes_new_state_90 );

plugin_config_set( 'send_mes_up_prior', $f_send_mes_up_prior );
plugin_config_set( 'send_mes_up_status', $f_send_mes_up_status );
plugin_config_set( 'send_mes_up_category', $f_send_mes_up_category );
plugin_config_set( 'send_mes_up_view', $f_send_mes_up_view );
plugin_config_set( 'send_mes_add_note', $f_send_mes_add_note );

print_successful_redirect( plugin_page( 'config_main' ) );
?>