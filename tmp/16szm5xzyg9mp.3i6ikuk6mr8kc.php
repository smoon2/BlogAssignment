<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width-device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
            <link href= "styles/style.css" rel="stylesheet" type="text/css">     
            <title>Blog</title>
        </head>
        
        <body>
           
            <div class="container-fluid">
                      <!-- Sidebar/menu -->
               <div class="col-sm-3">
                <nav class="w3-sidebar w3-bar-block w3-white w3-animate-left w3-text-grey w3-collapse w3-top w3-center" style="z-index:3;width:300px;font-weight:bold" id="mySidebar"><br>
                <h3 class="w3-padding-64 w3-center"><b>REALLY<br>COOL<br>BLOG</b></h3>
                    <a href="http://smoon.greenrivertech.net/328/BlogAssignment/" onclick="wc_close()" class="w3-bar-item w3-button">HOME</a>
                    <a href="registration" onclick="w3_close()" class="w3-bar-item w3-button">BECOME A BLOGGER</a> 
                    <a href="about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT US</a> 
                    <a href="login" onclick="w3_close()" class="w3-bar-item w3-button">LOGIN</a>
                <h4>Copyright © Sonie 2017</h4>
                </nav>
                </div>
			   
			   
			   
                <div class="container">
               <div class="col-sm-9">
               
                    <h2> Welcome Back! </h2>
                    <h3> Please Log in Below</h3>
                </div>
               </div>
                 <form action="./home2?bloggerId=<?= $login[bloggerId] ?>"  method="post" class="form-horizontal">
                <div class="container">
               <div class="col-sm-9">
                <br>
               <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-user"></span></div>
						<input type="text" class="form-control" required placeholder="Enter your username" name="username"></div>
              
               <br>
           
                <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span></div>
						<input type="password" class="form-control" required placeholder="Eter your password" name="password"></div>
              </div>
               
                
            
                <!-- REMEMBER ME + SIGNIN BUTTON-->
                <div id="remember" class="checkbox">
                    
                    <label>
                       <br> <input type="checkbox" name="rememberMe" value="remember-me"> Remember me
                    </label>
                </div>
               
                <div class="form-group">
                <div class="col-sm-12">
                  <button id="contacts-submit" type="submit" class="btn btn-default btn-info">Sign In</button></div>
                </div>

                
                             
            </form>
            

             
                </div>
               </div>
                
                
               </div>
               