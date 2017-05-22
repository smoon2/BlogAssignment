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
	    
    $f3->route('GET /view', function($f3, $id) {
		
		
		       
		$id = $_GET['bloggerId'];
		
		$f3->set('id', $id);
		
		$display = $GLOBALS['blogDB']->bloggerById($id);
		//print_r($display);

		//foreach($display as $each){
		//	$info = new Blogger($each[bloggerId], $each[username], $each[email], $each[password], $each[portrait], $each[bio]);
		//	print_r($info);
		//}
		//
		//foreach($display as $value){
		//	$blogger = new Blogger($value[0], $value[1], $value[2], $value[3], $value[4], $value[5]);
		//	print_r($blogger);
		//}
		
		$f3->set('display', $display);
		
		$blogger = new Blogger($display[bloggerId], $display[username], $display[email], $display[password], $display[portrait], $display[bio]);
		
		$f3->set('blogger', $blogger);
		
		
		
		//Calling allblogposts and only storing the ones that match the id to the array 
		$blogposts = $GLOBALS['blogDB']->allBlogPosts();
		
		$blogsArray = array();
		foreach($blogposts as $blogpost){
			if($blogpost[bloggerId] == $id){

				$blogsArray[] = $blogpost;
			}
			
		}
	
		$f3->set('blogsArray', $blogsArray);

		
		//Calling recent blog post
        $blogPosts = $GLOBALS['blogDB']->recentBlogPosts();
        foreach($blogPosts as $blogPost){
            //print_r($blogPost);
            //print_r($blogPost[entry]);
			if($blogPost[bloggerId] == $id){
				 $blogPostObject = new BlogPost($blogPost[bloggerId],$blogPost[date], $blogPost[title], $blogPost[entry]);

			}
			
           
                         
            //$blogPost1 = new BlogPost($blogPost[1], $blogPost[2], $blogPost[3], $blogPost[4]);
            //print_r($blogPost1);
        }
    
        $f3->set('recentBlog', $blogPostObject);
		
		
		
		echo Template::instance()->render('pages/view.html');
		
	});
	
	  $f3->route('GET /viewPost', function($f3, $id) {
		$id = $_GET['bloggerId'];
		
		$f3->set('id', $id);
				$blogposts = $GLOBALS['blogDB']->allBlogPosts();
		
		$blogsArray = array();
		foreach($blogposts as $blogpost){
			if($blogpost[bloggerId] == $id){

				$blogsArray[] = $blogpost;
			}
			
		}
	
		$f3->set('blogsArray', $blogsArray);

		
		echo Template::instance()->render('pages/viewPost.html');
	  });
	  
	 

    //Run fat free
    $f3->run();
    