<?php

function connectDPO($dbConnect)
{

    $host = 'localhost';
    $db   = $dbConnect;
    $user = 'bit_academy';
    $pass = 'bit_academy';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $pdo;
}


function addAddress($pdo, $pl, $str, $nr)
{
    // ADD adress
    $sql = "INSERT INTO woning (nummer, straat, plaats) VALUES ('$nr', '$str', '$pl')";
    $stmt = $pdo->prepare($sql)->execute();
    return $stmt;
}


function selectUser($pdo, $field, $table, $selectField, $selection)
{
    $sql = "SELECT $field FROM $table WHERE $selectField = '$selection'";
    $stmt = $pdo->query($sql)->fetch();
    return $stmt;
}



function addItem($pdo, $item, $Descr)
{
    // ADD item
    $sql = "INSERT INTO bucketlist (bucketlistName, bucketlistDescr, bucketlistValue) VALUES ('$item', '$Descr', 0)";
    $stmt = $pdo->prepare($sql)->execute();
    return $stmt;
}

function updateItem($pdo, $table, $field, $field2, $item, $waarde)
{
    // Update item value
    if (is_string($item)) {
        $sql = "UPDATE $table SET $field = $waarde WHERE $field2 = '$item'";
    } else {
        $sql = "UPDATE $table SET $field = $waarde WHERE $field2 = $item";
    }
    $stmt = $pdo->query($sql);
    return $stmt;
}

function selectItemlist($pdo)
{
    $sql = 'SELECT * FROM bucketlist ORDER BY bucketlistValue DESC';
    $result = $pdo->query($sql);
    return $result;
}

function selectValue($pdo, $field, $table, $fieldSelect, $id)
{
    if (is_string($id)) {
        $sql = "SELECT $field FROM $table WHERE $fieldSelect = '$id'";
    } else {
        $sql = "SELECT $field FROM $table WHERE $fieldSelect = $id";
    }
    $stmt = $pdo->query($sql);
    return $stmt;
}
