<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect("/public/users.php");
    exit;
}