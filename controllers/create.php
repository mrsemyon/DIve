<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

if ($_SESSION['role'] != 'admin') {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/public/users.php');
    exit;
}

if (!empty(getUserByEmail($pdo, $_POST['email']))) {
    setFlashMessage('danger', 'Этот эл. адрес уже занят другим пользователем.');
    redirect('/public/registration.php');
    exit;
}

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$photo = (!empty($_FILES['photo']['name']))
    ? prepareUserPhoto($_FILES['photo'])
    : 'no_photo.jpg';

$id = addUser($pdo, $_POST['email'], $password, 'user');

editUser($pdo, $id, $_POST['name'], $_POST['position'], $_POST['phone'], $_POST['address']);

setUserStatus($pdo, $id, $_POST['status']);

setUserPhoto($pdo, $id, $photo);

setSocialLinks($pdo, $id, $_POST['vk'], $_POST['tg'], $_POST['ig']);

setFlashMessage('success', 'Пользователь успешно добавлен!');
redirect('/public/users.php');
exit;
