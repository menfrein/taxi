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
                // Создаём форму
                $form = new Application_Form_AddOrder();

                // Указываем текст для submit
                $form->submit->setLabel('Изменить заказ');
                $this->view->form = $form;

                // Если к нам идёт Post запрос
                if ($this->getRequest()->isPost()) {
                // Принимаем его
                $formData = $this->getRequest()->getPost();

                // Если форма заполнена верно
                if ($form->isValid($formData)) {
                        // Извлекаем id
                $id = (int)$form->getValue('id');
                
                $date = $form->getValue('date');

                $phone_client = $form->getValue('phone_client');
                
                $name_client = $form->getValue('name_client'); 

                $time_start = $form->getValue('time_start');

                $address_start = $form->getValue('address_start');
                
                $address_stop = $form->getValue('address_stop');                 

                $parking = $form->getValue('parking');
                
                $comments = $form->getValue('comments');
                
                // Создаём объект модели
                $order = new Application_Model_DbTable_Order();

                // Вызываем метод модели updateAdmin для обновления новой записи
                $order->updateOrder($id, $date,$phone_client,$name_client, $time_start, $address_start, $address_stop, $parking , $comments);

                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            // Если мы выводим форму, то получаем id администратора, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $order = new Application_Model_DbTable_Order();

                // Заполняем форму информацией при помощи метода populate
                $form->populate($order->getOrder($id));
            }
        
        
    }
    }

    public function closeorderAction()
    {
                // Создаём форму
                $form = new Application_Form_CloseOrder();

                // Указываем текст для submit
                $form->submit->setLabel('Закрыть заказ');
                $this->view->form = $form;

                // Если к нам идёт Post запрос
                if ($this->getRequest()->isPost()) {
                // Принимаем его
                $formData = $this->getRequest()->getPost();

                // Если форма заполнена верно
                if ($form->isValid($formData)) {
                        // Извлекаем id
                $id = (int)$form->getValue('id');

                $money = $form->getValue('money');
                
                $address_stop = $form->getValue('address_stop'); 

                $time_stop = $form->getValue('time_stop');               

                $comments = $form->getValue('comments');
                
                $parking = $form->getValue('parking');
                
                $status = 'закрыт';
                
                // Создаём объект модели
                $order = new Application_Model_DbTable_Order();
                
                $cabdriver = new Application_Model_DbTable_Cabdriver();
                
                $cab = $order->getOrder($id);
                
                $status_cab = "свободен";
                
                $cabdriver->statusCabdriver($cab['id_cab'], $status_cab);

                // Вызываем метод модели closeOrder для обновления новой записи
                $order->closeOrder($id, $money, $address_stop, $time_stop, $parking, $comments, $status);

                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            // Если мы выводим форму, то получаем id администратора, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $order = new Application_Model_DbTable_Order();

                // Заполняем форму информацией при помощи метода populate
                $form->populate($order->getOrder($id));
            }
        
        
    }
    }

    public function addorderAction()
    {
        // Создаём форму
        $form = new Application_Form_AddOrder();

        // Указываем текст для submit
        $form->submit->setLabel('Добавить заказ');
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $date = $form->getValue('date');

                $phone_client = $form->getValue('phone_client');
                
                $name_client = $form->getValue('name_client'); 

                $time_start = $form->getValue('time_start');

                $address_start = $form->getValue('address_start');
                
                $address_stop = $form->getValue('address_stop');                 

                $parking = $form->getValue('parking');
                
                $comments = $form->getValue('comments');
                
                $status = 'в ожидании';
                
                // Создаём объект модели
                $order = new Application_Model_DbTable_Order();

                // Вызываем метод модели addOrder для вставки новой записи
                $order->addOrder($date,$phone_client,$name_client, $time_start, $address_start, $address_stop, $parking , $comments, $status);

                // Используем библиотечный helper для редиректа на action = operator
                $this->_helper->redirector('operator');
            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }        
        }
    }

    public function cancelorderAction()
    {
        // Создаём форму
        $form = new Application_Form_CancelOrder();

        $id = $this->_getParam('id', 0);
        $form->populate(array('id'=>$id));
            
        // Передаём форму в view        
        $this->view->form = $form;

        // Указываем текст для submit
        $form->submit->setLabel('Отменить заказ');
                // Если к нам идёт Post запрос
                if ($this->getRequest()->isPost()) {
                // Принимаем его
                $formData = $this->getRequest()->getPost();

                // Если форма заполнена верно
                if ($form->isValid($formData)) {
                // Извлекаем id
                $id = (int)$form->getValue('id');

                $failure = $form->getValue('failure');
                
                $fault_t = $form->getValue('fault_t'); 

                $fault_c = $form->getValue('fault_c');
                
                $status = 'отменен';
                
                // Создаём объект модели
                $order = new Application_Model_DbTable_Order();
                
                $cabdriver = new Application_Model_DbTable_Cabdriver();
                
                $cab = $order->getOrder($id);
                
                $status_cab = "свободен";
                
                $cabdriver->statusCabdriver($cab['id_cab'], $status_cab);    
                 // Вызываем метод модели updateOrder для обновления новой записи
                $order->cancelOrder($id, $failure,$fault_t,$fault_c, $status);
                
                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
         }  

    }

    public function appointAction()
    {
        // Создаём объекты нашей модели
        $cabdriver = new Application_Model_DbTable_Cabdriver();
        // Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view, через следующую запись
        $id = $this->_getParam('id', 0);
        $this->view->cabdriver = $cabdriver->getCabdrivers();
        $this->view->id = array('id'=>$id);
        
        // Если к нам идёт Post запрос
                if ($this->_getParam('id_cab', 0)) {
                // Принимаем его
                // Извлекаем id
                $id = (int)$this->_getParam('id', 0);

                $id_cab = (int)$this->_getParam('id_cab', 0);
                
                $status = 'на обслуживании';
                
                // Создаём объект модели
                $order = new Application_Model_DbTable_Order();

                 // Вызываем метод модели updateOrder для обновления новой записи
                $order->appointTaxiOrder($id, $id_cab, $status);
                
                $cabdriver = new Application_Model_DbTable_Cabdriver();
                
                $status_cab = "занят";
                
                $cabdriver->statusCabdriver($id_cab, $status_cab);
                
                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('operator');

         }
    }


}



















