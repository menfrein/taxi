<?php

class Application_Form_CancelOrder extends Zend_Form
{

    public function init()
{
        // Задаём имя форме
        $this->setName('CancelOrder');

        // Создаём элемент hidden c именем = id
        $id = new Zend_Form_Element_Hidden('id');
        // Указываем, что данные в этом элементе фильтруются как число int
        $id->addFilter('Int');
        
        // Создаём переменную, которая будет хранить сообщение валидации
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
 
        $fault_t = new Zend_Form_Element_Checkbox('fault_t');
        $fault_t->setLabel('Вина таксиста');

        $fault_c = new Zend_Form_Element_Checkbox('fault_c');
        $fault_c->setLabel('Вина клиента');
        
        $failure = new Zend_Form_Element_Textarea('failure');
        $failure->setLabel('Причина отказа')    
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
        $this->addElements(array($id, $failure,$fault_t,$fault_c, $submit));
    }


}

