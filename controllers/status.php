<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав.');
    redirect('/public/users.php');
    exit;
}

setUserStatus($pdo, $_GET['id'], $_POST['status']);

setFlashMessage('success', 'Информация успешно обновлена.');
redirect('/public/users.php');
exit;
