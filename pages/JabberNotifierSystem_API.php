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

/**
  * Get bug link.
  */
function get_bug_link( $bug_id ) {
  global $g_path;

  $bug_link = $g_path . 'view.php?id=' . $bug_id;
  return $bug_link;
}

/**
  * Get xmpp login.
  */
function get_xmpp_login( $user_id ) {
  $user_table = db_get_table( 'mantis_user_table' );
  $xmpp_login_table = plugin_table( 'xmpp_login', 'JabberNotifierSystem' );
  $query_xmpp_login = "SELECT xmpp_login FROM $xmpp_login_table WHERE user_id = $user_id;";
  $res_xmpp_login = db_query( $query_xmpp_login );

  while ( $row_xmpp_login = db_fetch_array( $res_xmpp_login ) ) {
    $jbr_login = $row_xmpp_login['xmpp_login'];
  }
  if ( $jbr_login == '' ) {
    $query_user_name = "SELECT username FROM $user_table WHERE id = $user_id;";
    $res_user_name   = db_query( $query_user_name );
    while ( $row_user_name = db_fetch_array( $res_user_name ) ) {
      $jbr_login = $row_user_name['username'];
    }
  }
  return $jbr_login;
}

/**
  * Get username.
  */
function get_username( $user_id ) {
  $user_table = db_get_table( 'mantis_user_table' );
  $query_rep_user_name = "SELECT realname, username FROM $user_table WHERE id = $user_id;";
  $res_rep_user_name = db_query( $query_rep_user_name );
  while ($row_rep_user_name = db_fetch_array( $res_rep_user_name ) ) {
    if ( $row_rep_user_name['realname'] == '' ) {
      $user_name = $row_rep_user_name['username'];
    } else {
      $user_name = $row_rep_user_name['realname'];
    }
  }
  return $user_name;
}

 /**
  * Check user from projects table.
  */
 function check_user_from_projects_table( $bug_id ) {
   $user_id	    = bug_get_field( $bug_id, 'reporter_id' );
   $proj_id         = bug_get_field( $bug_id, 'project_id' );
   $user_proj_table = plugin_table( 'user_proj', 'JabberNotifierSystem' );
   $query           = "SELECT proj_id FROM $user_proj_table WHERE user_id = $user_id LIMIT 1;";
   $res             = db_query($query);
   if ( db_num_rows($res) != 0 ) {
		$row = db_fetch_array($res);
		$arr = explode(',', $row['proj_id']);
		if (in_array($proj_id, $arr))
			return true;
		else
			return false;
   }
   return true;
 }

/**
  * Send message.
  */
function send_msg( $jbr_user, $msg ) {
  $conn = new XMPPHP_XMPP( plugin_config_get( 'jbr_server' ), plugin_config_get( 'jbr_port' ), plugin_config_get( 'jbr_login' ), plugin_config_get( 'jbr_pwd' ), 'xmpphp', plugin_config_get( 'jbr_server' ), $printlog = False, $loglevel = 'LOGGING_INFO' );
    //$conn->useEncryption(false); //Enable this line if you get a error "Fatal error: Cannot access protected property XMPPHP_XMPP::$use_encryption"

  try {
    $conn->connect( $timeout = plugin_config_get( 'jbr_timeout' ) );
    $conn->processUntil( 'session_start' );
    $conn->message( $jbr_user . '@' . plugin_config_get( 'jbr_server' ), $msg );
    $conn->disconnect();
  }
  catch( XMPPHP_Exception $e ) {
    $e->getMessage();
  }
}

/**
  * Send quick message.
  */
