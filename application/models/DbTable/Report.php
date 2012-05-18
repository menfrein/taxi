<?php

class Application_Model_DbTable_Report extends Zend_Db_Table_Abstract
{
    protected $_name = 'order';
    public function getReport($date,$status)
    {
            // Создаем объект Zend_Db_Select
            $select = $this->getAdapter()->select()
                // Таблица из которой делается выборка
                ->from($this->_name)
                // Добавление таблицы с помощью join, указывается поле связи
                ->join('cabdriver','cabdriver.id = order.id_cab',array('cabdriver.name'))
                //$row = $this->fetchRow('id = ' . $id);
                // Порядок сортировки
                ->where( "date = ?", $date )
                ->where( "order.status = ?", $status )
                ->columns(array('date' =>'count(date)','money' => 'sum(money)'))
                ->group('cabdriver.name')
                //->where( "age > ?", 18, "INTEGER" )
                //->order('status DESC')
                ->order('cabdriver.name ASC')
                // Количество возвращаемых записей
                //->limit(2)
                ;
            $stmt = $this->getAdapter()->query($select);
            // Получение данных в виде массива объектов, по умолчанию в виде массива ассоциативных массивов
            $result = $stmt->fetchAll(Zend_Db::FETCH_BOTH);        

            return $result;        
    }
    public function getSum($date,$status)
    {
            // Создаем объект Zend_Db_Select
            $select = $this->getAdapter()->select()
                // Таблица из которой делается выборка
                ->from($this->_name)
                // Добавление таблицы с помощью join, указывается поле связи
                ->join('cabdriver','cabdriver.id = order.id_cab',array('cabdriver.name'))
                //$row = $this->fetchRow('id = ' . $id);
                // Порядок сортировки
                ->where( "date = ?", $date )
                ->where( "order.status = ?", $status )
                ->columns(array('money' => 'sum(money)'))
                //->group('cabdriver.name')
                //->where( "age > ?", 18, "INTEGER" )
                //->order('status DESC')
                //->order('cabdriver.name ASC')
                // Количество возвращаемых записей
                //->limit(2)
                ;
            $stmt = $this->getAdapter()->query($select);
            // Получение данных в виде массива объектов, по умолчанию в виде массива ассоциативных массивов
            $result = $stmt->fetchAll(Zend_Db::FETCH_BOTH);        

            return $result;        
    }
    public function getCount($date,$status)
    {
            // Создаем объект Zend_Db_Select
            $select = $this->getAdapter()->select()
                // Таблица из которой делается выборка
                ->from($this->_name)
                // Добавление таблицы с помощью join, указывается поле связи
                ->join('cabdriver','cabdriver.id = order.id_cab',array('cabdriver.name'))
                //$row = $this->fetchRow('id = ' . $id);
                // Порядок сортировки
                ->where( "date = ?", $date )
                ->where( "order.status = ?", $status )
                ->columns(array('date' =>'count(*)'))
                //->group('cabdriver.name')
                //->where( "age > ?", 18, "INTEGER" )
                //->order('status DESC')
                //->order('cabdriver.name ASC')
                // Количество возвращаемых записей
                //->limit(2)
                ;
            $stmt = $this->getAdapter()->query($select);
            // Получение данных в виде массива объектов, по умолчанию в виде массива ассоциативных массивов
            $result = $stmt->fetchAll(Zend_Db::FETCH_BOTH);        

            return $result;        
    }    
}

