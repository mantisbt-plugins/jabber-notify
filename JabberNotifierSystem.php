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

class JabberNotifierSystemPlugin extends MantisPlugin {

  function register() {
    $this->name        = plugin_lang_get( 'title' );
    $this->description = plugin_lang_get( 'description' );
    $this->page        = 'config_main';
    $this->version     = '1.0';
    $this->requires    = array('MantisCore' => '1.2.0',);
    $this->author      = 'AcanthiS';
    $this->contact     = 'acanthis@ya.ru';
  }

  /**
   * Default plugin configuration.
   */
  function config() {
    return array(
      'jbr_server'             => 'localhost',
      'jbr_port'               => '5222',
      'jbr_timeout'            => '20',
      'jbr_login'              => '',
      'jbr_pwd'                => '',
      'add_send_quick_msg'     => OFF,
      'change_xmpp_login'      => OFF,
      'send_mes_new_bugnote'   => ON,
      'send_mes_edit_bugnote'  => ON,
      'send_mes_del_bugnote'   => OFF,
      'send_mes_new_assign'    => ON,
      'send_mes_move_bug'      => ON,
      'send_mes_del_bug'       => OFF,
      'send_mes_new_state_10'  => ON,
      'send_mes_new_state_20'  => ON,
      'send_mes_new_state_30'  => ON,
      'send_mes_new_state_40'  => ON,
      'send_mes_new_state_50'  => ON,
      'send_mes_new_state_80'  => ON,
      'send_mes_new_state_90'  => ON,
      'send_mes_up_prior'      => ON,
      'send_mes_up_status'     => ON,
      'send_mes_up_category'   => ON,
      'send_mes_up_view'       => ON,
      'send_mes_add_note'      => ON,
    );
  }

  /**
   * Load the XMPP Class.
   */
  function init() {
    require_once( 'pages/JabberNotifierSystem_API.php' );
    plugin_file( 'XMPPHP/XMPP.php' );
  }

  /**
   * Install plugin function.
   */
  function install() {
    return true;
  }

  /**
   * Event hooks.
   */
  function hooks() {
    return array(
      'EVENT_BUGNOTE_ADD'        => 'bugnote_add',
      'EVENT_BUGNOTE_EDIT'       => 'bugnote_edit',
      'EVENT_BUGNOTE_DELETED'    => 'bugnote_del',
      'EVENT_VIEW_BUG_DETAILS'   => 'send_quick_msg',
      'EVENT_BUG_ACTION'         => 'bug_actions',
      'EVENT_BUG_DELETED'        => 'bug_delete',
      'EVENT_LAYOUT_CONTENT_END' => 'change_xmpp_login',
    );
  }

  /**
   * Send message when bugnote add.
   */
  function bugnote_add( $p_event, $p_bug_id, $p_bugnote_id ) {
    if ( check_user_from_projects_table( $p_bug_id ) ) {
      if ( (ON == plugin_config_get( 'send_mes_new_bugnote' )) && ( is_page_name( 'bugnote_add.php' ) ) ) {
        $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
        send_msg( get_xmpp_login( $reporter_user_id ), gen_add_bugnote_msg( $reporter_user_id, $p_bug_id, $p_bugnote_id ) );
      }
    }
  }

  /**
   * Send message when bugnote change.
   */
  function bugnote_edit( $p_event, $p_bug_id, $p_bugnote_id ) {
    if ( check_user_from_projects_table( $p_bug_id ) ) {
      if ( ON == plugin_config_get( 'send_mes_edit_bugnote' ) ){
        $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
        send_msg( get_xmpp_login( $reporter_user_id ), gen_change_bugnote_msg( $reporter_user_id, $p_bug_id, $p_bugnote_id ) );
      }
    }
  }

