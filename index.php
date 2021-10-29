<?php

const CONFIG =  "config.php";
const CORE =    "core/";
const DB =      "db/";
const GUI =     "gui/";
const API =     "api/";
const PUB =     "pub/";
const DATA =    "data/";
const ROUTES=[
    "api"   =>CORE.API."api.php",
    ""      =>CORE.PUB."main.php",
];

$uri=explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);

if (file_exists($core =ROUTES[$uri[1]]??CORE.PUB.$uri[1].".php")) {
    try {
        include CORE."core.php";
        include DB."db.php";
        include $core;
    } catch (Err $err) {
        exit((__debug??false)?$err:"ERROR");
    }
} else {
    header("HTTP/1.1 404 Not Found", true, 404);
}
