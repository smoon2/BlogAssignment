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
                    <a href="" onclick="wc_close()" class="w3-bar-item w3-button">HOME</a>
                    <a href="myBlogs" onclick="w3_close()" class="w3-bar-item w3-button">MY BLOGS</a>
                      <a href="createBlogs" onclick="w3_close()" class="w3-bar-item w3-button">CREATE BLOGS</a> 
                    <a href="about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT US</a> 
                    <a href="http://smoon.greenrivertech.net/328/BlogAssignment/" onclick="logoutDisplay()" class="w3-bar-item w3-button">LOGOUT</a>
                    
                    <script>
                    function logoutDisplay() {
                        alert("You have been logged out successfully.");
                    }
                    </script>
                    
                <h4>Copyright © Sonie 2017</h4>
                </nav>
                </div>
               
                  <form action="./createBlogs2" id="createBlogs"  method="post" class="form-horizontal">
                             <div class="col-md-4">
                <div class="container-big">
               <h2><br>What's on your mind?  </h2><hr>
                 <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-pencil"></span></div>
						<input type="text" class="form-control" required placeholder="Enter your title" name="title"></div><br>
                 <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-comment"></span></div>                  
                    <textarea class="form-control" name="entry" id="entry" rows="5" style="width:99.9%" required placeholder="Enter your entry here"></textarea>
                  </div><br>
                   <div class="form-group">
                <div class="col-sm-12">
                  <button id="contacts-submit" type="submit" class="btn btn-default btn-info">Submit</button></div><br>
                </div>
                 
                
                 
                </div>
                
                
  </form>
        </body>
    </html>