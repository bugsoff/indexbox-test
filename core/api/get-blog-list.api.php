<?php

include __root.DB."blog.db.php";
$DB = new BlogDB(__dbhost, __dbuser, __dbpass, __dbname);

exit(json_encode($DB->get_blog_list(
    [  'count'=>(int)($_REQUEST['count']??__blogs_count),
       'views_min' => (int)($_REQUEST['views_min']??0),
       'views_max' => (int)($_REQUEST['views_max']??PHP_INT_MAX),
       'product' => $DB->clear($_REQUEST['product']??false),
       'date_start' => strtotime($_REQUEST['date_start']??false),
       'date_end' => strtotime($_REQUEST['date_end']??false),
    ]
), JSON_NUMERIC_CHECK));
