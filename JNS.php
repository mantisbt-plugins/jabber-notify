<?php
require_once( config_get_global( 'class_path' ) . 'MantisPlugin.class.php' );

class JNSPlugin extends MantisPlugin {

public function register()
{
// Название плагина
$this->name = plugin_lang_get('title');
// Описание плагина
$this->description = plugin_lang_get('description');
		$this->page        = 'config';
// Версия плагина
$this->version = '1.0';
// Требования для плагина
$this->requires = array(
	'MantisCore' => '1.2.10',
	);
// Информация о разработчике
$this->author = 'AcanthiS';
$this->contact = 'acanthis@ya.ru';
}


public function hooks() {
		return array(
			'EVENT_BUGNOTE_ADD' => 'bugnote_add',
		);
	}

function bugnote_add($bug_id, $bugnote_id) {
	plugin_file_path("XMPPHP/XMPP.php");

	$sent_msg = "test";
	$conn = new XMPPHP_XMPP('192.168.0.254' ,5222, 'info' ,0000 , 'xmpphp', 'nersisian' , $printlog=False, $loglevel='LOGGING_INFO');
	$conn->connect();
	$conn->processUntil('session_start');
	$conn->message('acanthis@192.168.0.254', $sent_msg);
	$conn->disconnect();
	}
    


function schema() {
		return array(
			array( 'CreateTableSQL', array( plugin_table( 'user_table' ), "
				id				I		NOTNULL UNSIGNED ZEROFILL AUTOINCREMENT PRIMARY,
				user_id			I		NOTNULL UNSIGNED ZEROFILL ,
				projects_id		T		NOTNULL,
				jabber_login	T		NOTNULL,
				jabber_pwd		T		NOTNULL,
				jabber_server	T		NOTNULL				
				" ) ),
		);
	}




}
?>