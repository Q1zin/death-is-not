<?php

    require 'config.php';
    require 'login_chack/login_chack.php';

    if ($login_chack->login_in){
        $userId = $login_chack->get_id();
    } else {
        $userId = 0;
    }

    $data = mysqli_real_escape_string($connection ,$_GET['data']);
    $category = mysqli_real_escape_string($connection ,$_GET['category']);
    $harm_to_health = mysqli_real_escape_string($connection ,$_GET['harm_to_health']);
    $link_to_video = mysqli_real_escape_string($connection ,$_GET['link_to_video']);
    if ($link_to_video != ''){
        if ($preview = getYoutubeId($link_to_video)) {
            $ff = 0;
        } else {
            $preview = '';
        }
    } else {
        $preview = '';
    }
    
    $link_to_photo = mysqli_real_escape_string($connection ,$_GET['link_to_photo']);
    $name = mysqli_real_escape_string($connection ,$_GET['name']);
    $description = mysqli_real_escape_string($connection ,$_GET['description']);
    $number_of_victims = mysqli_real_escape_string($connection ,$_GET['number_of_victims']);
    $the_death_toll = mysqli_real_escape_string($connection ,$_GET['the_death_toll']);
    $road_accident_participants = mysqli_real_escape_string($connection ,$_GET['road_accident_participants']);
    $road_condition = mysqli_real_escape_string($connection ,$_GET['road_condition']);
    $visibility = mysqli_real_escape_string($connection ,$_GET['visibility']);
    $weather = mysqli_real_escape_string($connection ,$_GET['weather']);
    $cord_1 = mysqli_real_escape_string($connection ,$_GET['cord_1']);
    $cord_2 = mysqli_real_escape_string($connection ,$_GET['cord_2']);
    $address = mysqli_real_escape_string($connection ,$_GET['address']);

    function getYoutubeId($ytURL) 
    {
        $urlData = parse_url($ytURL);
        //echo '<br>'.$urlData["host"].'<br>';
        if($urlData["host"] == 'www.youtube.com') // Check for valid youtube url
        {
            $ytvIDlen = 11; // This is the length of YouTube's video IDs

            // The ID string starts after "v=", which is usually right after 
            // "youtube.com/watch?" in the URL
            $idStarts = strpos($ytURL, "?v=");

            // In case the "v=" is NOT right after the "?" (not likely, but I like to keep my 
            // bases covered), it will be after an "&":
            if($idStarts === FALSE)
                $idStarts = strpos($ytURL, "&v=");
            // If still FALSE, URL doesn't have a vid ID
            if($idStarts === FALSE)
                die("YouTube video ID not found. Please double-check your URL.");

            // Offset the start location to match the beginning of the ID string
            $idStarts +=3;

            // Get the ID string and return it
            $ytvID = substr($ytURL, $idStarts, $ytvIDlen);

            return $ytvID;
        }
        else
        {
            //echo 'This is not a valid youtube video url. Please, give a valid url...';
            return 0;
        }

    } 

    $sqlQuery = "INSERT INTO `dtb`(`data`,`id_added`,`category`,`harm_to_health`,`link_to_video`,`preview`,`link_to_photo`,`name`,`description`,`number_of_victims`,`the_death_toll`,`road_accident_participants`,`road_condition`,`visibility`,`weather`,`cord_1`,`cord_2`,`address`) VALUES ('$data','$userId','$category','$harm_to_health','$link_to_video','$preview','$link_to_photo','$name','$description','$number_of_victims','$the_death_toll','$road_accident_participants','$road_condition','$visibility','$weather','$cord_1','$cord_2','$address')";
    
    if (mysqli_query($connection, $sqlQuery)){
        echo true;
    } else {
        echo false;
    }