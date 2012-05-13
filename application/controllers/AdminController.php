<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // Создаём объекты нашей модели
        $users = new Application_Model_DbTable_Users();
        $cabdriver = new Application_Model_DbTable_Cabdriver();
        // Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view, через следующую запись
        $this->view->users = $users->getUsers();
        $this->view->cabdriver = $cabdriver->getCabdrivers();
    }

    public function adduserAction()
    {
        // Создаём форму
        $form = new Application_Form_Users();

        // Указываем текст для submit
        $form->submit->setLabel('Добавить');

        // Передаём форму в view
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                // Извлекаем ФИО оператора
                $name = $form->getValue('name');

                // Извлекаем контракт
                $contract = $form->getValue('contract');
                
                // Извлекаем телефон
                $phone = $form->getValue('phone'); 

                // Извлекаем Логин
                $username = $form->getValue('username');

                // Извлекаем пароль
                $password = $form->getValue('password');
                
                // Извлекаем роль
                $role = $form->getValue('role');                 

                // Создаём объект модели
                $users = new Application_Model_DbTable_Users();

                // Вызываем метод модели addUser для вставки новой записи
                $users->addUser($name, $contract, $phone, $username, $password, $role);

                // Используем библиотечный helper для редиректа на action = admin
                $this->_helper->redirector('admin');
            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        
        }


    }

    public function edituserAction()
    {
                // Создаём форму
                $form = new Application_Form_Users();

                // Указываем текст для submit
                $form->submit->setLabel('Сохранить');
                $this->view->form = $form;

                // Если к нам идёт Post запрос
                if ($this->getRequest()->isPost()) {
                // Принимаем его
                $formData = $this->getRequest()->getPost();

                // Если форма заполнена верно
                if ($form->isValid($formData)) {
                        // Извлекаем id
                $id = (int)$form->getValue('id');

                // Извлекаем ФИО администратора
                $name = $form->getValue('name');

                // Извлекаем контракт
                $contract = $form->getValue('contract');
                
                // Извлекаем телефон
                $phone = $form->getValue('phone');                
          
                // Извлекаем Логин
                $username = $form->getValue('username');

                // Извлекаем пароль
                $password = $form->getValue('password');
                
                // Извлекаем роль
                $role = $form->getValue('role'); 
                
                // Создаём объект модели
                $users = new Application_Model_DbTable_Users();

                // Вызываем метод модели updateAdmin для обновления новой записи
                $users->updateUser($id, $name, $contract, $phone, $username, $password, $role);

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
                $users = new Application_Model_DbTable_Users();

                // Заполняем форму информацией при помощи метода populate
                $form->populate($users->getUser($id));
            }
        
        }
    }

    public function deleteuserAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если администратор подтвердил своё желание удалить запись
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $users = new Application_Model_DbTable_Users();               

                // Вызываем метод модели deleteUsers для удаления записи
                $users->deleteUser($id);
            }

            // Используем библиотечный helper для редиректа на action = admin
            $this->_helper->redirector('admin');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $users = new Application_Model_DbTable_Users();

            // Достаём запись и передаём в view
            $this->view->user = $users->getUser($id); 
        }
    }
    public function addcabdriverAction()
    {
        // Создаём форму
        $form = new Application_Form_Cabdriver();

        // Указываем текст для submit
        $form->submit->setLabel('Добавить');

        // Передаём форму в view
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                // Извлекаем ФИО таксиста
                $name = $form->getValue('name');

                // Извлекаем контракт
                $contract = $form->getValue('contract');
                
                // Извлекаем телефон
                $phone = $form->getValue('phone');                

                // Извлекаем номер машины
                $namber_car = $form->getValue('namber_car');

                // Извлекаем описание машины
                $list_car = $form->getValue('list_car');

                
                // Создаём объект модели
                $cabdriver = new Application_Model_DbTable_Cabdriver();

                // Вызываем метод модели addOperator для вставки новой записи
                $cabdriver->addCabdriver($name, $contract, $phone, $namber_car, $list_car, 'не работает');

                // Используем библиотечный helper для редиректа на action = admin
                $this->_helper->redirector('admin');
            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        
    }

    }

    public function deletecabdriverAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если администратор подтвердил своё желание удалить запись
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $cabdriver = new Application_Model_DbTable_Cabdriver();               

                // Вызываем метод модели deleteCabdriver для удаления записи
                $cabdriver->deleteCabdriver($id);
            }

            // Используем библиотечный helper для редиректа на action = admin
            $this->_helper->redirector('admin');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $cabdriver = new Application_Model_DbTable_Cabdriver();

            // Достаём запись и передаём в view
            $this->view->cabdriver = $cabdriver->getCabdriver($id); 
    
 
    }
    }

    public function editcabdriverAction()

    {
        // Создаём форму
        $form = new Application_Form_Cabdriver();

        // Указываем текст для submit
        $form->submit->setLabel('Сохранить');
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                // Извлекаем id
                $id = (int)$form->getValue('id');

                // Извлекаем ФИО администратора
                $name = $form->getValue('name');

                // Извлекаем контракт
                $contract = $form->getValue('contract');
                
                // Извлекаем телефон
                $phone = $form->getValue('phone');  
                
                // Извлекаем номер машины
                $namber_car = $form->getValue('namber_car');

                // Извлекаем описание машины
                $list_car = $form->getValue('list_car');
                
                // Создаём объект модели
                $cabdriver = new Application_Model_DbTable_Cabdriver();

                // Вызываем метод модели updateAdmin для обновления новой записи
                $cabdriver->updateCabdriver($id, $name, $contract, $phone, $namber_car, $list_car, 'не работает');

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
                $admin = new Application_Model_DbTable_Cabdriver();

                // Заполняем форму информацией при помощи метода populate
                $form->populate($admin->getCabdriver($id));
            }
        
    }
    }


}







