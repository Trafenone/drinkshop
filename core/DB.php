<?php

namespace core;

class DB
{
    public $pdo;

    public function __construct($host, $name, $login, $password)
    {
        $this->pdo = new \PDO(
            "mysql:host={$host};dbname={$name}",
            $login, $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]
        );
    }

    public function findOne($query, $params = []) : mixed
    {
        $sth = $this->pdo->prepare($query);
        $this->bindValues($sth, $params);
        $sth->execute();
        return $sth->fetch();
    }

    public function findMany($query, $params = []) : array | false
    {
        $sth = $this->pdo->prepare($query);
        $this->bindValues($sth, $params);
        $sth->execute();
        return $sth->fetchAll();
    }

    protected function where($where) : string
    {
        if (is_array($where)) {
            $parts = [];
            foreach ($where as $field => $value) {
                $parts[] = "{$field} = :{$field}";
            }
            $where_string = "WHERE " . implode(' AND ', $parts);
        } else {
            $where_string = is_string($where) ? "WHERE {$where}" : '';
        }

        return $where_string;
    }

    protected function bindValues($sth, $params) : void
    {
        foreach ($params as $key => $value) {
            $sth->bindValue(":{$key}", $value);
        }
    }

    public function select($table, $fields = '*', $where = null) : array | false
    {
        $fields_string = is_array($fields) ? implode(', ', $fields) : (is_string($fields) ? $fields : '*');
        $where_string = $this->where($where);

        $sql = "SELECT {$fields_string} FROM {$table} {$where_string}";
        $sth = $this->pdo->prepare($sql);

        if (is_array($where)) {
            $this->bindValues($sth, $where);
        }

        $sth->execute();
        return $sth->fetchAll();
    }

    public function insert($table, $row_to_insert) : int
    {
        $fields_list = implode(", ", array_keys($row_to_insert));
        $params_list = implode(', ', array_map(function ($key) {
            return ":{$key}";
        }, array_keys($row_to_insert)));

        $sql = "INSERT INTO {$table} ({$fields_list}) VALUES ({$params_list})";
        $sth = $this->pdo->prepare($sql);

        $this->bindValues($sth, $row_to_insert);
        $sth->execute();

        return $this->pdo->lastInsertId();
    }

    public function update($table, $row_to_update, $where) : int
    {
        $set_string = implode(', ', array_map(function ($key) {
            return "{$key} = :{$key}";
        }, array_keys($row_to_update)));
        $where_string = $this->where($where);

        $sql = "UPDATE {$table} SET {$set_string} {$where_string}";
        $sth = $this->pdo->prepare($sql);

        $this->bindValues($sth, array_merge($row_to_update, $where));
        $sth->execute();

        return $sth->rowCount();
    }

    public function delete($table, $where) : int
    {
        $where_string = $this->where($where);

        $sql = "DELETE FROM {$table} {$where_string}";
        $sth = $this->pdo->prepare($sql);

        if (is_array($where)) {
            $this->bindValues($sth, $where);
        }

        $sth->execute();

        return $sth->rowCount();
    }
}
