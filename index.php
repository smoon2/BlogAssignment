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
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
	
		$login = $GLOBALS['blogDB']->login($username, $password);
		$f3->set('login', $login);
		$f3->set('bloggerId', $login[bloggerId]);
		
		echo Template::instance()->render('pages/login.html');
	});
	
	$f3->route('POST /home2', function($f3) {
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
	
		$login = $GLOBALS['blogDB']->login($username, $password);
		$f3->set('login', $login);
		$f3->set('bloggerId', $login[bloggerId]);
		
		
		// Check if the array is empty - if it's empty then it means login
		// info wasn't found
		if(!empty($login[username])){
		
			$_SESSION['bloggerId'] = $login['bloggerId'];
			$_SESSION['bio'] = $login['bio'];
			$_SESSION['portrait'] = $login['portrait'];
		}
		else{
			$f3->reroute('login');
		}
		
		
		
			echo Template::instance()->render('pages/home2.html');

		
		
	});
	
	$f3->route('GET /createBlogs', function($f3) {
		
		echo Template::instance()->render('pages/createBlogs.html');

	});
	
	$f3->route('POST /createBlogs2', function($f3){
		$_SESSION['title'] = $_POST['title'];
		$_SESSION['entry'] = $_POST['entry'];
		$title = $_SESSION['title'];
		$entry = $_SESSION['entry'];
		$date = date("Y-m-d");
		

		$GLOBALS['blogDB']->addBlogPost($_SESSION['bloggerId'], $date, $title, $entry);

		echo Template::instance()->render('pages/createBlogs2.php');
	});
	
		$f3->route('GET /myBlogs', function($f3) {
			
			//Call the function to get all blogposts by that user with the bloggerId
			$blogsArray = $GLOBALS['blogDB']->allBlogPosts();
			
			
			$myBlogs = array();
			foreach($blogsArray as $blogpost){
				if($blogpost[bloggerId] == $_SESSION['bloggerId']){
					$myBlogs[] = $blogpost;
				}
			}
			
			$f3->set('myBlogs', $myBlogs);
			
			$bio = $_SESSION['bio'];
			$portrait = $_SESSION['portrait'];
			$f3->set('bio', $bio);
			$f3->set('portrait', $portrait);
			$f3->set('username', $_SESSION['username']);
			
			
			
			
		echo Template::instance()->render('pages/myBlogs.html');

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
	
	$f3->route('GET /updateBlogs', function($f3) {

	
	
	
			//Grabbing our current title 
			$title = $_GET['title'];

			
			
			$oldEntry = $GLOBALS['blogDB']->selectBlog($_SESSION['bloggerId'], $_GET['title']);
			$f3->set('oldTitle', $title);
			$f3->set('oldEntry', $oldEntry['entry']);
			
		echo Template::instance()->render('pages/updateBlogs.html');
	});
	
	
		$f3->route('POST /updateBlogs2', function($f3) {
			print_r($_GET['newTitle']);
			$_SESSION['newTitle'] = $_GET['newTitle'];
			$_SESSION['newEntry'] = $_GET['newEntry'];
			$newDate = date("Y-m-d");
			print_r($_GET['newTitle']);
			print_r($_SESION['newTitle']);
			
			$f3->set('newTitle', $_GET['newTitle']);
			//$GLOBALS['blogDB']->updateBlog($_SESSION['bloggerId'], $_SESSION['oldTitle'], $_GET['newTitle'], $_GET['newEntry'], $newDate);
		
		echo Template::instance()->render('pages/updateBlogs2.php');
	});
	
	
	
	$f3->route('GET /deleteBlog', function($f3) {
			$title = $_GET['title'];
		    $GLOBALS['blogDB']->deleteBlog($_SESSION['bloggerId'],$title);
   
		
		echo Template::instance()->render('pages/deleteBlog.php');
	});	
	
		
	  $f3->route('GET /viewPost', function($f3) {
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
    