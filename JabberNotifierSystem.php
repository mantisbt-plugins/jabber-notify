<?php
require_once( config_get_global( 'class_path' ) . 'MantisPlugin.class.php' );

class JabberNotifierSystemPlugin extends MantisPlugin {

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
      require_once ( 'XMPPHP/XMPP.php' );
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

  function bugnote_add($p_event, $p_bug_id, $p_bugnote_id) {
    global $g_path;
    $t_user_table = db_get_table( 'mantis_user_table' );
    $query = "SELECT username
              FROM $t_user_table
              WHERE id=". bug_get_field($p_bug_id, 'reporter_id');
    $res = mysql_query($query);

    while($row = mysql_fetch_array($res)) {
      $juser = $row['username'];
    }

    $sent_msg = plugin_lang_get('bugnote_add_str1') . ' ' . user_get_realname(bug_get_field($p_bug_id, 'reporter_id')) . '! ' . plugin_lang_get('bugnote_add_str2') . "\n" .
                plugin_lang_get('bugnote_add_str3') . ' ' . bug_format_id( $p_bug_id, 'category_id' ) . "\n" .
                plugin_lang_get('bugnote_add_str4') . ' ' . project_get_name(bug_get_field( $p_bug_id, 'project_id' )) . "\n" .
                plugin_lang_get('bugnote_add_str5') . ' ' . get_enum_element( 'status',(bug_get_field( $p_bug_id, 'status' ))) . "\n" .
                plugin_lang_get('bugnote_add_str6') . ' ' . bug_get_field( $p_bug_id, 'summary' ) . "\n" .
                plugin_lang_get('separator') . "\n" .
                plugin_lang_get('bugnote_add_str7') . ' ' . user_get_realname($p_user_id ) . "\n" .
                plugin_lang_get('bugnote_add_str8') . ' ' . bugnote_get_text($p_bugnote_id) . "\n" .
                plugin_lang_get('separator') . "\n" .
                plugin_lang_get('bugnote_add_str9') . ' ' . $g_path .'view.php?id=' . $p_bug_id . "#c" . $p_bugnote_id;

    $jbr_server =  plugin_config_get( 'jbr_server' );
    $jbr_port   =  plugin_config_get( 'jbr_port' );
    $jbr_login  =  plugin_config_get( 'jbr_login' );
    $jbr_pwd    =  plugin_config_get( 'jbr_pwd' );

    $conn = new XMPPHP_XMPP($jbr_server, $jbr_port, $jbr_login, $jbr_pwd, 'xmpphp', 'acanthis' , $printlog=False, $loglevel='LOGGING_INFO');
    //$conn->useEncryption(false);        //Enable this line if you get a error �Fatal error: Cannot access protected property XMPPHP_XMPP::$use_encryption� �
    try
    {
      $conn->connect();
      $conn->processUntil('session_start');
      $conn->message($juser .'@'. $jbr_server, $sent_msg);
      $conn->disconnect();
    }
    catch(XMPPHP_Exception $e)
    {
      $e->getMessage();
    }
  }
}
?>