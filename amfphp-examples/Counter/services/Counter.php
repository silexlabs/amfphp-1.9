<?php
// Wade Arnold: 1/6/2008
// Example is designed to show how to use PHP sessions. 
class Counter {

	public function __construct() {
		// Check if the session is available or create it. 
		if (!isset($_SESSION['count'])) {	
			$_SESSION['count'] = 0;
		}
	}
	// Used to increment the session variable count. 
    public function increment() {
		$_SESSION['count']++;
	return $_SESSION['count'];
	}
	// used to destroy the session variable and start over. 
	public function unregister() {
		unset($_SESSION['count']);
	return true;
	}
	// remove the entire session from the server. 
	public function destroy() {
		session_destroy();
	return true;
	}
}
?>