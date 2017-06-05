<?php
    //Require the autoload file
    error_reporting('E_ALL');
    require_once('vendor/autoload.php');
    session_start();
    
    //Create an instance of the Base class
    $f3 = Base::instance();
	$f3->set('DEBUG', 3);
	//Instantiate the database class
    $blogDB = new BlogDB();
    
    //Default route
    $f3->route('GET /', function($f3) {
        
		//Create an array to store each recent blogpost per blogger
        $blogsArray = array();
		
		//Call the function to retrieve the array 
        $blogPosts = $GLOBALS['blogDB']->recentBlogPosts();
        foreach($blogPosts as $blogPost){
            //Instantiate blogpost class object for each array set and add it to blogsArray array
            $blogPostObject = new BlogPost($blogPost[bloggerId],$blogPost[date], $blogPost[title], $blogPost[entry]);
            $blogsArray[] = $blogPostObject;
			
        }
		
    
	
		
		//Create an array to store all the bloggers info
		$bloggersArray = array();
		
		//Call the function to retrieve the array from database
		$bloggers = $GLOBALS['blogDB']->allBloggers();
		
		//Instanatiate blogger class object for each blogger and add that to array created above.
		foreach($bloggers as $blogger){
			$bloggerObject = new Blogger($blogger[bloggerId], $blogger[username], $blogger[email], $blogger[password], $blogger[portrait], $blogger[bio]);
			$bloggersArray[] = $bloggerObject;
		}
		
			//set blogsarray and bloggers array. store them as session variables for future use.
        $f3->set('blogsArray', $blogsArray);
		$_SESSION['blogsArray'] = $blogsArray;
		
		$f3->set('bloggersArray', $bloggersArray);
		$_SESSION['bloggersArray'] = $bloggersArray;
		
        
        //load a template
        echo Template::instance()->render('pages/home.html');
        
    });
	
	
	//Routing to about page
	$f3->route('GET /about', function($f3) {
		echo Template::instance()->render('pages/about.html');
	});
	
	//Routing to aboutus page when logged in
	$f3->route('GET /aboutus2', function($f3) {
		echo Template::instance()->render('pages/aboutus2.html');
	});
    
	
    $f3->route('GET /login', function($f3) {
		
		//Retrieve username and password typed and store them into session variables
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
	
		//Call login function to look for username and password in the databaase
		$login = $GLOBALS['blogDB']->login($username, $password);
	
		$f3->set('bloggerId', $login[bloggerId]);
		
		//Loading a template
		echo Template::instance()->render('pages/login.html');
	});
	
	//This is home page when you're logged in 
	$f3->route('POST /home2', function($f3) {
		
		//Store the info into session variables
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
	
		//Call login function to look for username and password in the databaase
		$login = $GLOBALS['blogDB']->login($username, $password);
		$f3->set('login', $login);
		$f3->set('bloggerId', $login[bloggerId]);
		
		
		// Check if the array is empty - if it's empty then it means login
		// info wasn't found
		if(!empty($login[username])) {
		
			$_SESSION['bloggerId'] = $login['bloggerId'];
			$_SESSION['bio'] = $login['bio'];
			$_SESSION['portrait'] = $login['portrait'];
			
			//Set the arrays to the session variable arrays stored up at home page 
			$f3->set('blogsArray', $_SESSION['blogsArray']);
			$f3->set('bloggersArray', $_SESSION['bloggersArray']);
		} else{
			
			//reroute to login if the username or password weren't found
			$f3->reroute('login');
		}
			//load a template
			echo Template::instance()->render('pages/home2.html');
		
	});
	
	//route to create blog page
	$f3->route('GET /createBlogs', function($f3) {
		
		echo Template::instance()->render('pages/createBlogs.html');

	});
	
	//This is a page that handles create blog page above
	$f3->route('POST /createBlogs2', function($f3){
		
		//store the title and entry into session variables
		$_SESSION['title'] = $_POST['title'];
		$_SESSION['entry'] = $_POST['entry'];
		$title = $_SESSION['title'];
		$entry = $_SESSION['entry'];
		
		//today's date
		$date = date("Y-m-d");
		
		//call addblogpost to add the info into database
		$GLOBALS['blogDB']->addBlogPost($_SESSION['bloggerId'], $date, $title, $entry);
	
		//load a template
		echo Template::instance()->render('pages/createBlogs2.php');
	
	});
	
	//this is a page where a user can look at the table of blogposts and update or delete	
	$f3->route('GET /myBlogs', function($f3) {
			
			//Call the function to get all blogposts by that user with the bloggerId
			$blogsArray = $GLOBALS['blogDB']->allBlogPosts();
			
			
			//this array will store only the blogpost by that bloggerId
			$myBlogs = array();
			foreach($blogsArray as $blogpost) {
				if($blogpost[bloggerId] == $_SESSION['bloggerId']) {
					$myBlogs[] = $blogpost;
				}
			}
			
			//set the array to use into table
			$f3->set('myBlogs', $myBlogs);
			
			//call the session variables and set them 
			$bio = $_SESSION['bio'];
			$portrait = $_SESSION['portrait'];
			$f3->set('bio', $bio);
			$f3->set('portrait', $portrait);
			$f3->set('username', $_SESSION['username']);
			
			//load a template	
			echo Template::instance()->render('pages/myBlogs.html');

	});

	
	
	$f3->route('POST /validation', function($f3) {
			   
        $errors = array();
        
        //validating email 
       $email = $_POST["email"];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format"; 
}
    
        //checking if passwords match 
        if($_POST['password'] != $_POST['password2']){
            $errors['match'] = "Passwords don't match";
        }
        
    
    
    $password = $_POST['password'];
    echo $password;
     if (strlen($password) < '6') {
        $errors['6char'] = "Your Password Must Contain At Least 6 Characters!";
    }
    if(!preg_match("#[0-9]+#",$password)) {
        $errors['number'] = "Your Password Must Contain At Least 1 Number!"; 
    }
    if(!preg_match("/[\'^£$%&*()}{@#~?<>,|=_+!-]/", $password)){
        $errors['symbol'] = "Your Password Must Contain At Least One Symbol!";
    }

	
	//Validating that username isn't in use 
	$username = $_POST['username'];
	$validate = $GLOBALS['blogDB']->usernameInUse($username);
	echo $validate['username'];
	if(!empty($validate['username'])){
		$errors['usernameVal'] = "This username is already in use.";
		
	}
	else{
		
		
	}
	$_SESSION['confirmedPassword'] = $_POST['password'];
			$_SESSION['username'] = $_POST['username'];
		$_SESSION['email'] = $_POST['email'];
		
		$_SESSION['bio'] = $_POST['bio'];
		$_SESSION['portrait'] = $_POST['portrait'];
	//If there's errors then reroute back to form with error messages
    	if (sizeof($errors) > 0) {
                        //echo '<h3>Error!</h3><p>Please fix the following errors:</p>';
                        //
                        //echo '<ul>';
                        //foreach ($errors as $error) {
                        //    echo "<li>$error</li>";
                        //
                        //}
						$_SESSION['emailVal'] = $errors['email'];
						
						$_SESSION['numberVal'] = $errors['number'];
						$_SESSION['symbolVal'] = $errors['symbol'];
						$_SESSION['usernameVal'] = $errors['usernameVal'];
						$_SESSION['6char'] = $errors['6char'];
						echo $_SESSION['usernameVal'];
						$_SESSION['matchVal'] = $errors['match'];
						$rerouteCount = 1;
						$_SESSION['rerouteCount'] = $rerouteCount;
						
						
						//Sticky form
						
						$f3->reroute('registration');
		} else {
			//send it to registration2 
			
		
			$f3->reroute('registration2');
		}
		echo Template::instance()->render('pages/validation.php');
		
	});
	
	
	
	//this routes to registration page
	 $f3->route('GET /registration', function($f3) {
		
		if($_SESSION['rerouteCount'] == 1){
			$f3->set('usernameVal', $_SESSION['usernameVal']);
			$f3->set('charVal', $_SESSIION['6char']);
			$f3->set('symbolVal', $_SESSION['symbolVal']);
			$f3->set('emailVal', $_SESSION['emailVal']);
			
			$f3->set('numberVal', $_SESSION['numberVal']);
			$f3->set('matchVal', $_SESSION['matchVal']);	
		
		}
		
		$f3->set('username', $_SESSION['username']);
		$f3->set('email', $_SESSION['email']);
		$f3->set('bio', $_SESSION['bio']);
		
		echo Template::instance()->render('pages/registration.html');
		unset($_SESSION['usernameVal']);
		unset($_SESSION['6char']);
		unset($_SESSION['symbolVal']);
		unset($_SESSION['emailVal']);
		
		unset($_SESSION['numberVal']);
		unset($_SESSION['matchVal']);
		
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		unset($_SESSION['bio']);
	});
	 
	 //this handles the registration 
	  $f3->route('GET /registration2', function($f3) {
		
		//store all the info and instantiate a new blogger object 
		
		
		 $username = $_SESSION['username'];
         $email = $_SESSION['email'];
         $password = $_SESSION['confirmedPassword'];
         $bio = $_SESSION['bio'];
		 //strip out tags from bio
		 $bio = strip_tags($bio);
		 $portrait = $_SESSION['portrait'];

		$newBlogger = new Blogger("", $username, $email, $password, $portrait, $bio);
		$f3->set('username', $username);
		$_SESSION['newBlogger'] = $newBlogger;
		
		//call addblogger to add the info into database
		$GLOBALS['blogDB']->addBlogger($newBlogger->getUsername(), $newBlogger->getEmail(), $newBlogger->getPassword(),
													 $newBlogger->getPortrait(), $newBlogger->getBio());
		
		//load a template
		echo Template::instance()->render('pages/registration2.php');
		
	});

	//view page - this is what users see when they click on a certain blogger from home page 
    $f3->route('GET /view', function($f3) {
		       
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
			if($blogpost[bloggerId] == $id) {

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
		
        }
    
        $f3->set('recentBlog', $blogPostObject);
		
		//load a template
		echo Template::instance()->render('pages/view.html');
		
	});
	
	//this i s a page to updateblogs 
	$f3->route('GET /updateBlogs', function($f3) {
	
		//Grabbing our current title 
		$title = $_GET['title'];
		$_SESSION['title'] = $title;
			
		//call thee function to get the entry of current title 
		$oldEntry = $GLOBALS['blogDB']->selectBlog($_SESSION['bloggerId'], $_GET['title']);
		$f3->set('oldTitle', $title);
		$f3->set('oldEntry', $oldEntry['entry']);
			
		//load a template
		echo Template::instance()->render('pages/updateBlogs.html');
	});
	
	//this is what handles the page above
	$f3->route('POST /updateBlogs2', function($f3) {
	
		//retrieve the info tped 
			$_SESSION['newTitle'] = $_POST['newTitle'];
			$_SESSION['newEntry'] = $_POST['newEntry'];
			$newDate = date("Y-m-d");
		
			$f3->set('newTitle', $_POST['newTitle']);
			//$GLOBALS['blogDB']->updateBlog($_SESSION['bloggerId'], $_SESSION['oldTitle'], $_POST['newTitle'], $_POST['newEntry'], $newDate);
			
			//call delete blog and add blog. my updateblog function stopped working so im doing that for now
			$GLOBALS['blogDB']->deleteBlog($_SESSION['bloggerId'],$_SESSION['title']);
			$GLOBALS['blogDB']->addBlogPost($_SESSION['bloggerId'], $newDate, $_SESSION['newTitle'], $_SESSION['newEntry']);
			
			//load a template
		echo Template::instance()->render('pages/updateBlogs2.php');
	});
	
	
	//this is deleteblog page. 
	$f3->route('GET /deleteBlog', function($f3) {
			$title = $_GET['title'];
		    $GLOBALS['blogDB']->deleteBlog($_SESSION['bloggerId'],$title);
		
		//load a template
		echo Template::instance()->render('pages/deleteBlog.php');
	});	
	
		//this is what you see when you click on a blogpost from bloggers page
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
    