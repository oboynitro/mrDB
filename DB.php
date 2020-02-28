<?php

require_once 'Connection.php';


class DB
{

    /**
     * @param $table
     * fetch all data from the specified table
     * @param null $limit
     * @return array
     */
    public static function fetchAllRecords($table, $limit=null)
    {
        $conn = Connection::connect();
        try
        {
            if ($limit !== null)
            {
                $sql = "SELECT * FROM $table LIMIT $limit";
                $stmt = $conn->query($sql);
            }
            else
            {
                $sql = "SELECT * FROM $table";
                $stmt = $conn->query($sql);
            }
            return $stmt->fetchAll();
        }
       catch (Exception $e)
       {
           die('Could not fetch data');
       }
    }


    /**
     * @param $table
     * @param $columns []
     * @param null $limit
     * @return array
     * fetch specific column data from the specified table
     */
    public static function fetchRecordsFromSpecificColumns($table, $columns, $limit=null)
    {
        $conn = Connection::connect();

        if (!count($columns))
        {
            die('no columns provided');
        }

        $cols = implode(',', $columns);
        try
        {
            if ($limit !== null)
            {
                $sql = "SELECT $cols FROM $table LIMIT $limit";
                $stmt = $conn->query($sql);
            }
            else
            {
                $sql = "SELECT $cols FROM $table";
                $stmt = $conn->query($sql);
            }
            return $stmt->fetchAll();
        }
        catch (Exception $e)
        {
            die('Could not insert data');
        }
    }


    /**
     * @param $table
     * @param $id
     * @return array
     * fetch single record by id from the specified table
     */
    public static function fetchSingleRecordByID($table, $id)
    {
        $conn = Connection::connect();
        try
        {
            $sql = "SELECT * FROM $table WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch (Exception $e)
        {
            die('Could not fetch data');
        }
    }


    /**
     * @param $table
     * @param $columns
     * @param $id
     * @return array
     * fetch single record by id with specific columns from the specified table
     */
    public static function fetchSingleRecordFromSpecificColumnsByID($table, $columns, $id)
    {
        $conn = Connection::connect();
        $cols = implode(',', $columns);
        try
        {
            $sql = "SELECT $cols FROM $table WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch (Exception $e)
        {
            die('Could not fetch data');
        }
    }



    public static function insertRecord($table, $data)
    {
        $conn = Connection::connect();
        $cols = implode(',', array_keys($data));
        $valPlaceholder = implode(',', array_fill(0, count($data), '?'));
        $values = array_values($data);

        try
        {
            $sql = "INSERT INTO $table ($cols) VALUES ($valPlaceholder)";
            $stmt = $conn->prepare($sql);
            return $stmt->execute($values);
        }
        catch (Exception $e)
        {
            die('Failed to insert record');
        }
    }
}