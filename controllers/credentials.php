<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав.');
    redirect('/public/users.php');
    exit;
}

if (empty($_POST['password']) && ($user['email'] == $_POST['email'])) {
    setFlashMessage('danger', 'Информация не была обновлена');
    redirect('/public/users.php');
    exit;
}

if (empty($_POST['email'])) {
    setFlashMessage('danger', 'Поле Email не может быть пустым.');
    redirect('/public/credentials.php?id=' . $user['id']);
    exit;
}
if (empty(getUserByEmail($pdo, $_POST['email']))) {
    updateEmail($pdo, $_GET['id'], $_POST['email']);
    if ($_SESSION['role'] != 'admin') {
        $_SESSION['email'] = $_POST['email'];
    }
    if (!empty($_POST['password'])) {
        updatePassword($pdo, $_GET['id'], password_hash($_POST['password'], PASSWORD_DEFAULT));
    }
    setFlashMessage('success', 'Регистрационные данные были обновлены.');
    redirect('/public/users.php');
    exit;
}
