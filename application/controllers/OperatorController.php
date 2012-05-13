<?php

class OperatorController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        // Создаём объекты нашей модели
        $order = new Application_Model_DbTable_Order();
        $cabdriver = new Application_Model_DbTable_Cabdriver();
        // Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view, через следующую запись
        $this->view->orders = $order->getOrders();
        $this->view->cabdriver = $cabdriver->getCabdrivers();      

    }

    public function onworkAction()
    {
        // Принимаем id записи, которую хотим изменить
        $id = $this->_getParam('id');           
        // Создаём объект модели
        $cabdriver = new Application_Model_DbTable_Cabdriver();               

        // Вызываем метод модели statusCabdriver для изменения статуса       
        $cabdriver->statusCabdriver($id, 'свободен');

        // Используем библиотечный helper для редиректа на action = index
        $this->_helper->redirector('index');
        
    }

    public function offworkAction()
    {
        // Принимаем id записи, которую хотим изменить
        $id = $this->_getParam('id');           
        // Создаём объект модели
        $cabdriver = new Application_Model_DbTable_Cabdriver();               

        // Вызываем метод модели statusCabdriver для изменения статуса       
        $cabdriver->statusCabdriver($id, 'не работает');

        // Используем библиотечный helper для редиректа на action = index
        $this->_helper->redirector('index');
        
    }

    public function editorderAction()
    {
        // action body
    }

    public function closeorderAction()
    {
        // action body
    }

    public function addorderAction()
    {
        // action body
    }

    public function cancelorderAction()
    {
        // action body
    }


}

















