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

function addUser(PDO $pdo, string $email, string $password, string $role): void
{
    $sql = 'INSERT INTO `users` (`email`, `password`, `role`) VALUES (:email, :password, :role)';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email' => $email,
        'password' => $password,
        'role' => $role
    ]);
}

function setFlashMessage($key, $message)
{
    $_SESSION[$key] = $message;
}

function displayFlashMessage($key)
{
    echo $_SESSION[$key];
    unset($_SESSION[$key]);
}

function redirect($path)
{
    header("Location: " . $path);
}

function getAllUsers(PDO $pdo)
{
    $sql = 'SELECT * FROM `users`';
    $statement = $pdo->query($sql);
    return $statement->fetchAll();
}

function prepareUserPhoto($file)
{
    $photo = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $photo);
    return $photo;
}
