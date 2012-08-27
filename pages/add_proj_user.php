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
$f_proj_id	= gpc_get_int_array( 'project_id', array() );
$proj_table = plugin_table('user_proj', 'JabberNotifierSystem');

foreach( $f_user_id as $t_user_id ) {
	if ( count($f_proj_id) != 0 ) { 
		$proj_id=implode(',', $f_proj_id);
		$add_user_query = "INSERT INTO $proj_table (user_id, proj_id) VALUES ($t_user_id, \"$proj_id\");";
		db_query( $add_user_query );
	}
}

print_successful_redirect( plugin_page( 'config_custom_proj_user', true ) );
?>