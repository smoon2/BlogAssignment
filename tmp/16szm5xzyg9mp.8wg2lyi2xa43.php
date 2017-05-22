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
                    <a href="registration" onclick="w3_close()" class="w3-bar-item w3-button">BECOME A BLOGGER</a> 
                    <a href="about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT US</a> 
                    <a href="login" onclick="w3_close()" class="w3-bar-item w3-button">LOGIN</a>
                <h4>Copyright © Sonie 2017</h4>
                </nav>
                </div>
               
               <div class="col-md-5">
                <div class="container-big">
               <?php foreach (($blogsArray?:[]) as $blog): ?>
                <h2><?= $blog[title] ?></h2><hr>
                <h3><?= $blog[entry] ?></h3><br>
               <?php endforeach; ?>
               
               
                
               
               
               
               
                 </div>
                </div>
                 <div class="col-md-4 pull-right">
                   <div class="container-big">
                    
                        <div class="avatar-flip"><img src="<?= $blogger->getPortrait() ?>" height="150" width="150"></div>
                        <h2>Bio : <?= $blogger->getBio() ?> </h2>
  
                    </div>