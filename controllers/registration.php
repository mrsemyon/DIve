<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

if (!empty(getUserByEmail($pdo, $_POST['email']))) {
    setFlashMessage('danger', 'Этот эл. адрес уже занят другим пользователем.');
    redirect('/public/registration.php');
    exit;
}

$role = 'user';
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

addUser($pdo, $_POST['email'], $password, $role);

$_SESSION['email'] = $_POST['email'];
$_SESSION['role'] = $role;

setFlashMessage('success', 'Регистрация прошла успешно.');
redirect('/public/users.php');
exit;
