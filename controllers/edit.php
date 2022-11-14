<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/public/users.php');
    exit;
}

$user = getUserById($pdo, $_GET['id']);

editUser(
    $pdo,
    $_GET['id'],
    $_POST['name'],
    $_POST['position'],
    $_POST['phone'],
    $_POST['address']
);

setFlashMessage('success', 'Информация успешно обновлена.');
redirect('/public/users.php');
exit;
