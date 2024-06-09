<?php 

class database 
{
    private $localhost = 'localhost';
    private $username  = 'root';
    private $password  = '';
    private $dbname    = 'company';
    private $conn;

    private $updatedSuccess = " Your Record Have Been Updated";
    private $deletedSuccess = " Your Record Have Been Deleted";

    public function __construct(){
        $this->conn = mysqli_connect($this->localhost,$this->username,$this->password,$this->dbname);

        if (!$this->conn) {
            die("Connection failed: ".mysqli_error($this->conn));
        }
    }

    public function insert($query){
        if (mysqli_query($this->conn, $query)){
            return "success";
        }else{
            die("error: ".mysqli_error($this->conn));
        }
    }

    public function read($table){
        $query = "SELECT * FROM $table" ;
        $result = mysqli_query($this->conn, $query);
        $data = [];
        if ($result ){
            if(mysqli_num_rows($result)){
                while ($row = mysqli_fetch_assoc($result)){
                    $data[] = $row;
                }
            }
            return $data;
        }else{
            die("Error: ".mysqli_error($this->conn));
        }
    }

    public function find($table,$id)
    {
        $id = filter_var($id,FILTER_VALIDATE_INT);
        $sql = "SELECT * FROM $table WHERE `id`='$id' LIMIT 1 ";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        { 
            if (mysqli_num_rows($result) > 0) 
            {
                return mysqli_fetch_assoc($result);
            }
            else 
            {
                return false;
            }
        }
        else 
        {
            return die("Error : ".mysqli_error($this->conn));
        }
    }

    public function update($sql)
    {
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        { 
            return $this->updatedSuccess;
        }
        else 
        {
            return die("Error : ".mysqli_error($this->conn));
        }
    }

    public function delete($table,$id)
    {
        $sql = "DELETE FROM $table WHERE `id`='$id' ";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        { 
            return $this->deletedSuccess;
        }
        else 
        {
            return die("Error : ".mysqli_error($this->conn));
        }
    }



    public function enc_password($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }


}