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

$user_id  = gpc_get_string( 'user_id', '' );
$table    = plugin_table( 'user_proj', 'JabberNotifierSystem' );
$query    = "DELETE FROM $table WHERE user_id = $user_id;";
db_query( $query );

print_successful_redirect( plugin_page( 'config_custom_proj_user', true ) );
?>