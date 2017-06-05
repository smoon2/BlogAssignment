<?php
class BlogPost {
    private $bloggerId;
    private $date;
    private $title;
    private $entry;
    
    function __construct($bloggerId, $date, $title, $entry)
    {
        $this->bloggerId = $bloggerId;
        $this->date = $date;
        $this->title = $title;
        $this->entry = $entry;
    }
    
    function setBloggerId($bloggerId)
    {
        $this->bloggerId = $bloggerId;
    }
    
    function getBloggerId()
    {
        return $this->bloggerId;    
    }
    
    function getDate()
    {
        return $this->date;
    }
    
    function setTitle()
    {
        $this->title = $title;
    }
    
    function getTitle()
    {
        return $this->title;
    }
    
    function setEntry()
    {
        $this->entry = $entry;
    }
    
    function getEntry()
    {
       return $this->entry; 
    }
    
}
?>