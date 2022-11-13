<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect("/public/users.php");
    exit;
}

deleteUser($pdo, $_GET['id']);

if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

setFlashMessage('success', 'Пользователь успешно удалён.');

if ($user['email'] == $_SESSION['email']) {
    session_destroy();
    redirect("/public/authorization.php");
    exit;
}

redirect("/public/users.php");
exit;
