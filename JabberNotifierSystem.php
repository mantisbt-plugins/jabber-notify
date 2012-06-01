<?php
require_once( config_get_global( 'class_path' ) . 'MantisPlugin.class.php' );

class JabberNotifierSystemPlugin extends MantisPlugin {
  var $conn;

  function register() {
    $this->name        = plugin_lang_get( 'title' );
    $this->description = plugin_lang_get( 'description' );
    $this->page        = 'config';
    $this->version     = '1.0';
    $this->requires    = array(
        'MantisCore' => '1.2.0',
    );
    $this->author      = 'AcanthiS';
    $this->contact     = 'acanthis@ya.ru';
  }

  /**
   * Default plugin configuration.
   */
  function config() {
    return array(
      'jbr_server' => 'localhost',
      'jbr_port'   => '5222',
      'jbr_login'  => '',
      'jbr_pwd'    => '',
      'send_mes_new_resp'      => ON,
      'send_mes_new_bugnote'   => ON,
      'send_mes_new_state_10'  => ON,
      'send_mes_new_state_20'  => ON,
      'send_mes_new_state_30'  => ON,
      'send_mes_new_state_40'  => ON,
      'send_mes_new_state_50'  => ON,
      'send_mes_new_state_80'  => ON,
      'send_mes_new_state_90'  => ON,
    );
  }

  /**
   * Load the XMPP Class.
   */
  function init() {
    require_once ( plugin_file( './XMPPHP/XMPP.php' ) );
    $jbr_server =  plugin_config_get( 'jbr_server' );
    $jbr_port   =  plugin_config_get( 'jbr_port' );
    $jbr_login  =  plugin_config_get( 'jbr_login' );
    $jbr_pwd    =  plugin_config_get( 'jbr_pwd' );

    $this->conn = new XMPPHP_XMPP($jbr_server, $jbr_port, $jbr_login, $jbr_pwd, 'mantisbt', $jbr_server , $printlog=False, $loglevel='LOGGING_INFO');
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
        'EVENT_BUGNOTE_ADD' => 'bugnote_add',
    );
  }

  function bugnote_add($p_bug_id, $p_bugnote_id) {
    global $g_path;

    $user_id = bug_get_field( $p_bug_id, 'reporter_id' );
    $user_realname = user_get_realname( $user_id );
    $user_name = user_get_name( $user_id );

    $sent_msg = plugin_lang_get('bugnote_add_str1') . ' ' . $user_realname . '! ' . plugin_lang_get( 'bugnote_add_str2' ) . "\n" .
                plugin_lang_get('bugnote_add_str3') . ' ' . bug_format_id( $p_bug_id, 'category_id' ) . "\n" .
                plugin_lang_get('bugnote_add_str4') . ' ' . project_get_name( bug_get_field( $p_bug_id, 'project_id' ) ) . "\n" .
                plugin_lang_get('bugnote_add_str5') . ' ' . get_enum_element( 'status', ( bug_get_field( $p_bug_id, 'status' ) ) ) . "\n" .
                plugin_lang_get('bugnote_add_str6') . ' ' . bug_get_field( $p_bug_id, 'summary' ) . "\n" .
                plugin_lang_get('separator') . "\n" .
                plugin_lang_get('bugnote_add_str7') . ' ' . $user_realname . "\n" .
                plugin_lang_get('bugnote_add_str8') . ' ' . bugnote_get_text( $p_bugnote_id ) . "\n" .
                plugin_lang_get('separator') . "\n" .
                plugin_lang_get('bugnote_add_str9') . ' ' . string_get_bugnote_view_url_with_fqdn( $p_bug_id, $p_bugnote_id );

    //$conn->useEncryption(false);        //Enable this line if you get a error "Fatal error: Cannot access protected property XMPPHP_XMPP::$use_encryption"
    try
    {
      $this->conn->connect();
      $this->conn->processUntil('session_start');
      $this->conn->message($user_name .'@'. plugin_config_get( 'jbr_server' ), $sent_msg);
      $this->conn->disconnect();
    }
    catch(XMPPHP_Exception $e)
    {
      $e->getMessage();
    }
  }
}
?>