function send_quick_msg( $jbr_user, $msg, $bug_id ) {
  $conn = new XMPPHP_XMPP( plugin_config_get( 'jbr_server' ), plugin_config_get( 'jbr_port' ), plugin_config_get( 'jbr_login' ), plugin_config_get( 'jbr_pwd' ), 'xmpphp', plugin_config_get( 'jbr_server' ), $printlog = False, $loglevel = 'LOGGING_INFO' );
  //$conn->useEncryption(false); //Enable this line if you get a error "Fatal error: Cannot access protected property XMPPHP_XMPP::$use_encryption"

  try {
    $conn->connect( $timeout = plugin_config_get( 'jbr_timeout' ) );
    $conn->processUntil( 'session_start' );
    $conn->message( $jbr_user . '@' . plugin_config_get( 'jbr_server' ), $msg );
    $conn->disconnect();
    echo '<center><div align="center" style="width:300px;border: solid 1px;padding:10px;margin-bottom:10px;background-color:#D2F5B0;">';
    echo plugin_lang_get( 'msg_send_successful' );
    echo '</div></center>';
    header( 'Refresh: 3; URL=' . get_bug_link( $bug_id ) );
  }
  catch( XMPPHP_Exception $e ) {
    $e->getMessage();
    echo '<center><div align="center" style="width:300px;border: solid 1px;padding:10px;margin-bottom:10px;background-color:#FCBDBD;">';
    echo plugin_lang_get( 'msg_send_error' );
    echo '</div></center>';
    header( 'Refresh: 3; URL=' . get_bug_link( $bug_id ) );
  }
}

/**
  * Get auth username.
  */
function get_auth_username() {
  require_once( 'core/authentication_api.php' );
  $logon_user_id = auth_get_current_user_id();
  $auth_username = get_username( $logon_user_id );

  return $auth_username;
}

function print_quick_msg( $bug_id, $user_id ) {
  echo '<form method="post" action="view.php?id=' . $bug_id . '">';
  echo '<tr class="row-1">';
  echo '<td class="category">'; print plugin_lang_get( 'add_send_quick_msg' );
  echo '<br>';
  echo '<span class="small">(' . get_xmpp_login( $user_id ) . '@' . plugin_config_get( 'jbr_server' ) . ')</span>';
  echo '</td>';
  echo '<td colspan="5">';
  echo '<textarea name="quick_msg" cols="40" rows="3"></textarea><br>';
  echo '<input type="submit" value="'; print plugin_lang_get( 'send_msg_btn_txt' ); echo '" class="button">';
  echo '</td>';
  echo '</tr>';
  echo '</form>';
}

function print_change_xmpp_login() {
  echo '<div align="center">';
  echo '<table align="center" class="width75" cellspacing="1" style="border-bottom:none;">';
  echo '<tr>';
  echo '<td class="form-title" colspan="3">';
  echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'edit_xmpp_user' );
  echo '</td>';
  echo '</tr>';
  echo '<table align="center" class="width75" cellspacing="1">';
  echo '<tr class="row-2">';
  echo '<td class="category" width="25%">'; print plugin_lang_get( 'xmpp_login' );
  echo '<br>';
  echo '<span class="small">';  print plugin_lang_get( 'xmpp_login_warn' ) . '</span>';
  echo '</td>';
  echo '<td colspan="5">';
  echo '<form method="post" action="' . plugin_page( 'change_xmpp_login.php' ) . '">';
  echo '<input type="text" name="xmpp_login" size="20" maxlength="20" value="' . get_xmpp_login( auth_get_current_user_id() ) . '">';
  echo '<input type="hidden" name="user_id" value="' . auth_get_current_user_id() . '"/>';
  echo '<input type="submit" value="'; print plugin_lang_get( 'change_btn_txt' ); echo '" class="button">';
  echo '</form>';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
  echo '</div>';
}

/****************************************
  * Generating of outgoing messages.
*****************************************/

/**
  * Gen quick message.
  */
function gen_quick_msg( $user_id, $bug_id, $quick_msg ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_send_quick_msg' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_quick_msg' ) . ' ' . $quick_msg . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen add bugnote message.
  */
function gen_add_bugnote_msg( $user_id, $bug_id, $bugnote_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bugnote_add' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_note' ) . ' ' . bugnote_get_text( $bugnote_id ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_note' ) . ' ' . string_get_bugnote_view_url_with_fqdn( $bug_id, $bugnote_id );

  return $send_msg;
}

/**
  * Gen change bugnote message.
  */
