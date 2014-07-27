<?PHP
class securelogin {

	var $handler = array('setcookie' => false , 'header' => false,'encode' => false , 'checklogin' => false);
	var $use_auth = false;
	var $use_cookie = true;
	var $use_session = true;
	var $use_post = true;
	var $auth_text = "Secure title";
	var $expire = 3600;
	var $username = null;
	var $passhash = null;
	var $cookie_index = array('user' => 'auth_user' , 'pass' => 'auth_pass');
	var $post_index = array('user' => 'auth_user' , 'pass' => 'auth_pass');
	var $session_index = array('user' => 'auth_user' , 'pass' => 'auth_pass');
	function haslogin($check_login=false) {
		
		
		if (!isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['HTTP_AUTHORIZATION']) && $this->use_auth) {
			list($user, $pw) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6))); 
			$_SERVER['PHP_AUTH_USER'] = $user;
			$_SERVER['PHP_AUTH_PW'] = $pw;
			
			

		}
		if ($this->use_auth && isset($_SERVER['PHP_AUTH_USER']) && trim($_SERVER['PHP_AUTH_USER']) != "") {
			$this->username = $_SERVER['PHP_AUTH_USER'];
			$this->passhash = $this->_encode(@$_SERVER['PHP_AUTH_PW']);
			$this->username = $this->_stripslashes($this->username);
			$this->passhash = $this->_stripslashes($this->passhash);
			

		} else if ($this->use_auth == false && $this->use_post && isset($_POST[$this->post_index['user']]) && trim($_POST[$this->post_index['user']]) != "") {
			$this->username = $_POST[$this->post_index['user']];
			$this->passhash = $this->_encode(@$_POST[$this->post_index['pass']]);
			$this->username = $this->_stripslashes($this->username);
			$this->passhash = $this->_stripslashes($this->passhash); 
		} else if ($this->use_auth == false && $this->use_cookie && isset($_COOKIE[$this->cookie_index['user']]) && trim($_COOKIE[$this->cookie_index['user']]) != "") {
			$this->username = $_COOKIE[$this->cookie_index['user']];
			$this->passhash = @$_COOKIE[$this->cookie_index['pass']];
			
			$this->username = $this->_stripslashes($this->username);
			$this->passhash = $this->_stripslashes($this->passhash); //no need to encode cookie pass
		} else if ($this->use_auth == false && $this->use_session && isset($_SESSION[$this->session_index['user']])) {
			$this->username = $_SESSION[$this->session_index['user']];
			$this->passhash = @$_SESSION[$this->session_index['pass']];
			
		}
		if (!($this->username === null) && $check_login) return $this->checklogin($this->username , $this->passhash);
		
		return !($this->username === null);
	}
	function checklogin($user=null,$passhash=null) {
		
		if ($user === null) $user = $this->username;
		if ($passhash === null) $passhash = $this->passhash;
		if (isset($this->handler['checklogin'])) {
			return @call_user_func($this->handler['checklogin'],$user,$passhash);
		} else return false;
	}
	function savelogin() {
		if ($this->use_cookie) {
			/*
			$this->_setcookie($this->cookie_index['user'] , $this->username , time() + $this->expire);
			$this->_setcookie($this->cookie_index['pass'] , $this->passhash , time() + $this->expire);
			$this->_setcookie('user_auth_login' , '1' , time() + $this->expire);
			*/
			
			$this->_setcookie($this->cookie_index['user'] , $this->username,null);
			$this->_setcookie($this->cookie_index['pass'] , $this->passhash,null);
			$this->_setcookie('user_auth_login' , '1', null);
			
			
		}
		if ($this->use_session) {
			$_SESSION[$this->session_index['user']] = $this->username;
			$_SESSION[$this->session_index['pass']] = $this->passhash;
		}
	}

	function clearlogin() {
		if ($this->use_auth) {
			//there was a problem with clearing PHP_AUTH_USER  and PHP_AUTH_PW
			unset($_SERVER['PHP_AUTH_USER']);
			unset($_SERVER['PHP_AUTH_PW']);
		}
		if ($this->use_cookie) {
			$this->_setcookie($this->cookie_index['user'] , null , time() - $this->expire);
			$this->_setcookie($this->cookie_index['pass'] , null , time() - $this->expire);
			$this->_setcookie('user_auth_login' , null , time() - $this->expire);
			unset($_COOKIE[$this->cookie_index['user']]);
			unset($_COOKIE[$this->cookie_index['pass']]);
			unset($_COOKIE['user_auth_login']);
		}
		if ($this->use_session && isset($_SESSION)) {
			unset($_SESSION[$this->session_index['user']]);
			unset($_SESSION[$this->session_index['pass']]);
		}
	}
	function deny() {
		$this->_header('HTTP/1.0 404 Not Found');
		$this->_header('status: 404 Not Found');
	}
	function auth() {
		$this->_header('HTTP/1.0 401 Unauthorized');
		$this->_header('WWW-Authenticate: Basic realm="' . $this->auth_text . '"');
		$this->_header('status: 401 Unauthorized');
	}
	function _encode($string) {
		if ($this->handler['encode']) {
			return call_user_func($this->handler['encode'],$string);
		} else return md5($string);
	}
	function _setcookie($name,$var,$time,$path='',$domain='',$sec='') {
		if ($this->handler['setcookie']) {
			return @call_user_func($this->handler['setcookie'],$name,$var,$time,$path,$domain,$sec);
		} else return setcookie($name,$var,$time,$path,$domain,$sec);
	}
	function _header($text,$replace=false) {
		if ($this->handler['header']) {
			return @call_user_func($this->handler['header'],$text,$replace);
		} else return @header($text,$replace);
	}
	function _stripslashes($text) {
		if (get_magic_quotes_gpc()) $text = stripslashes($text);
		return $text;
	}
	
	
}

?>