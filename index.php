<?php
    //Require the autoload file
    error_reporting('E_ALL');
    require_once('vendor/autoload.php');
    session_start();
    
    //Create an instance of the Base class
    $f3 = Base::instance();
	$f3->set('DEBUG', 3);
    $blogDB = new BlogDB();
    
    //Default route
    $f3->route('GET /', function($f3) {
        
        
        //$blogs = $blogDB->allBlogPosts();
        //$blogPost = new BlogPost(bloggerId, date, title, entry);
        //$f3->set("blogs", $blogs);
        //
        $blogsArray = array();
        $blogPosts = $GLOBALS['blogDB']->recentBlogPosts();
        foreach($blogPosts as $blogPost){
            //print_r($blogPost);
            //print_r($blogPost[entry]);
            $blogPostObject = new BlogPost($blogPost[bloggerId],$blogPost[date], $blogPost[title], $blogPost[entry]);
            $blogsArray[] = $blogPostObject;
            
             
            //$blogPost1 = new BlogPost($blogPost[1], $blogPost[2], $blogPost[3], $blogPost[4]);
            //print_r($blogPost1);
        }
    
        $f3->set('blogsArray', $blogsArray);
       
		
		
		$bloggersArray = array();
		$bloggers = $GLOBALS['blogDB']->allBloggers();
		foreach($bloggers as $blogger){
			$bloggerObject = new Blogger($blogger[bloggerId], $blogger[username], $blogger[email], $blogger[password], $blogger[portrait], $blogger[bio]);
			$bloggersArray[] = $bloggerObject;
		}
		$f3->set('bloggersArray', $bloggersArray);
		
		
		//Assign the members to an f3 variable
		$f3->set('blogPosts', $blogPosts);
        $f3->set('bloggers', $bloggers);
        
  

        
        //load a template
        echo Template::instance()->render('pages/home.html');
        
    });
	
	$f3->route('GET /about', function($f3) {
		echo Template::instance()->render('pages/about.html');
	});
    
    $f3->route('GET /login', function($f3) {
		echo Template::instance()->render('pages/login.html');
	});
	
	 $f3->route('GET /registration', function($f3) {
		echo Template::instance()->render('pages/registration.html');
	});
	 
	  $f3->route('POST /registration2', function($f3) {
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['email'] = $_POST['email'];
		if($_POST['password'] == $_POST['password2']){
			$_SESSION['password'] = $_POST['password'];
		}
		$_SESSION['bio'] = $_POST['bio'];
		$_SESSION['portrait'] = $_POST['portrait'];
		
		 $username = $_SESSION['username'];
         $email = $_SESSION['email'];
         $password = $_SESSION['password'];
         $bio = $_SESSION['bio'];
		 $portrait = $_SESSION['portrait'];

		$newBlogger = new Blogger("", $username, $email, $password, $portrait, $bio);
		$f3->set('username', $username);
		$_SESSION['newBlogger'] = $newBlogger;
		
		$GLOBALS['blogDB']->addBlogger($newBlogger->getUsername(), $newBlogger->getEmail(), $newBlogger->getPassword(),
													 $newBlogger->getPortrait(), $newBlogger->getBio());
		
		
		echo Template::instance()->render('pages/registration2.php');
		
	});
	    
    $f3->route('GET /view', function($f3) {
		echo Template::instance()->render('pages/view.html');
	});
	  
	 

    //Run fat free
    $f3->run();
    