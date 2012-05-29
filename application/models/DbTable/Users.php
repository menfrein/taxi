<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    // Имя таблицы, с которой будем работать
    protected $_name = 'users';
    public function getAll()
        {
            // Создаем объект Zend_Db_Select
            $select = $this->getAdapter()->select()
                // Таблица из которой делается выборка
                ->from($this->_name)                
                // Порядок сортировки
                ->order('id ASC')
                //->order('name ASC')
                // Количество возвращаемых записей
                //->limit(2)
                ;
            $stmt = $this->getAdapter()->query($select);
            // Получение данных в виде массива объектов, по умолчанию в виде массива ассоциативных массивов
            $result = $stmt->fetchAll(Zend_Db::FETCH_OBJ);        

            return $result;
        }    
    // Метод для получения записей
    public function getUsers()
        {
            // Создаем объект Zend_Db_Select
            $select = $this->getAdapter()->select()
                // Таблица из которой делается выборка
                ->from($this->_name)
                // Добавление таблицы с помощью join, указывается поле связи
                //->join('users','users.id = articles.author_id',array('name'))
                // Порядок сортировки
                ->order('role ASC')
                ->order('name ASC')
                // Количество возвращаемых записей
                //->limit(2)
                ;
            $stmt = $this->getAdapter()->query($select);
            // Получение данных в виде массива объектов, по умолчанию в виде массива ассоциативных массивов
            $result = $stmt->fetchAll(Zend_Db::FETCH_OBJ);        

            return $result;
        }
    // Метод для получения записи по id
    public function getUser($id)
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
    public function addUser($name, $contract, $phone, $username, $password, $role)
    {
        // Формируем массив вставляемых значений
        $data = array(
            'name' => $name,
            'contract' => $contract,
            'phone' => $phone,
            'username' => $username,
            'password' => $password,
            'role' => $role            
        );
        
        // Используем метод insert для вставки записи в базу
        $this->insert($data);
    }
    // Метод для обновления записи
    public  function updateUser($id, $name, $contract, $phone, $username, $password, $role)
    {
        // Формируем массив значений
        $data = array(
            'name' => $name,
            'contract' => $contract,
            'phone' => $phone,
            'username' => $username,
            'password' => $password,
            'role' => $role
        );
        
        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);
    }
    
    // Метод для удаления записи
    public function deleteUser($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }    
    
}
