<?php

include __root.DB."blog.db.php";
$DB = new BlogDB(__dbhost, __dbuser, __dbpass, __dbname);


$data=[
    'title'=>"Main page Indexbox",
    'description'=>"Тестовое задание Indexbox",    
    'styles' => ["main.css"],
    'scripts' => ["main.js"],
    'products' => $DB->get_pruducts_list(),
];

include __root.GUI."gui.php";
include __root.GUI.PUB."main.gui.php";
include __root.GUI."page.gui.php";
?>

