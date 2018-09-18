<?php

namespace core\DB;

class Model
{
    use Password;

    private $db;
    private $where = '';
    public $table;
    public $fillable = array();
    protected static $instance;

    public function __construct()
    {
        $this->db = DBConnector::getInstance();
    }

    /**
     *  Выбираем все элементы с таблицы
     *
     * @return array
     */
    public function getAll()
    {
        DBConnector::setCharsetEncoding();
        $stm = $this->db->prepare("SELECT * FROM " . $this->table);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *  Записывам в базу новые данные
     *
     * @return bool|string
     */
    public function insert()
    {
        DBConnector::setCharsetEncoding();
        $stm = $this->db->prepare("INSERT INTO " . $this->table . " 
                                            (" . $this->getColumns() . ")
                                    VALUES (" . $this->getValues() . ") ");
        $stm->execute();
        return true;
    }

    /**
     *  Обновляем данные в базе
     *
     * @return bool
     */
    public function update()
    {
        DBConnector::setCharsetEncoding();
        $stm = $this->db->prepare("UPDATE " . $this->table . " 
                                     SET " . $this->getUpdateValue() . "
                                     WHERE " . $this->where . " ");
        $stm->execute();
        return true;
    }

    /**
     *  Выбираем данные с базы по параметрам
     *
     * @param $column
     * @return string
     */
    public function find($column)
    {
        DBConnector::setCharsetEncoding();
        $sqlExample = "SELECT " . $column . " 
                       FROM " . $this->table . "
                       WHERE " . $this->where . " ";
        $stm = $this->db->prepare($sqlExample);
        $stm->execute();
        return $result = $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *  Выбираем данные с базы по email
     *
     * @param $email
     * @return string
     */
    public function getByEmail($email)
    {
        DBConnector::setCharsetEncoding();
        $sqlExample = "SELECT * FROM " . $this->table . " WHERE `email` = '" . $email . "' ";
        $stm = $this->db->prepare($sqlExample);
        $stm->execute();
        return $result = $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *  Выбираем данные с базы по id
     *
     * @param $id
     * @return string
     */
    public function getById($id)
    {
        DBConnector::setCharsetEncoding();
        $sqlExample = "SELECT * FROM " . $this->table . " WHERE `id` = '" . $id . "' ";
        $stm = $this->db->prepare($sqlExample);
        $stm->execute();
        return $result = $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *  Возвращаем последний записаный id  базу данных
     *
     * @return string
     */
    public static function getLastId()
    {
        $db = DBConnector::getInstance();
        return $db->lastInsertId();
    }

    /**
     *  заполняем where в запросе
     *
     * @param $column
     * @param $value
     * @return $this
     */
    public function where($column, $value)
    {
        $this->where = " `" . $column . "` = '" . $value . "' ";
        return $this;
    }

    /**
     *  дописываем and в запрос
     *
     * @param $column
     * @param $value
     * @return $this
     */
    public function addAnd($column, $value)
    {
        $this->where .= " AND `" . $column . "` = '" . $value . "' ";
        return $this;
    }

    /**
     *  получаем данны для update
     *  из массива fillable
     *
     * @return string
     */
    private function getUpdateValue()
    {
        $items = '';

        foreach ($this->fillable as $name => $value){

            $items .= " `" . $name . "` = '" . $value . "', ";
        }

        return rtrim($items, ', ');
    }

    /**
     *  получаем название колонок в базе
     *  из массива $fillable
     *
     * @return string
     */
    private function getColumns()
    {
        $columns = '';

        foreach ($this->fillable as $name => $value){

            $columns .= "`" . $name . "`, ";
        }

        return rtrim($columns, ', ');
    }

    /**
     *  получаем значения соответствующие колонкам
     *
     * @return string
     */
    private function getValues()
    {
        $values = '';

        foreach ($this->fillable as $name => $value){

            $values .= "'" . $value . "', ";
        }

        return rtrim($values, ', ');
    }
}