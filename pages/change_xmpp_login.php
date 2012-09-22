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

$xmpp_login = gpc_get_string( 'xmpp_login', '' );
$user_id = gpc_get_string( 'user_id', '' );

// Get user login
$user_table = db_get_table( 'mantis_user_table' );
$query_rep_user_name = "SELECT username FROM $user_table WHERE id = $user_id;";
$res_user_name = db_query( $query_rep_user_name );

while ( $row_user_name = db_fetch_array( $res_user_name )) {
  $user_name = $row_user_name['username'];
}

// Add xmpp login
if ( $xmpp_login != '' ) {
  $xmpp_table = plugin_table( 'xmpp_login', 'JabberNotifierSystem' );
  $query_xmpp_login = "SELECT xmpp_login FROM $xmpp_table WHERE user_id = $user_id;";
  $res_xmpp_login   = db_query( $query_xmpp_login );

  if ( db_num_rows( $res_xmpp_login ) == 0 ) {
    if ( $xmpp_login != $user_name ) {
      $add_user_query = "INSERT INTO $xmpp_table (user_id, xmpp_login, chng_login) VALUES ($user_id, \"$xmpp_login\", 0);";
      db_query( $add_user_query );
      print_successful_redirect( 'account_page.php' );
    } else {
      print_successful_redirect( 'account_page.php' ); exit;
    }
  } else {
    $add_user_query = "UPDATE $xmpp_table SET xmpp_login = \"$xmpp_login\" WHERE user_id = $user_id;";
    db_query_bound( $add_user_query );
    print_successful_redirect( 'account_page.php' );
  }
} else {
  print_successful_redirect( 'account_page.php' ); exit;
}
?>