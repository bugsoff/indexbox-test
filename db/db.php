<?php

class Database
{
    private $db;

    protected function exec_query($sql)
    {
        if (($result =$this->db->query($sql))===false) {
            throw new Err($this->db->error.PHP_EOL.$sql);
        }	                                                                                            // если ошибка при выполнении запроса
        switch ((explode(" ", $sql, 2))[0]) {															// выберем первое слово до пробела, это команда
            case 'CREATE':
            case 'ALTER':
            case 'DROP':
                return $result;
            case 'SELECT':
                return $this->db->affected_rows?$result->fetch_all(MYSQLI_ASSOC):[];					// двумерный ассоциативный массив, либо пустой массив, если выбрано 0 строк
            default:
                return $this->db->affected_rows?(($this->db->insert_id)?:true):0;						// INSERT: id вставленной сроки; UPDATE/DELETE: true; или 0, если затронуто 0 строк
        }
    }
    
    public function __construct($server, $user, $pass, $dbname)
    {
        if ($server&&$user&&$pass&&$dbname) {
            if (!$this->db = mysqli_connect($server, $user, $pass, $dbname)) {
                throw new Err(mysqli_connect_error());
            }
            if (defined(__charset)) {
                $this->db->set_charset(__charset);
            }
            if (defined(__tz_offset)) {
                $this->db->query("SET TIME_ZONE='".__tz_offset."'");
            }
        } else {
            throw new Err(__METHOD__." DB is not specified!");
        }
    }

    public function clear($string)
    {
        return  $string!==false
                ?$this->db->escape_string($string)
                :false;
    }
}
