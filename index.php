<?php
    //Require the autoload file
    error_reporting('E_ALL');
    require_once('vendor/autoload.php');
    session_start();
    
    //Create an instance of the Base class
    $f3 = Base::instance();
    
    //Default route
    $f3->route('GET /', function($f3) {
        $f3->set('username', 'Sonie');
        
        
        //$f3->set('username', 'jshmo');
        //$f3->set('password', sha1('Password01'));
        //$f3->set('title', 'Working with Templates');
        //$f3->set('temp', 68);
        //$f3->set('color', 'purple');
        //$f3->set('radius', 10);
        //$f3->set('bookmarks', array('http://www.google.com', 'http://www.leagueoflegends.com',
        //                            'http://www.facebook.com'));
        //$f3->set('addresses', array('primary' => '1003 S 308th, FederalWay, WA 98003',
        //                            'secondary' => '9532 100th Court, Kent, WA 98000'));
        //$f3->set('desserts', array('chocolate' => 'Chocolate Mousse', 'vanilla'=>'Vanilla Custard',
        //                           'strawberry' => 'Strawberry Shortcake'));
        //
        ////Conditional content
        //$f3->set('preferredCustomer', true);
        //$f3->set('lastLogin', strtotime('-1 week'));
        //
        ////objects
        //$pet = new Pet('Dexter', 'Orange');
        //$f3->set('myPet', $pet);
        

        
        //load a template
        echo Template::instance()->render('pages/home.html');
        
    });
    
    

    //Run fat free
    $f3->run();
    