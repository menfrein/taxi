<?php

class OperatorController extends Zend_Controller_Action
{

    public function init()
    {
        /*  */
    }

    public function indexAction()
    {
        // Создаём объекты нашей модели
        $order = new Application_Model_DbTable_Order();
        $cabdriver = new Application_Model_DbTable_Cabdriver();
        // Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view, через следующую запись
        $this->view->orders = $order->getOrders();
        $this->view->cabdriver = $cabdriver->fetchAll();        // action body
    }


}

