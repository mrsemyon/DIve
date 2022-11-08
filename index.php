<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$statement = $pdo->query('select * from users;');
var_dump($statement->fetchAll());
