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
               <!-- <div class="col-sm-3 sidenav">
                    <h4>Blog Site</h4>
                 
                    <li><a href="">Home</a></li>
                    <li><a href="">Become a Blogger</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Login</a></li>
                    <li><a href="">Hi</a></li>
                    </ul><br>
                </div>-->
               <!-- Sidebar/menu -->
               
               
               <div class="col-sm-3">
<nav class="w3-sidebar w3-bar-block w3-white w3-animate-left w3-text-grey w3-collapse w3-top w3-center" style="z-index:3;width:300px;font-weight:bold" id="mySidebar"><br>
  <h3 class="w3-padding-64 w3-center"><b>REALLY<br>COOL<br>BLOG</b></h3>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-hide-large">HOME</a>
  <a href="#" onclick="w3_close()" class="w3-bar-item w3-button">BECOME A BLOGGER</a> 
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT US</a> 
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">LOGIN</a>
  <h4>Copyright © Sonie 2017</h4>
</nav>
</div>
         
           <!-- <?php foreach (($blogPosts[1]?:[]) as $blog): ?>
       <li><?= $blog ?> </li> <?php endforeach; ?>-->
        
        <!-- where the containers go -->
        <div class="col-sm-9">
 <!--             <div class = "row">
  <!--              
             
         
           
                
                
                
            <!-- card! -->    
            <?php foreach (($bloggers?:[]) as $blogger): ?>
              
                <div class="col-sm-4">
                    <div class="container">
                    
                        <div class="avatar-flip"><img src="<?= $blogger[portrait] ?>" height="150" width="150">
  
  
                    </div>
                         <h2><?= $blogger[username] ?> </h2>

   
    
        
            <h4><?= $blogger[bio] ?> </h4><hr>
                        <?php foreach (($blogPosts?:[]) as $blogPost): ?>
                            <?php if ($blogPost[bloggerId] ==  $blogger[bloggerId]): ?>
 
            
            <p>Recent blog : <a href=""><?= $blogPost[title] ?> = <?= $blogPost[entry] ?> > Click to read more</a></p>
        
    <?php endif; ?>
  <p>
  </p>
  <?php endforeach; ?>
  
                     

                

</div>
</div>
<?php endforeach; ?><!-- card done!-->
            
            
            
            </div>          
            </div>
            </div>
            
            
            
            
            
        </div>
<!--            <div class="container">-->
          
            </div>
        </body>
    </html>