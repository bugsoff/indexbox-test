<?php

class BlogDB extends Database
{
    public function __construct($server, $user, $pass, $dbname)
    {
        parent::__construct($server, $user, $pass, $dbname);
    }

    public function get_pruducts_list()
    {
        return $this->exec_query("SELECT * FROM `products`");
    }

    public function get_blog_list($filters)
    {
        $limit = ($filters['count']??false)?"LIMIT ".$filters['count']:'';
        $vmin = ($filters['views_min']??false)?"`views`>=".$filters['views_min']:"true";
        $vmax = ($filters['views_max']??false)?"`views`<".$filters['views_max']:"true";
        $product = ($filters['product']??false)?"`product`='".$filters['product']."'":"true";
        $start = ($filters['date_start']??false)?"`time_create`>=".$filters['date_start']:"true";
        $end = ($filters['date_end']??false)?"`time_create`<".$filters['date_end']:"true";
        return $this->exec_query("SELECT * FROM `blog` WHERE $product AND $vmin AND $vmax AND $start AND $end ORDER BY `time_create` DESC $limit");
    }

    public function get_blog($href)
    {
        $data = $this->exec_query("SELECT * FROM `blog` WHERE `href`='$href'");
        return $data?$data[0]:$data;
    }

    public function update_blog($blog)
    {
        return $this->exec_query("UPDATE `blog` SET `href`='".$this->clear($blog['href'])."',
                                                    `title`='".$this->clear($blog['title'])."', 
                                                    `body`='".$this->clear($blog['body'])."', 
                                                    `description`='".$this->clear($blog['description'])."', 
                                                    `product`='".$this->clear($blog['product'])."', 
                                                    `views`='".$this->clear($blog['views'])."', 
                                                    `time_create`='".$this->clear($blog['time_create'])."', 
                                WHERE `product`='".$this->clear($blog['href'])."'");
    }

    public function increase_views($href)
    {
        return $this->exec_query("UPDATE `blog` SET `views`=`views`+1 WHERE `href`='".$this->clear($href)."'");
    }
}
