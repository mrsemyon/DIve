<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$data = getUserByEmail($pdo, $_POST['email']);

if (!empty($data) && password_verify($_POST['password'], $data['password'])) {
    $_SESSION['email'] = $data['email'];
    $_SESSION['role'] = $data['role'];
    setFlashMessage('success', 'Авторизация прошла успешно.');
    redirect('/public/users.php');
    exit;
}

setFlashMessage('danger', 'Неверно введен логин или пароль.');
redirect('/public/authorization.php');
exit;
