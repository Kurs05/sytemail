<?php 

// MYSQL
class MyDB 
{
    var $dblogin = "root"; //ЛОГИН 
    var $dbpass = ""; // ПАРОЛЬ 
    var $db = "mysite"; // НАЗВАНИЕ БАЗЫ ДЛЯ САЙТА
    var $dbhost = "localhost";

    var $link;
    var $query;
    var $err;
    var $result;
    var $data;
    var $fetch;

    function connect() {
        $this->link = new mysqli('127.127.126.50', $this->dblogin, $this->dbpass, $this->db);
        
        if ($this->link->connect_error) {
            die('connect error (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
        }

        $this->link->set_charset("utf8");
    }

    function close() {
		if ($this->link) { // Проверка, открыто ли соединение
        $this->link->close();
        $this->link = null; // Устанавливаем значение в null после закрытия
		}
	}
	
    function run($query) {
        $this->query = $query;
        $this->result = $this->link->query($this->query);

        if ($this->link->error) {
            $this->err = $this->link->error;
        }
    }

    function row() {
        $this->data = $this->result->fetch_assoc();
    }

    function fetch() {
        while ($this->data = $this->result->fetch_assoc()) {
            $this->fetch = $this->data;
            return $this->fetch;
        }
    }

    function stop() {
        unset($this->data);
        unset($this->result);
        unset($this->fetch);
        unset($this->err);
        unset($this->query);
    }
}
