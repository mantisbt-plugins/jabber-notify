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

$f_user_id	= gpc_get_int_array( 'user_id', array() );
$xmpp_table = plugin_table( 'xmpp_login', 'JabberNotifierSystem' );
$user_table = db_get_table( 'mantis_user_table' );
	
foreach( $f_user_id as $t_user_id ) {
	$username_query = "SELECT username FROM $user_table WHERE id = $t_user_id;";
	$res            = db_query($username_query);
		while($row = db_fetch_array($res)) {
			 $xmpp_login = strtolower($row['username']);
		}
	$add_user_query = "INSERT INTO $xmpp_table (user_id, xmpp_login, chng_login) VALUES ($t_user_id, \"$xmpp_login\", 0);";
	db_query($add_user_query);
}
	
print_successful_redirect( plugin_page( 'config_xmpp_login', true ) );
?>