  /**
   * Send message when bugnote delete.
   */
  function bugnote_del( $p_event, $p_bug_id, $p_bugnote_id ) {
    if ( check_user_from_projects_table( $p_bug_id ) ) {
      if ( ON == plugin_config_get( 'send_mes_del_bugnote' ) ){
        $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
        send_msg( get_xmpp_login( $reporter_user_id ), gen_del_bugnote_msg( $reporter_user_id, $p_bug_id, $p_bugnote_id ) );
      }
    }
  }

  /**
   * Send message when delete bug.
   */
  function bug_delete( $p_event, $p_bug_id ) {
    if ( check_user_from_projects_table( $p_bug_id ) ) {
      if ( ON == plugin_config_get( 'send_mes_del_bug' ) ){
        $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
        send_msg( get_xmpp_login( $reporter_user_id ), gen_del_bug_msg( $reporter_user_id, $p_bug_id ) );
      }
    }
  }

  /**
   * Send message bug_actions.
   */
  function bug_actions( $p_event, $p_event_str, $p_bug_id ) {
    if ( check_user_from_projects_table( $p_bug_id ) ) {

      $f_action = gpc_get_string( 'action' );
      switch ( $f_action ) {
        case 'CLOSE':
          if  (ON == plugin_config_get( 'send_mes_new_state_90' ))  {
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            $bugnote_text     = gpc_get_string( 'bugnote_text', '' );
            send_msg( get_xmpp_login( $reporter_user_id ), gen_close_bug_msg( $reporter_user_id, $p_bug_id, $bugnote_text ) );
          }
          break;
        case 'MOVE':
          if ( ON == plugin_config_get( 'send_mes_move_bug' ) ){
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            send_msg( get_xmpp_login( $reporter_user_id ), gen_move_bug_msg( $reporter_user_id, $p_bug_id ) );
          }
          break;
        case 'RESOLVE':
          if ( ON == plugin_config_get( 'send_mes_new_state_80' ) ){
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            $bugnote_text     = gpc_get_string( 'bugnote_text', '' );
            send_msg( get_xmpp_login( $reporter_user_id ), gen_resolve_bug_msg( $reporter_user_id, $p_bug_id, $bugnote_text ) );
          }
          break;
        case 'ASSIGN':
          if ( ON == plugin_config_get( 'send_mes_new_assign' ) ){
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            send_msg( get_xmpp_login( $reporter_user_id ), gen_assign_bug_msg_in( $reporter_user_id, $p_bug_id ) );
            send_msg( get_xmpp_login( gpc_get_int( 'assign' ) ), gen_assign_bug_msg_out( $reporter_user_id, $p_bug_id ) );
          }
          break;
        case 'UP_PRIOR':
          if ( ON == plugin_config_get( 'send_mes_up_prior' ) ){
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            send_msg( get_xmpp_login( $reporter_user_id ), gen_up_priority_bug_msg( $reporter_user_id, $p_bug_id ) );
          }
          break;
        case 'UP_STATUS':
          if ( ON == plugin_config_get( 'send_mes_up_status' ) ) {
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            $bugnote_text = gpc_get_string( 'bugnote_text', '' );
            $status = gpc_get_int( 'status' );

            switch ( $status ) {
              case '10':
                if ( ON == plugin_config_get( 'send_mes_new_state_10' ) ) {
                  send_msg( get_xmpp_login( $reporter_user_id ), gen_up_status_bug_msg($reporter_user_id, $p_bug_id, $bugnote_text ) );
                }
                break;
              case '20':
                if ( ON == plugin_config_get( 'send_mes_new_state_20' ) ) {
                  send_msg( get_xmpp_login( $reporter_user_id ), gen_up_status_bug_msg($reporter_user_id, $p_bug_id, $bugnote_text ) );
                }
                break;
              case '30':
                if ( ON == plugin_config_get( 'send_mes_new_state_30' ) ) {
                  send_msg( get_xmpp_login( $reporter_user_id ), gen_up_status_bug_msg($reporter_user_id, $p_bug_id, $bugnote_text ) );
                }
                break;
              case '40':
                if ( ON == plugin_config_get( 'send_mes_new_state_40' ) ) {
                  send_msg( get_xmpp_login( $reporter_user_id ), gen_up_status_bug_msg($reporter_user_id, $p_bug_id, $bugnote_text ) );
                }
                break;
              case '50':
                if ( ON == plugin_config_get( 'send_mes_new_state_50' ) ) {
                  send_msg( get_xmpp_login( $reporter_user_id ), gen_up_status_bug_msg($reporter_user_id, $p_bug_id, $bugnote_text ) );
                }
                break;
              case '80':
                if ( ON == plugin_config_get( 'send_mes_new_state_80' ) ) {
                  send_msg( get_xmpp_login( $reporter_user_id ), gen_up_status_bug_msg($reporter_user_id, $p_bug_id, $bugnote_text ) );
                }
                break;
              case '90':
                if ( ON == plugin_config_get( 'send_mes_new_state_90' ) ) {
                  send_msg( get_xmpp_login( $reporter_user_id ), gen_up_status_bug_msg($reporter_user_id, $p_bug_id, $bugnote_text ) );
                }
                break;
            }
          }
          break;
        case 'UP_CATEGORY':
          if ( ( ( gpc_get_int( 'category' ) ) != 0 ) && ( ON == plugin_config_get( 'send_mes_up_category' ) ) ) {
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            send_msg( get_xmpp_login( $reporter_user_id ), gen_up_category_bug_msg($reporter_user_id, $p_bug_id ) );
          }
          break;
        case 'VIEW_STATUS':
          if ( ON == plugin_config_get( 'send_mes_up_view' ) ) {
            $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
            send_msg( get_xmpp_login( $reporter_user_id ), gen_up_view_status_bug_msg($reporter_user_id, $p_bug_id ) );
          }
          break;
      }
    }
  }