function gen_change_bugnote_msg( $user_id, $bug_id, $bugnote_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bugnote_edit' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' '  . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_note_change' ) . str_replace( "\n", '', bugnote_get_text( $bugnote_id ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_change_note' ) . ' ' . string_get_bugnote_view_url_with_fqdn( $bug_id, $bugnote_id );

  return $send_msg;
}

/**
  * Gen delete bugnote message.
  */
function gen_del_bugnote_msg( $user_id, $bug_id, $bugnote_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bugnote_del' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_note_id' ) . bugnote_format_id( $bugnote_id ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen delete bug message.
  */
function gen_del_bug_msg( $user_id, $bug_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_del' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' );

  return $send_msg;
}

/**
  * Gen close bug message.
  */
function gen_close_bug_msg( $user_id, $bug_id, $bugnote_text ) {
  if ($bugnote_text != '') {
    $bugnote_msg = plugin_lang_get( 'msg_note' ) . ' ' . $bugnote_text . "\n";
  } else {
    $bugnote_msg = '';
  }
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_close' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  $bugnote_msg .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen move bug message.
  */
function gen_move_bug_msg( $user_id, $bug_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_move' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_move_proj' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen resolve bug message.
  */
function gen_resolve_bug_msg( $user_id, $bug_id, $bugnote_text ) {
  if ($bugnote_text != '') {
    $bugnote_msg = plugin_lang_get( 'msg_note' ) . ' ' . $bugnote_text . "\n";
  } else {
    $bugnote_msg = '';
  }
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_resolve' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_resolution' ) . ' ' . get_enum_element( 'resolution', ( gpc_get_int( 'resolution' ) ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  $bugnote_msg .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen assign in bug message.
  */
function gen_assign_bug_msg_in( $user_id, $bug_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_assign_in' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_assign' ) . ' ' . get_username( gpc_get_int( 'assign' ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen assign out bug message.
  */
function gen_assign_bug_msg_out( $user_id, $bug_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_assign_out' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen update priority bug message.
  */
function gen_up_priority_bug_msg( $user_id, $bug_id ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_up_prior' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_action_bug_up_prior_str' ) . ' ' . get_enum_element( 'priority', ( gpc_get_int( 'priority' ) ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen update status bug message.
  */
function gen_up_status_bug_msg( $user_id, $bug_id, $bugnote_text ) {
  if ( $bugnote_text != '' ) {
    $bugnote_msg = plugin_lang_get( 'msg_note' ) . ' ' . $bugnote_text . "\n";
  } else {
    $bugnote_msg = '';
  }
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_up_status' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_action_bug_up_status_str' ) . ' ' . get_enum_element( 'status', ( gpc_get_int( 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  $bugnote_msg .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen update catgegory bug message.
  */
function gen_up_category_bug_msg( $user_id, $bug_id, $bugnote_text ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_up_category' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_action_bug_up_category_str' ) . ' ' . category_full_name( gpc_get_int( 'category' ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}

/**
  * Gen update view status bug message.
  */
function gen_up_view_status_bug_msg( $user_id, $bug_id, $bugnote_text ) {
  $send_msg = plugin_lang_get( 'msg_call' ) . ' ' . get_username( $user_id ) . '! ' . plugin_lang_get( 'msg_action_bug_up_view' ) . "\n" .
  plugin_lang_get( 'msg_bug_id' ) . ' ' . bug_format_id( $bug_id, 'category_id' ) . "\n" .
  plugin_lang_get( 'msg_state' ) . ' ' . get_enum_element( 'status', ( bug_get_field( $bug_id, 'status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_proj_id' ) . ' ' . project_get_name( bug_get_field( $bug_id, 'project_id' ) ) . "\n" .
  plugin_lang_get( 'msg_header' ) . ' ' . bug_get_field( $bug_id, 'summary' ) . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_action_bug_up_view_str' ) . ' ' . get_enum_element( 'view_state', ( gpc_get_int( 'view_status' ) ) ) . "\n" .
  plugin_lang_get( 'msg_initiator' ) . ' ' . get_auth_username() . "\n" .
  plugin_lang_get( 'separator' ) . "\n" .
  plugin_lang_get( 'msg_link_bug' ) . ' ' . get_bug_link( $bug_id );

  return $send_msg;
}
?>