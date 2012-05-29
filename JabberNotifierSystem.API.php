<?php
	function send_message($juser, $msg) { 
		include ( 'XMPPHP/XMPP.php' );
		
		$jbr_server =  plugin_config_get( 'jbr_server' );
		$jbr_port   =  plugin_config_get( 'jbr_port' );
		$jbr_login  =  plugin_config_get( 'jbr_login' );
		$jbr_pwd    =  plugin_config_get( 'jbr_pwd' );
		
		$conn = new XMPPHP_XMPP($jbr_server, $jbr_port, $jbr_login, $jbr_pwd, 'xmpphp', 'acanthis' , $printlog=False, $loglevel='LOGGING_INFO');
		//$conn->useEncryption(false);        //Enable this line if you get a error «Fatal error: Cannot access protected property XMPPHP_XMPP::$use_encryption… »
		try
		{
			$conn->connect();
			$conn->processUntil('session_start');
			$conn->message('acanthis@192.168.0.254', $msg);
			$conn->disconnect();
		}
		catch(XMPPHP_Exception $e)
		{
			$e->getMessage();
		}
	}
?>