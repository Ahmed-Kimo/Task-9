<?php


class database {

  
    private $hostName = 'localhost' ; 
    private $userName = 'root' ; 
    private $password = '' ; 
    private $database = 'company' ;
    private $conn ;

    public function __construct(){
    
    $this->conn = mysqli_connect($this->hostName , $this->userName , $this->password , $this->database) ;
  if(!$this->conn){
      die('Connect Error :' . mysqli_connect_error() ) ;
  }


}

// insert data
public function insert($sql){

   if(mysqli_query($this->conn , $sql)){
    return "Added Successfully" ;
   }else{
    die("Error :" . mysqli_error($this->conn)) ;
   }

}

//incrypt password
public function enc_password($password){
    return sha1($password) ;
}


// read data
public function read($table){

$sql = " SELECT * FROM `$table` " ;
$result = mysqli_query($this->conn , $sql) ;
$data = [] ;

if($result){
   if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row ;
    }
   }
   return $data ;
}else{
    die("Error :" . mysqli_error($this->conn)) ;
}

}

// edit data
public function find($table , $id){

$sql = " SELECT * FROM `$table` WHERE `id` = $id " ;
$result = mysqli_query($this->conn , $sql) ;

if($result){
   if(mysqli_num_rows($result)){

     return mysqli_fetch_assoc($result) ;
      
    }
    return false ;
   } else {
    die("Error :" . mysqli_error($this->conn)) ;
}

}


// Update data
public function update($sql){

    if(mysqli_query($this->conn , $sql)){
     return "Updated Successfully" ;
    }else{
     die("Error :" . mysqli_error($this->conn)) ;
    }
 
 }


 // delete data
 public function delete($table , $id){

    $sql = " DELETE FROM $table WHERE `id` = $id " ;
    if(mysqli_query($this->conn , $sql)){
        return "Deleted Successfully" ;
       }else{
        die("Error :" . mysqli_error($this->conn)) ;
       }

 }


    }
  