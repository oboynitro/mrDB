<?php


require_once('config.php');


class Connection
{
    public static function connect()
    {
        try
        {
            $conn = new PDO(
                DATABASE_TYPE.':host='.SERVER_NAME.';dbname='.DATABASE_NAME,
                USER_NAME,
                PASSWORD
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            die('Connection failed: ' . $e->getMessage());
        }
        return $conn;
    }

}