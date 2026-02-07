<?php
// If you were using sessions, you'd call session_destroy() here.
// Since you're not, logout just redirects to login page.

header("Location: login.html");
exit();
?>