  /**
   * Change xmpp login.
   */
  function change_xmpp_login( $p_event ) {
    $xmpp_login_table = plugin_table( 'xmpp_login', 'JabberNotifierSystem' );
    $logon_user_id    = auth_get_current_user_id();
    $query_can_change = "SELECT chng_login FROM $xmpp_login_table WHERE user_id = $logon_user_id;";
    $res_can_change   = db_query( $query_can_change );

    while( $row = db_fetch_array( $res_can_change ) ) {
      $change = $row['chng_login'];
    }

    if ( ( ON == plugin_config_get( 'change_xmpp_login' ) ) && ( $change == 0 ) ) {
      if ( is_page_name( 'account_page.php' ) ) {
        print_change_xmpp_login();
      }
    }
  }

  /**
   * Send quick message.
   */
  function send_quick_msg( $p_event, $p_bug_id ) {
    if ( check_user_from_projects_table( $p_bug_id ) ) {
      if (ON == plugin_config_get( 'add_send_quick_msg' ) ) {
        $reporter_user_id = bug_get_field( $p_bug_id, 'reporter_id' );
        $quick_msg        = gpc_get_string( 'quick_msg', '' );
        print_quick_msg( $p_bug_id, $reporter_user_id );

        if ( $quick_msg != '' ) {
          send_quick_msg( get_xmpp_login( $reporter_user_id ), gen_quick_msg( $reporter_user_id, $p_bug_id, $quick_msg ), $p_bug_id );
        }
      }
    }
  }

  /**
   * Execute plugin schema at installation.
   */
  function schema() {
    return array(
        #31.05.2012
      array( 'CreateTableSQL', array( plugin_table( 'xmpp_login' ), "
        user_id I   NOTNULL ,
        xmpp_login  C(50)   NOTNULL ,
        chng_login  I   NOTNULL
        ")),
      array( 'CreateTableSQL', array( plugin_table( 'user_proj' ), "
        user_id I   NOTNULL ,
        proj_id C(250)  NOTNULL
        ")),
    );
  }
}
?>