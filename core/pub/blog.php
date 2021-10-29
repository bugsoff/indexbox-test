<?php

$data=[
    'title'=>"Blog",
    'description'=>"Тестовое задание Indexbox",
    'styles' => ["/blog.css"],
    'scripts' => ["/blog.js"],
];

include __root.GUI."gui.php";
include __root.GUI.PUB."blog.gui.php";
include __root.GUI."page.gui.php";
