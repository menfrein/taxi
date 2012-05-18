<?php

class Application_Form_Report extends Zend_Form
{

    public function init()
    {
        // Задаём имя форме
        $this->setName('Report');

        // Создаём переменную, которая будет хранить сообщение валидации
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

        $date = new Zend_Form_Element_Text('date');
        $date->setLabel('Дата')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        
        // Создаём элемент формы Submit c именем = submit
        $submit = new Zend_Form_Element_Submit('submit');
        // Создаём атрибут id = submitbutton
        $submit->setAttrib('date', 'submitbutton');        

        // Добавляем все созданные элементы к форме.
        $this->addElements(array($date, $submit));
           
    }


}

