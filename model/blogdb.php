<?php
class BlogDB{
    
    /*
    CREATE TABLE BlogPosts (
       bloggerId INT(10),
       date DATE;
       title VARCHAR(30),
       entry VARCHAR(2000)
    
    );

    CREATE TABLE Bloggers (
       bloggerId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(20),
       email VARCHAR(50),
       password VARCHAR(100),
       portrait VARCHAR(255) DEFAULT 'https://d30womf5coomej.cloudfront.net/ua/defaultuser.png',
       bio VARCHAR(50)
    );
    */
    
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
        function addBlogger($username,$email,$password,$portrait,$bio)
        {
            $insert = 'INSERT INTO Bloggers (username,email,password,portrait,bio) VALUES (:username, :email, :password, :portrait, :bio)';
            
            $statement = $this->_pdo->prepare($insert);
            $statement->bindValue(':username', $username, PDO::PARAM_STR);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->bindValue(':password', $password, PDO::PARAM_STR);
            $statement->bindValue(':portrait', $portrait, PDO::PARAM_STR);
            $statement->bindValue(':bio', $bio, PDO::PARAM_STR);
           
            $statement->execute();
            
            //Return ID of inserted row
            return $this->_pdo->lastInsertId();
        }


        function addBlogPost($bloggerId, $date, $title, $entry)
        {
            $insert = 'INSERT INTO BlogPosts (bloggerId,date,title,entry) VALUES (:bloggerId, :date, :title, :entry)';
            
            $statement = $this->_pdo->prepare($insert);
            $statement->bindValue(':bloggerId', $bloggerId, PDO::PARAM_STR);
            $statement->bindValue(':date', $date, PDO::PARAM_STR);
            $statement->bindValue(':title', $title, PDO::PARAM_STR);
            $statement->bindValue(':entry', $entry, PDO::PARAM_STR);

            $statement->execute();
            
            //Return ID of inserted row
            return $this->_pdo->lastInsertId();
        }
        
/*
         * This function retrieves the most recent blog post per each blogger.
         */
        function recentBlogPosts()
        {
            $select = 'SELECT bloggerId, date, title, entry FROM BlogPosts ORDER BY date';
            $results = $this->_pdo->query($select);
             
            $resultsArray = array();
             
            //map each pet id to a row of data for that pet
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                $resultsArray[$row['bloggerId']] = $row;
            }     
            return $resultsArray;
        }
        
        
        function allBlogPosts()
        {
            $select = 'SELECT bloggerId, date, title, entry FROM BlogPosts';
            $results = $this->_pdo->query($select);
             
            $resultsArray = array();
             
            //map each pet id to a row of data for that pet
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                $resultsArray[] = $row;
            }     
            return $resultsArray;
        }
        
        function allBlogPostsByBlogger($bloggerId)
        {
            $select = 'SELECT bloggerId, date, title, entry FROM BlogPosts WHERE bloggerId:=bloggerId';
        $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':bloggerId', $bloggerId, PDO::PARAM_INT);
            $statement->execute();
             
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
        
        /**
         * This function retrieves all the bloggers from the database and returns an array that stores blogger. 
         */
        function allBloggers()
        {
            $select = 'SELECT bloggerId, username, email, portrait, bio FROM Bloggers';
            $results = $this->_pdo->query($select);
             
            $resultsArray = array();
             
            //map each pet id to a row of data for that pet
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                $resultsArray[$row['bloggerId']] = $row;
            }     
            return $resultsArray;
        }
        
        
        
        
        /**
         * This function gets the info by id. 
         */
        function bloggerById($bloggerId)
        {
            $select = 'SELECT bloggerId, username, email, portrait, bio FROM Bloggers WHERE bloggerId=:bloggerId';
    
            $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':bloggerId', $bloggerId, PDO::PARAM_INT);
            $statement->execute();
             
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
        function login($username, $password)
        {
            $select = 'SELECT bloggerId, username, email, portrait, bio FROM Bloggers WHERE username=:username && password=:password';
             $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':username', $username, PDO::PARAM_INT);
            $statement->bindValue(':password', $password, PDO::PARAM_INT);
            $statement->execute();
            
         
            return $statement->fetch(PDO::FETCH_ASSOC);
            
        }
        
        function deleteBlog($bloggerId,$title)
        {
            $delete = "DELETE FROM BlogPosts WHERE bloggerId:bloggerId && title:title";
            $statement = $this->_pdo->prepare($delete);
            $statement->bindValue(':bloggerId', $bloggerId, PDO::PARAM_INT);
            $statement->bindValue(':title', $title, PDO::PARAM_INT);
            $statement->execute();
        }
      

        
        
   
        
    }
?>