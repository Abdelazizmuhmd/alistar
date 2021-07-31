<?php

function make_lang(){
    if(isset($_POST['ar'])){
        $_SESSION['arabic'] = true;
        unset($_SESSION['english']);
    }

     if(isset($_POST['en'])){
        $_SESSION['english'] = true;
        unset($_SESSION['arabic']);

    }
}

function lang_path(){
    if(!isset($_SEESION['english'])){
        $_SESSION['arabic'] = true;
    }




    if(isset( $_SESSION['arabic'] )){
        $lang = "arabic";
    }

    if(isset( $_SESSION['english'] )){
        $lang = "english";
    }

    $path=dirname(__FILE__)."/languages/".$lang.".php";
    //echo $path;
    return $path;
}

make_lang();
$language_file=lang_path();
include($language_file);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
 <form action="" method="POST">


            <input type="submit" name="en" value="English">
<input type="submit" name="ar" value="العربية">

    </form>
</body>
</html>