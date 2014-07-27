<?
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.net                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
if($_GET[LOAD_GET_PAGE] != LOGIN_CMS_PAGE){
	require("engine/securelogin.class.php");
	$user_auth = new securelogin;
	$user_auth->handler['checklogin'] = 'uss_login_check';
	$user_auth->handler['encode'] = 'md5_encrypt';
	$user_auth->post_index = array(	'user' => 'uss_id' ,'pass' => 'uss_password' );
	$user_auth->use_cookie = false;
	$user_auth->use_session = true;
	if($user_auth->haslogin(true)){
		$user_auth->savelogin();
		$_SESSION['user_auth'] = '1';
		$_SESSION['user_auth_id'] = $user_auth->username;
	}else{
		$user_auth->clearlogin();
		unset($_SESSION['user_auth']);
		unset($_SESSION['user_auth_id']);
	}
}
/*
if($_GET[LOAD_GET_PAGE] == LOGOUT_CMS_PAGE){
	$user_auth->clearlogin();
	#header('Location: '.ROOT_INDEX.'');
	exit;
}
*/
?>