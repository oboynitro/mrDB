<?php

require_once 'Connection.php';


class DB
{

    /**
     * @param $table
     * fetch all data from the specified table
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public static function fetchAllRecords($table, $limit=null, $offset=null)
    {
        $conn = Connection::connect();
        try
        {
            if ($limit !== null)
            {
                if ($offset !== null)
                {
                    $sql = "SELECT * FROM $table LIMIT $limit OFFSET $offset";
                }
                else
                {
                    $sql = "SELECT * FROM $table LIMIT $limit";
                }

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
     * @param null $offset
     * @return array
     * fetch specific column data from the specified table
     */
    public static function fetchRecordsFromSpecificColumns($table, $columns, $limit=null, $offset=null)
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
                if ($offset !== null)
                {
                    $sql = "SELECT $cols FROM $table LIMIT $limit OFFSET $offset";
                }
                else
                {
                    $sql = "SELECT $cols FROM $table LIMIT $limit";
                }
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
     * @param $fieldname
     * @param $fieldvalue
     * @return array
     * fetch single record by id from the specified table
     */
    public static function fetchSingleRecord($table, $fieldname, $fieldvalue)
    {
        $conn = Connection::connect();
        try
        {
            $sql = "SELECT * FROM $table WHERE $fieldname=:val";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':val', $fieldvalue);
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
     * @param $fieldname
     * @param $fieldvalue
     * @return array
     * fetch single record by id with specific columns from the specified table
     */
    public static function fetchSingleRecordFromSpecificColumnsByID($table, $columns, $fieldname, $fieldvalue)
    {
        $conn = Connection::connect();
        $cols = implode(',', $columns);
        try
        {
            $sql = "SELECT $cols FROM $table WHERE $fieldname=:val";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':val', $fieldvalue);
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
     * @param $data
     * @return bool
     */
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


    /**
     * @param $table
     * @param $data
     * @param null $fieldname
     * @param null $fieldvalue
     * @return bool
     */
    public static function updateRecord($table, $data, $fieldname=null, $fieldvalue=null)
    {
        $conn = Connection::connect();
        $cols = '';
        foreach (array_keys($data) as $val)
        {
            $cols .= $val.'=?, ';
        }
        $qString = rtrim($cols, ', ');
        try
        {
            if ($fieldname !== null && $fieldvalue !== null)
            {
                $sql = "UPDATE $table SET $qString WHERE $fieldname=?";
                $stmt = $conn->prepare($sql);
                foreach (array_values($data) as $key => $val)
                {
                    $stmt->bindValue($key+1, $val);
                }
                $stmt->bindValue(count($data)+1, $fieldvalue);
            }
            else
            {
                $sql = "UPDATE $table SET $qString";
                $stmt = $conn->prepare($sql);
                foreach (array_values($data) as $key => $val)
                {
                    $stmt->bindValue($key+1, $val);
                }
            }
            return $stmt->execute();
        }
        catch (Exception $e)
        {
            die('Failed to update record');
        }
    }


    public static function deleteRecord($table, $fieldname, $fieldvalue)
    {
        $conn = Connection::connect();
        
    }
}