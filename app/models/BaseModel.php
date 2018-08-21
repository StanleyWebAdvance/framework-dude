<?php

namespace app\models;

use core\DBConnector;

abstract class BaseModel
{
    private $db;
    private $table;
    private $where = '';
    public $fillable = array();
    protected static $instance;

    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    /** Возвращаем все из таблици
     *
     * @return string
     */
    public function getAll()
    {
        DBConnector::setCharsetEncoding();
        $stm = $this->db->prepare("SELECT * FROM " . $this->table);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Записываем в таблицу
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

    /** обновление записи
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

    /** найти колонки в базе по значению
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

    /** получение данных по id
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

    /** получение последнего id записаного в базу
     *
     * @return string
     */
    public static function getLastId()
    {
        $db = DBConnector::getInstance();
        return $db->lastInsertId();
    }

    /** заполняем where в запросе
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

    /** дописываем and в запрос
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

    /** получаем данны для update
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

    /** получаем название колонок в базе
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

    /** получаем значения соответствующие колонкам
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