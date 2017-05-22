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
               
               <h2>Become a Blogger!</h2>
               <h3>Create a new account below</h3>
               </div>
    
                

                
                
               <!-- <div class="container">-->
              <form action="./registration2" id="registration"  method="post" class="form-horizontal">
  
                
                     <div class="col-md-2 control-group">
                <div class="container-big">
                    
                   <!-- <div class="container">
               <div class="col-sm-9">-->
                <br>
               <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-user"></span></div>
						<input type="text" class="form-control" required placeholder="Enter your username" name="username"></div>
              
               <br>
           
                <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-envelope"></span></div>
						<input type="text" class="form-control" required placeholder="Enter your email" name="email"></div>
              <br><hr>
               <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span></div>
						<input type="password" class="form-control" required placeholder="Enter your password" name="password"></div>
               <br>
                <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span></div>
						<input type="password" class="form-control" required placeholder="Verif: enter your password again" name="password2"></div>
               <br>
               
                

               
               
               
               <div class="form-group">
                <div class="col-sm-12">
                  <button id="contacts-submit" type="submit" class="btn btn-default btn-info">Sign In</button></div>
                </div>
    
                </div>
                     </div>
                     
                                    <!-- right element -->
                  <div class="col-md-2 control-group">
                <div class="container">
                            <h4>Upload your profile image! </h4>
                              <input type="file" name="portrait" accept="image/*"><br>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-comment"></span></div>                  
                    <textarea class="form-control" name="bio" id="bio" rows="5" style="width:99.9%" placeholder="Enter your bio here"></textarea>
                  </div>                                    
                </div>
                      </div><!-- -->
                
                

                    </div>
                
                </div>
                    
                </div>
                
            
                
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
              </form>
		</body>
	</html>
               