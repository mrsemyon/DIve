<?php

function makePDOConnection(array $config): PDO
{
    return new PDO(
        "mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset={$config['db']['charset']}",
        $config['db']['user'],
        $config['db']['password'],
        $config['db']['opt']
    );
}

function getUserByEmail(PDO $pdo, string $email)
{
    $sql = 'SELECT * FROM `users` WHERE `email` = :email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetch();
}

function addUser(PDO $pdo, string $email, string $password, string $role)
{
    $sql = 'INSERT INTO `users` (`email`, `password`, `role`) VALUES (:email, :password, :role)';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email' => $email,
        'password' => $password,
        'role' => $role
    ]);
    return $pdo->lastInsertId();
}

function setFlashMessage(string $key, string $message): void
{
    $_SESSION[$key] = $message;
}

function displayFlashMessage(string $key): void
{
    echo $_SESSION[$key];
    unset($_SESSION[$key]);
}

function redirect(string $path): void
{
    header("Location: " . $path);
}

function getAllUsers(PDO $pdo)
{
    $sql = 'SELECT * FROM `users`';
    $statement = $pdo->query($sql);
    return $statement->fetchAll();
}

function prepareUserPhoto(string $file)
{
    $photo = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $photo);
    return $photo;
}

function editUser(PDO $pdo, string $id, string $name, string $position, string $phone, string $address): void
{
    $sql = 'UPDATE `users` SET `name` = :name, `position` = :position, `phone` = :phone, `address` = :address WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'id' => $id,
        'name' => $name,
        'position' => $position,
        'phone' => $phone,
        'address' => $address
    ]);
}

function setUserStatus(PDO $pdo, string $id, string $status): void
{
    $sql = 'UPDATE `users` SET `status` = :status WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id, 'status' => $status]);
}

function setUserPhoto(PDO $pdo, string $id, string $photo): void
{
    $sql = 'UPDATE `users` SET `photo` = :photo WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id, 'photo' => $photo]);
}

function setSocialLinks(PDO $pdo, string $id, string $vk, string $tg, string $ig): void
{
    $sql = 'UPDATE `users` SET `vk` = :vk, `tg` = :tg, `ig` = :ig WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'id' => $id,
        'vk' => $vk,
        'tg' => $tg,
        'ig' => $ig
    ]);
}

function getUserById(PDO $pdo, string $id)
{
    $sql = 'SELECT * FROM `users` WHERE `id` = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    return $statement->fetch();
}

function updatePassword(PDO $pdo, string $id, string $password): void
{
    $sql = 'UPDATE `users` SET `password` = :password WHERE `id` = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id, 'password' => $password]);
}

function updateEmail(PDO $pdo, string $id, string $email): void
{
    $sql = 'UPDATE `users` SET `email` = :email WHERE `id` = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id, 'email' => $email]);
}

function deleteUser(PDO $pdo, string $id): void
{
    $sql = 'DELETE FROM `users` WHERE `id` = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
}
