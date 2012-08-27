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

$user_id       =  gpc_get_string( 'user_id', '' );
$f_proj_id	   = gpc_get_int_array( 'project_id', array() );
$proj_table    = plugin_table('user_proj', 'JabberNotifierSystem');
$query_proj_id = "SELECT proj_id FROM $proj_table WHERE user_id = $user_id;";
$res_proj_id   = db_query($query_proj_id);

while($row_proj_id = db_fetch_array($res_proj_id)) {
	$source_arr = explode(',',$row_proj_id['proj_id']); 
}

foreach( $f_proj_id as $t_proj_id ) {
			array_push($source_arr, $t_proj_id);
}

$proj_id   = implode( ',', $source_arr );
$res_query = "UPDATE $proj_table SET proj_id = \"$proj_id\" WHERE user_id = $user_id;";
db_query($res_query);
	
print_successful_redirect( plugin_page( 'config_custom_proj_user', true ) );
?>