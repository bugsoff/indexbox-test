<?php

class initDB extends Database
{
    public function __construct($server, $user, $pass, $dbname)
    {
        parent::__construct($server, $user, $pass, $dbname);
    }

    public function make_table($table_name, $table_structure)
    {
        if (!$table_name || !$table_structure) {
            throw Err("Table data is empty!");
        }
        $this->exec_query("DROP TABLE IF EXISTS `{$table_name}`");
        $sql = "CREATE TABLE `{$table_name}` (";
        foreach ($table_structure as $name =>$type) {
            $sql .= "`$name` $type NOT NULL, ";
        }
        $sql = substr($sql, 0, -2).", PRIMARY KEY(`href`)) ENGINE = InnoDB;";
        return $this->exec_query($sql);
    }

    public function load_data($table_name, $table_data)
    {
        if (!$table_name || !$table_data) {
            throw Err("Table data is empty!");
        }
        $columns='';
        foreach ($table_data['columns'] as $column =>$type) {
            $columns.=$column.', ';
        }
        $sql = "INSERT IGNORE INTO `$table_name` (".substr($columns, 0, -2).") VALUES ";
        foreach ($table_data['data'] as $record) {
            $row='';
            foreach ($table_data['columns'] as $col => $type) {
                $row.= "'".$this->clear($record[$col])."', ";
            }
            $sql .= "(".substr($row, 0, -2)."), ";
        }
        return $this->exec_query(substr($sql, 0, -2));
    }

    public function setIndexes()
    {
        return
            $this->exec_query("ALTER TABLE `products` ADD INDEX( `name`)") &&
            $this->exec_query("ALTER TABLE `blog` ADD INDEX( `views`)") &&
            $this->exec_query("ALTER TABLE `blog` ADD INDEX( `time_create`)") &&
            $this->exec_query("ALTER TABLE `blog` ADD FOREIGN KEY (`product`) REFERENCES `products` (`name`) ON DELETE RESTRICT ON UPDATE CASCADE");
    }
}
