<?php

include __root.DB."blog.db.php";
$DB = new BlogDB(__dbhost, __dbuser, __dbpass, __dbname);

if ($_REQUEST['href']??false) {
    if ($blog = $DB->get_blog($DB->clear($_REQUEST['href']))) {
        $DB->increase_views($blog['href']);
        exit(json_encode($blog, JSON_NUMERIC_CHECK));
    } else {
        echo "false";
    }
} else {
    echo "false";
}
