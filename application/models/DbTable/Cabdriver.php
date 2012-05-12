<?php

class Application_Model_DbTable_Cabdriver extends Zend_Db_Table_Abstract
{
    // Имя таблицы, с которой будем работать
    protected $_name = 'cabdriver';
    
    // Метод для получения записи по id
    public function getCabdriver($id)
    {
        // Получаем id как параметр
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('id = ' . $id);

        // Если результат пустой, выкидываем исключение
        if(!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }
    
    // Метод для добавление новой записи
    public function addCabdriver($name,$contract,$phone,$namber_car,$list_car,$status)
    {
        // Формируем массив вставляемых значений
        $data = array(
            'name' => $name,
            'contract' => $contract,
            'phone' => $phone,
            'namber_car' => $namber_car,
            'list_car' => $list_car,
            'status' => $status            
        );
        
        // Используем метод insert для вставки записи в базу
        $this->insert($data);
    }
    
    // Метод для обновления записи
    public  function updateCabdriver($id,$name,$contract,$phone,$namber_car,$list_car,$status)
    {
        // Формируем массив значений
        $data = array(
            'name' => $name,
            'contract' => $contract,
            'phone' => $phone,
            'namber_car' => $namber_car,
            'list_car' => $list_car,
            'status' => $status 
        );
        
        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);
    }
    
    // Метод для удаления записи
    public function deleteCabdriver($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
}

