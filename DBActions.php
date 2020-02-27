<?php

require_once 'DBConn.php';
require_once 'Functions.php';


class DBActions
{

    /**
     * @param $table
     * fetch all data from the specified table
     * @param null $limit
     * @return array
     */
    public static function fetchAllRecords($table, $limit=null)
    {
        $conn = DBConn::connect();
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
            die('Error '. $e->getMessage());
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
        $conn = DBConn::connect();

        if (!count($columns))
        {
            die('no columns provided');
        }

        $cols = Functions::reduceColumns($columns);
        print_r($cols);

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
            die('Error '. $e->getMessage());
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
        $conn = DBConn::connect();
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
            die('Error '. $e->getMessage());
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
        $conn = DBConn::connect();
        $cols = Functions::reduceColumns($columns);
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
            die('Error '. $e->getMessage());
        }
    }
}