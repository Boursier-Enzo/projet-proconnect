<?php

function db_connect() : PDO {

    $options = [
        // Permet à PDO de lever des exceptions en cas d'erreur SQL
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    // dsn = "data source name"
    $dsn = "mysql:host=mysql;port=3306;dbname=app_archi;charset=utf8";

    try {
        // instance de la base de données (pdo)
        return new PDO($dsn, 'root', 'root', $options);
    } catch (PDOException $ex) {
        printf('La connexion à la base de données à échouer avec le code %s', $ex->getMessage());
        die();
    }
}

function get_data($table,$fields) : Array {
    $db = db_connect();

    // Requête SQL
    $sql = "SELECT ". implode(",",$fields??["*"]) ." FROM $table";
    // exécute la requête
    $postsStmt = $db->query($sql);
    // Récupère la liste de données
    $posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function search_data($table,$fields,$values=[]) : array | bool {
    $db = db_connect();

    // Requête SQL
    $sql = "SELECT ". implode(",",$fields??["*"]) ." FROM $table WHERE 1 = 1";
    foreach ($values as $key => $value) {
        $sql .= " AND $key = '$value'";
    }
    // exécute la requête
    $postsStmt = $db->query($sql);

    try {
        // Récupère la liste de données
        $posts = $postsStmt->fetch(PDO::FETCH_ASSOC);
        return $posts;
    } catch (\Throwable $th) {
        print_r($th);
        return FALSE;
    }
}


function create_data($table,$data) : bool {
    $db = db_connect();

    $sql = "INSERT INTO $table (". implode(",",array_keys($data??[])) . ") VALUES ('" . implode("','",array_values($data??[])) . "')";

    try {
        // exécute la requête
        $postsStmt = $db->query($sql);
        // Récupère la liste de données
        $posts = $postsStmt->fetch(PDO::FETCH_ASSOC);
        return TRUE;
    } catch (\Throwable $th) {
        print_r($th);
        return FALSE;
    }
}

?>