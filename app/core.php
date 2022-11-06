<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/app/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/app/config.php';

$pdo = makePDOConnection($config);
