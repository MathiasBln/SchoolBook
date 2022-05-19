<!-- contenir la déconnexion  -->
<?php 
    //session_start(); // demarrage de la session
    //session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
    //header('Location:index.php'); // On redirige
    //die();


// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
header("Location: index.php");
exit;
?>