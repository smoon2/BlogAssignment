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
			$bloggerObject = new Blogger($blogger[bloggerId], $blogger[username], $blogger[email], $blogger[portrait], $blogger[bio]);
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

    //Run fat free
    $f3->run();
    