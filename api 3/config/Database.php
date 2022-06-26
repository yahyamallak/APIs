<?php


class Database {

    // DB Parameters

    private $hostname = "localhost";
    private $dbname = "quotes_api";
    private $username = "root";
    private $password = "";
    private $pdo;
    
    
    // Start Connection

    public function __construct(){
        $this->pdo = null;

        try {

            $this->pdo = new PDO("mysql:host=$this->hostname;dbname=$this->dbname;", $this->username, $this->password);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e){
            echo "Error : " . $e->getMessage();
        }
    }

    public function fetchAll($query){

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $rowCount = $stmt->rowCount();

        if($rowCount <= 0){
            return 0;
        } else {
            return $stmt->fetchAll();
        }

    }


    public function fetchOne($query, $parameter){

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([$parameter]);

        $rowCount = $stmt->rowCount();

        if($rowCount <= 0){
            return 0;
        } else {
            return $stmt->fetch();
        }

    }


    public function executeCall($username, $calls_allowed, $timeOutSeconds){

        $query = "SELECT plan, calls_made, time_start, time_end
                  FROM users
                  WHERE username = '$username'
        
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$username]);
        $results = $stmt->fetch();

        // Variables needed

        // If it is timeout or equal to zero set to true

        $timeOut = (date(time()) - $results['time_start']) >= $timeOutSeconds || $results['time_start'] === 0;


        // Update calls made with respece to time out

        $query = "UPDATE users SET calls_made = ";
        $query .= $timeOut ? " 1, time_start = ". date(time())." , time_end = ". strtotime("+ $timeOutSeconds seconds") : " calls_made + 1";
        $query .= " WHERE username = ? ";


        // instead of fetching again using select all update variables 


        $results['call_made'] = $timeOut ? 1 : $calls_made + 1;
        $results['time_end'] = $timeOut ? strtotime("+ $timeOutSeconds seconds") : $results['time_end'];


        // Execute code with respect to plans

        if($results['plan'] === "unlimited"){

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$username]);

            return $results;

        } else {

            // if no time out and calls made is greater than calls allowed return -1

            if($timeOut === false && $results['calls_made'] >= $calls_allowed){
                return -1;
            } else {
                // Grant access
                $stmt = $this->pdo-prepare($query);

                $stmt->execute([$username]);

                return $results;
            }

        }

    }



    public function insertOne($query, $body, $user_id, $category_id, $date){

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$body, $category_id, $date, $id]);
    }

    public function updateOne($query, $body, $category_id, $date, $id){

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$body, $category_id, $date, $id]);
    }

    public function deleteOne($query, $id){

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }

    public function insertUser($query, $firstName, $lastName, $password, $username){

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$firstName, $lastName, $password, $username]);
    }


}










