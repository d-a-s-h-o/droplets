<?php
function route(){
    global $config, $db;
    // get route from url
    $route = $_SERVER['REQUEST_URI'];
    // remove the root from the route
    $route = str_replace($config['root'], "", $route);
    // remove the query string from the route
    $route = explode("?", $route)[0];
    // remove the trailing slash from the route
    $route = rtrim($route, "/");
    // remove the leading slash from the route
    $route = ltrim($route, "/");
    // split the route into an array
    $route = explode("/", $route);
    // check if the route is empty
    if(empty($route[0])){
        index();
    }elseif($route[0]==='manage'){
        if((isset($_POST['droplet']) & isset($_POST['totp'])) || check_session()){
            if(check_session()){
                manage($_SESSION['droplet']);
            }else{
                manage(htmlspecialchars(htmlentities($_POST['droplet'])), htmlspecialchars(htmlentities(strval($_POST['totp']))));
            }
        }else{
            header("Location: /");
        }
    }elseif($route[0]==='admin'){
        // check if user is admin
        if(check_session()){
            if($_SESSION['admin'] === TRUE && $_SESSION['adminkey'] === $config['adminkey']){
                admin();
            }else{
                header("Location: /");
            }
        admin();
        }elseif($route[0]==='logout'){
            session_reset();
            session_destroy();
            header("Location: /");
        }else{
            header("Location: /");
        }
    }else{
        header("Location: /");
    }
}
?>