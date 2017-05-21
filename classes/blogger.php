<?php
class Blogger
    {
        private $bloggerId;
        private $username;
        private $email;
        private $password;
        private $portrait;
        private $bio;
        
        function __construct($bloggerId, $username, $email, $password, $portrait, $bio)
        {
        $this->bloggerId = $bloggerId;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->portrait = $portrait;
        $this->bio = $bio;
        }
    
        function getBloggerId()
        {
            return $this->bloggerId;        
        }
        
        function setUsername($username)
        {
            $this->username = $username;
        }
        
        function getUsername()
        {
            return $this->username;
        }
        
        function setEmail($email)
        {
            $this->email = $email;
        }
        
        function getEmail()
        {
            return $this->email;
        }
        
        function setPassword($password)
        {
            $this->password = $password;
        }
        
        function getPassword()
        {
            return $this->password;
        }
        
        function setPortrait($portrait)
        {
            $this->portrait = $portrait;
        }
        
        function getPortrait()
        {
            return $this->portrait;
        }
        
        function setBio($bio)
        {
            $this->bio = $bio;
        }
        
        function getBio()
        {
            return $this->bio;
        }
    }
        
        
?>