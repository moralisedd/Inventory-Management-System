<?php
session_start();
session_unset();
session_destroy();
// Always land on login - no session cookie should persist.
header('Location: /pages/auth/login.php');
exit;
