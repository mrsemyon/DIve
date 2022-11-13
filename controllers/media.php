<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав.');
    redirect("/public/users.php");
    exit;
}

if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

$photo = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

setUserPhoto($pdo, $_GET['id'], $photo);

setFlashMessage('success', 'Аватар успешно обновлён.');
redirect("/public/users.php");
exit;