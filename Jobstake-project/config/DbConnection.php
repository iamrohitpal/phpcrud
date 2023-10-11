<?php
session_start();

class DbConnection
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = 'webkul';
    const DB_NAME = 'jobstake';

    public $dbConnect;

    public function __construct()
    {
        if (!isset($this->dbConnect)) { 
            try {
                $connection = new PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $this->dbConnect = $connection; 
            } catch(PDOException $e) { 
                die("Failed to connect with MySQL: " . $e->getMessage()); 
            } 
        }
    }

    public function insert($tableName, $data = [])
    {
        if (!empty($data) && is_array($data)) {
            $columns = '';
            $values  = '';
            $i = 0;
            if (!array_key_exists('posted_on', $data)) {
                $data['posted_on'] = date("Y-m-d H:i:s");
            }
            $columnString = implode(',', array_keys($data));
            $valueString = ":" . implode(',:', array_keys($data));
            $sql = "INSERT INTO " . $tableName . " (" . $columnString . ") VALUES (" . $valueString . ")";
            $query = $this->dbConnect->prepare($sql);
            foreach ($data as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
            $insert = $query->execute();
            return $insert ? $this->dbConnect->lastInsertId() : false;
        } else {
            return false;
        }
    }

    public function update($tableName, $data = [], $conditions)
    {
        if (!empty($data) && is_array($data)) {
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $colvalSet .= $pre . $key . "='" . $val . "'";
                $i++;
            }
            if (!empty($conditions) && is_array($conditions)) {
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach ($conditions as $key => $value) {
                    $pre = ($i > 0) ? ' AND ' : '';
                    $whereSql .= $pre . $key . " = '" . $value . "'";
                    $i++;
                }
            }
            $sql = "UPDATE " . $tableName . " SET " . $colvalSet . $whereSql;
            $query = $this->dbConnect->prepare($sql);
            $update = $query->execute();
            return $update ? $query->rowCount() : false;
        }else{ 
            return false; 
        } 
    }

    public function getData($tableName, $conditions)
    {
        $sql = 'SELECT ';
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $tableName;
        if (array_key_exists("where", $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }

        if (array_key_exists("order_by", $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by'];
        }
         
        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['limit'];
        }

        $query = $this->dbConnect->prepare($sql);
        $query->execute();

        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) { 
                case 'count': 
                    $data = $query->rowCount(); 
                    break; 
                case 'single': 
                    $data = $query->fetch(PDO::FETCH_ASSOC); 
                    break; 
                default: 
                    $data = ''; 
            } 
        } else { 
            if ($query->rowCount() > 0) { 
                $data = $query->fetchAll(); 
            } 
        } 
        return !empty($data) ? $data : false; 
    }
}