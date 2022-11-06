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

function getUserByEmail(PDO $pdo, $email): array
{
    $sql = 'SELECT * FROM `users` WHERE `email` = :email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetchAll();
}
