<?php

class Application_Form_Users extends Zend_Form
{
    // Метод init() вызовется по умолчанию
    public function init()
    {
        // Задаём имя форме
        $this->setName('Users');

        // Создаём элемент hidden c именем = id
        $id = new Zend_Form_Element_Hidden('id');
        // Указываем, что данные в этом элементе фильтруются как число int
        $id->addFilter('Int');
        
        // Создаём переменную, которая будет хранить сообщение валидации
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

        // Создаём элемент формы – text c именем = name        
        $name = new Zend_Form_Element_Text('name');
        
        /*
        * Далее пишем содержание label, который будет отображаться для данного поля,
        * указываем, является элемент обязательным или нет,
        * пишем список фильтров, которые будут применяться к данному элементу,
        * и наконец, указываем валидатор и сообщение об ошибке, которое будет выведено пользователю
        */
        $name->setLabel('ФИО')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        
        // Создаём второй текстовой элемент формы и проделываем те же операции
        $contract = new Zend_Form_Element_Text('contract');
        $contract->setLabel('Контракт')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        
        // Создаём третий текстовой элемент формы и проделываем те же операции
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Телефон')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // Создаём четвертый текстовой элемент формы и проделываем те же операции
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Логин')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );        

        // Создаём пятый текстовой элемент формы и проделываем те же операции
        $password = new Zend_Form_Element_Text('password');
        $password->setLabel('Пароль')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            ); 

        $role = new Zend_Form_Element_Text('role');
        $role->setLabel('Роль')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );        
        
        // Создаём элемент формы Submit c именем = submit
        $submit = new Zend_Form_Element_Submit('submit');
        // Создаём атрибут id = submitbutton
        $submit->setAttrib('id', 'submitbutton');

        // Добавляем все созданные элементы к форме.
        $this->addElements(array($id, $name, $contract, $phone, $username, $password, $role, $submit));
    }


}




