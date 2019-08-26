<?php

header("Content-type: text/php charset=utf-8");

/**
 * PDO connection CRUD example
 * @author Edson Melo de Souza
 * @date 2019-08
 * 
 * The update and delete methods do not include 
 * implementation to checking for record existence  
 */


# Include CRUD class
include('CRUDExample.php');

$pdo = new CRUDExample();

try {
    // Insert 2 records
    echo $pdo->insert('Name One', 20);
    echo "\n";
    echo $pdo->insert('Name Two', 15);
    
    echo "\n\nSelect record by key=1\n";
    print_r($pdo->select(1));
    
    echo "\n\nSelect all records";
    print_r($pdo->select_all());
    
    echo "\n\nUpdate record (key=1) to New Name\n";
    print_r($pdo->update(1, 'New Name'));
    
    echo "\n\nDelete record with key=1\n";
    print_r($pdo->delete(1));
    
} catch (PDOException $ex) {
    echo $ex;
}
