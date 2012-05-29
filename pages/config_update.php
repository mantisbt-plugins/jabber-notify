<?php
form_security_validate( 'plugin_JabberNotifySystem_manage_config' );
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_jbr_server =  gpc_get_string( 'jbr_server' );
$f_jbr_port =  gpc_get_string( 'jbr_port' );
$f_jbr_login =  gpc_get_string( 'jbr_login' );
$f_jbr_pwd =  gpc_get_string( 'jbr_pwd' );

$f_send_mes_new_resp     = gpc_get_string( 'send_mes_new_resp' );
$f_send_mes_new_bugnote  = gpc_get_string( 'send_mes_new_bugnote' );
$f_send_mes_new_state_10 = gpc_get_string( 'send_mes_new_state_10' );
$f_send_mes_new_state_20 = gpc_get_string( 'send_mes_new_state_20' );
$f_send_mes_new_state_30 = gpc_get_string( 'send_mes_new_state_30' );
$f_send_mes_new_state_40 = gpc_get_string( 'send_mes_new_state_40' );
$f_send_mes_new_state_50 = gpc_get_string( 'send_mes_new_state_50' );
$f_send_mes_new_state_80 = gpc_get_string( 'send_mes_new_state_80' );
$f_send_mes_new_state_90 = gpc_get_string( 'send_mes_new_state_90' );

plugin_config_set( 'jbr_server', $f_jbr_server );
plugin_config_set( 'jbr_port', $f_jbr_port );
plugin_config_set( 'jbr_login', $f_jbr_login );
plugin_config_set( 'jbr_pwd', $f_jbr_pwd );

plugin_config_set( 'send_mes_new_resp', $f_send_mes_new_resp );
plugin_config_set( 'send_mes_new_bugnote', $f_send_mes_new_bugnote );
plugin_config_set( 'send_mes_new_state_10', $f_send_mes_new_state_10 );
plugin_config_set( 'send_mes_new_state_20', $f_send_mes_new_state_20 );
plugin_config_set( 'send_mes_new_state_30', $f_send_mes_new_state_30 );
plugin_config_set( 'send_mes_new_state_40', $f_send_mes_new_state_40 );
plugin_config_set( 'send_mes_new_state_50', $f_send_mes_new_state_50 );
plugin_config_set( 'send_mes_new_state_80', $f_send_mes_new_state_80 );
plugin_config_set( 'send_mes_new_state_90', $f_send_mes_new_state_90 );

print_successful_redirect( 'manage_plugin_page' );
?>