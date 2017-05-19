<?php
class BlogDB{
    
    
     CREATE TABLE BlogPosts (
    bloggerId INT(10),
    date DATE;
    title VARCHAR(30),
    entry VARCHAR(500)
    
    );

 CREATE TABLE bloggers (
    bloggerId INT(10),
    username VARCHAR(20),
    email VARCHAR(50),
    portrait VARCHAR(200),
    bio VARCHAR(50)
    );
    
    
    
    
    private $_pdo;
        
        function __construct()
        {
            //Require configuration
            require_once '/home/smoon/config.php';
            
            
            try {
                //Establish database connection
                $this->_pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
                
                //keep the connection open for reuse
                $this->_pdo->setAttribute( PDO::ATTR_PERSISTENT, true);
                
                //Throw an exception whenever a database error occurs
                $this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            }
            catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        /**
         * Adds a new member in the DB
         *
         */
        function addMember($fname, $lname, $age, $gender, $email, $phone, $state, $seeking, $biography, $interests, $premium)
        {
            $insert = 'INSERT INTO Members (fname, lname, age, gender, email, phone, state, seeking,
            bio, interests, premium) VALUES (:fname, :lname, :age, :gender, :email, :phone, :state, :seeking, :biography, :interests, :premium)';
            
            $statement = $this->_pdo->prepare($insert);
            $statement->bindValue(':fname', $fname, PDO::PARAM_STR);
            $statement->bindValue(':lname', $lname, PDO::PARAM_STR);
            $statement->bindValue(':age', $age, PDO::PARAM_STR);
            $statement->bindValue(':gender', $gender, PDO::PARAM_STR);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->bindValue(':phone', $phone, PDO::PARAM_STR);
            $statement->bindValue(':state', $state, PDO::PARAM_STR);
            $statement->bindValue(':seeking', $seeking, PDO::PARAM_STR);
            $statement->bindValue(':biography', $biography, PDO::PARAM_STR);
            $statement->bindValue(':interests', $interests, PDO::PARAM_STR);
            $statement->bindValue(':premium', $premium, PDO::PARAM_STR);
            
            $statement->execute();
            
            //Return ID of inserted row
            return $this->_pdo->lastInsertId();
        }


/*
         * This function gets all member info
         */
        function allMembers()
        {
            $select = 'SELECT id, fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests FROM Members ORDER BY lname';
            $results = $this->_pdo->query($select);
            
             
            $resultsArray = array();
             
            //map each pet id to a row of data for that pet
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                $resultsArray[$row['id']] = $row;
            }     
            return $resultsArray;
        }
        
        /**
         * This function gets the info by id. 
         */
        function memberById($id)
        {
            $select = 'SELECT id, fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests FROM Members WHERE id=:id';
    
            $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
             
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
    }
?>