<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

session_destroy();

redirect('/public/authorization.php');
exit;
