<?php


class DBConn
{
    protected $db_type;
    protected $db_server;
    protected $db_name;
    protected $db_user;
    protected $db_pass;

    /**
     * DBConn constructor.
     * @param $db_type
     * @param $db_server
     * @param $db_name
     * @param $db_user
     * @param $db_pass
     */
    public function __construct($db_type, $db_server, $db_name, $db_user, $db_pass)
    {

        $this->db_type = $db_type;
        $this->db_server = $db_server;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    public function connect()
    {
        try
        {
            $conn = new PDO(
                "$this->db_type:host=$this->db_server;dbname=$this->db_name",
                $this->db_user,
                $this->db_pass
            );
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo 'Connected successfully';
        }
        catch(PDOException $e)
        {
            die('Connection failed: ' . $e->getMessage());
        }

        return $conn;
    }

}