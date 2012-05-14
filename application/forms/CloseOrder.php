<?php

class Application_Form_CloseOrder extends Zend_Form
{

    public function init()
    {
        // Задаём имя форме
        $this->setName('CloseOrder');

        // Создаём элемент hidden c именем = id
        $id = new Zend_Form_Element_Hidden('id');
        // Указываем, что данные в этом элементе фильтруются как число int
        $id->addFilter('Int');
        
        // Создаём переменную, которая будет хранить сообщение валидации
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        
        $money = new Zend_Form_Element_Text('money');
        $money->setLabel('Сумма')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $address_stop = new Zend_Form_Element_Text('address_stop');
        $address_stop->setLabel('Куда')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        
        $time_stop = new Zend_Form_Element_Text('time_stop');
        $time_stop->setLabel('Время')
            ->setValue(date("H:i"))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        
        $comments = new Zend_Form_Element_Textarea('comments');
        $comments->setLabel('Комментарии к заказу');  
        
        $parking = new Zend_Form_Element_Checkbox('parking');
        $parking->setLabel('Стоянки');
        
        // Создаём элемент формы Submit c именем = submit
        $submit = new Zend_Form_Element_Submit('submit');
        // Создаём атрибут id = submitbutton
        $submit->setAttrib('id', 'submitbutton');

        // Добавляем все созданные элементы к форме.
        $this->addElements(array($id, $money, $address_stop, $time_stop, $parking, $submit, $comments));
    }


}

