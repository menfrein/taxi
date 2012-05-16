<?php

class Application_Form_AddOrder extends Zend_Form
{

    public function init()
    {
        // Задаём имя форме
        $this->setName('AddOrder');

        // Создаём элемент hidden c именем = id
        $id = new Zend_Form_Element_Hidden('id');
        // Указываем, что данные в этом элементе фильтруются как число int
        $id->addFilter('Int');
        
        // Создаём переменную, которая будет хранить сообщение валидации
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

        // Создаём элемент формы – text c именем = name        
        $phone_client = new Zend_Form_Element_Text('phone_client');
        
        /*
        * Далее пишем содержание label, который будет отображаться для данного поля,
        * указываем, является элемент обязательным или нет,
        * пишем список фильтров, которые будут применяться к данному элементу,
        * и наконец, указываем валидатор и сообщение об ошибке, которое будет выведено пользователю
        */
        $phone_client->setLabel('Телефон клиента')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        

        $name_client = new Zend_Form_Element_Text('name_client');
        $name_client->setLabel('Имя клиента');
        

        $address_start = new Zend_Form_Element_Text('address_start');
        $address_start->setLabel('Откуда')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        $address_stop = new Zend_Form_Element_Text('address_stop');
        $address_stop->setLabel('Куда');        


        $time_start = new Zend_Form_Element_Text('time_start');
        $time_start->setLabel('Время ')
            ->setValue(date("H:i"))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            ); 
        
        $date = new Zend_Form_Element_Text('date');
        $date->setLabel('Дата')
            ->setValue(date("Y.m.d"))    
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        
        $parking = new Zend_Form_Element_Checkbox('parking');
        $parking->setLabel('Стоянки');
        
        $comments = new Zend_Form_Element_Textarea('comments');
        $comments->setLabel('Комментарии к заказу');   

        
        // Создаём элемент формы Submit c именем = submit
        $submit = new Zend_Form_Element_Submit('submit');
        // Создаём атрибут id = submitbutton
        $submit->setAttrib('id', 'submitbutton');

        // Добавляем все созданные элементы к форме.
        $this->addElements(array($id, $date,$phone_client,$name_client, $time_start, $address_start, $address_stop, $parking , $comments, $submit));
    }


}

