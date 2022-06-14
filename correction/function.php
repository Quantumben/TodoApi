<?php
    class Todo{
        // Connection
         private $conn;
        
    
        // Table
        private $db_table = "todo";
        // Columns
        public $id;
        public $Title;
        public $Description;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
           
        }

     
        
        // GET ALL
        public function getTodo(){
            $Query = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($Query);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createTodo(){

            
            // $slQuery = "INSERT INTO ".$this->db_table." SET Title = :Title, Description = :Description";
            $slQuery = "INSERT INTO ' . $this->table . ' SET Title = :Title, Description = :Description ";

            $stmt = $this->conn->prepare($slQuery);
        
            // sanitize
            $this->Title=htmlspecialchars(strip_tags($this->Title));
            $this->Description=htmlspecialchars(strip_tags($this->Description));
            $this->id=htmlspecialchars(strip_tags($this->id));
  
        
            // bind data
            $stmt->bindParam(":Title", $this->Title);
            $stmt->bindParam(":Description", $this->Description);
            $stmt->bindParam(":id", $this->id);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleTodo(){
            $sqQuery = "SELECT * FROM ". $this->db_table ." WHERE id = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Title = $dataRow['Title'];
            $this->Description = $dataRow['Description'];
            
        }        
        // UPDATE
        public function updateTodo(){
            $sqlQuery = "UPDATE ". $this->db_table ." SET Title = :Title, Description = :Description WHERE id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Title=htmlspecialchars(strip_tags($this->Title));
            $this->Description=htmlspecialchars(strip_tags($this->Description));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":Title", $this->Title);
            $stmt->bindParam(":Description", $this->Description);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteTodo(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>