<?php

/**
 * PDO connection CRUD example
 * @author Edson Melo de Souza
 * @date 2019-08
 * 
 * The update and delete methods do not include 
 * implementation for checking for record existence  
 */

# Include connection class
include('PDOConnection.php');


class CRUDExample {

    private static $pdo;

    /**
     * Constructor
     */
    function __construct() {
        self::$pdo = \PDOConnection::connection();
    }

    /**
     * Method to insert a record
     * @param String $name
     * @param int $age
     * @return string
     * @throws PDOException
     */
    function insert(String $name, int $age) {
        try {
            self::$pdo->beginTransaction();
            $sql = "INSERT INTO pdo_example (name, age) VALUES (:name, :age)";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(":name", $name, \PDO::PARAM_STR);
            $stmt->bindValue(":age", $age, \PDO::PARAM_INT);
            $stmt->execute();
            self::$pdo->commit();

            return (String) 'Operation (INSERT) successfully performed!';
        } catch (PDOException $ex) {
            self::$pdo->rollback();
            echo (String) $ex;
        }
    }

    /**
     * Method to select a record by key
     * @param int $key
     * @usage $obj->select(key)
     * @return an array containing all of the result set rows
     * @throws PDOException
     */
    function select(int $key) {
        try {
            (String) $sql = "SELECT * FROM pdo_example WHERE id=:key";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(":key", $key, \PDO::PARAM_INT);
            $stmt->execute();

            return (Array) $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    /**
     * Method to select all data
     * @usage $obj->select_all()
     * @return an array containing all of the result set rows
     */
    function select_all() {
        try {
            (String) $sql = "SELECT * FROM pdo_example";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute();

            return (Array) $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    /**
     * Method to update data
     * @param int $key
     * @param String $value
     * @usage $obj->update($key, $value)
     * @return an array containing all of the result set rows
     * @throws PDOException
     */
    function update(int $key, String $value) {
        try {
            self::$pdo->beginTransaction();
            $sql = "UPDATE pdo_example set name=:value WHERE id=:key";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(":key", $key, \PDO::PARAM_INT);
            $stmt->bindValue(":value", $value, \PDO::PARAM_STR);
            $stmt->execute();
            self::$pdo->commit();

            return (Array) $this->select($key);
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    /**
     * Method to delete a record
     * @param type $key
     * @usage $obj->delete($key)
     * @return type
     * @throws PDOException
     */
    function delete($key) {
        try {
            self::$pdo->beginTransaction();
            $sql = "DELETE FROM pdo_example WHERE id=:key";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(":key", $key, \PDO::PARAM_INT);
            $stmt->execute();
            self::$pdo->commit();

            return (Array) $this->select_all();
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

}
