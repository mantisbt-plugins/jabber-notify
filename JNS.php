<?php
require_once( config_get_global( 'class_path' ) . 'MantisPlugin.class.php' );

class JNSPlugin extends MantisPlugin {

    static $conn = null;

    function register()
    {
        $this->name = plugin_lang_get( 'title' );
        $this->description = plugin_lang_get( 'description' );
        $this->page = 'config';

        $this->version = '1.0';
        $this->requires = array(
            'MantisCore' => '1.2.10',
        );

        $this->author = 'AcanthiS';
        $this->contact = 'acanthis@ya.ru';
    }

    function config() {
        return array(
            'xmpp_host'     => '127.0.0.1',
            'xmpp_port'     => '5222',
            'xmpp_user'     => 'support',
            'xmpp_pass'     => '',
            'xmpp_server'   => 'localhost',
            'xmpp_printlog' => false,
            'xmpp_loglevel' => 'none',
        );
    }

    function init() {
        require_once( 'XMPPHP/XMPP.php' );

        $conn = new XMPPHP_XMPP(
            plugin_config_get( 'xmpp_host' ),
            plugin_config_get( 'xmpp_port' ),
            plugin_config_get( 'xmpp_user' ),
            plugin_config_get( 'xmpp_pass' ),
            'mantisbt',
            plugin_config_get( 'xmpp_server' ),
            plugin_config_get( 'xmpp_printlog' ),
            0
        );
    }

    function hooks() {
        return array(
            'EVENT_BUGNOTE_ADD' => 'bugnote_add',
        );
    }

    function bugnote_add($bug_id, $bugnote_id) {

        $user_id = bug_get_field( $bug_id, 'reporter_id' );
        $user = user_get_name( $user_id );

        $msg = bugnote_get_text( $bugnote_id );

        $conn->connect();
        $conn->processUntil('session_start');
        $conn->message($user . '@' . plugin_config_get( 'xmpp_server' ), $msg);
        $conn->disconnect();
    }

//    function schema() {
//            return array(
//                array( 'CreateTableSQL', array( plugin_table( 'user_table' ), "
//                    id				I		NOTNULL UNSIGNED ZEROFILL AUTOINCREMENT PRIMARY,
//                    user_id			I		NOTNULL UNSIGNED ZEROFILL ,
//                    projects_id		T		NOTNULL,
//                    jabber_login	T		NOTNULL,
//                    jabber_pwd		T		NOTNULL,
//                    jabber_server	T		NOTNULL
//                    " ) ),
//            );
//        }

}
?>