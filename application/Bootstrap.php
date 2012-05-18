<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAcl()
    {
        // Создаём объект Zend_Acl
        $acl = new Zend_Acl();
        
        // Добавляем ресурсы нашего сайта,
        // другими словами указываем контроллеры и действия
        
        // указываем, что у нас есть ресурс index
        $acl->addResource('index');  
        
        // указываем, что у нас есть ресурс error
        $acl->addResource('error');
        
        // указываем, что у нас есть ресурс auth
        $acl->addResource('auth');
        
        // указываем, что у нас есть ресурс admin
        $acl->addResource('admin');
        
        // указываем, что у нас есть ресурс operator
        $acl->addResource('operator');       
        
        // ресурс login является потомком ресурса auth
        $acl->addResource('login', 'auth');
        
        // ресурс logout является потомком ресурса auth
        $acl->addResource('logout', 'auth');
        
        // далее переходим к созданию ролей, которых у нас 3:
        // гость (неавторизированный пользователь)
        $acl->addRole('guest');
        // администратор
        $acl->addRole('admin','guest');
        // оператор
        $acl->addRole('operator','guest');        
        
        // разрешаем гостю просматривать ресурс auth и его подресурсы
        $acl->allow('guest', 'auth', array('index', 'login', 'logout'));        
        
        // разрешаем администратору просматривать страницу ошибок
        $acl->allow('admin', 'error');     

        //- разрешаем admin просматривать ресурс admin
        $acl->allow('admin', 'admin', array('index','adduser','edituser','deleteuser','addcabdriver','editcabdriver','deletecabdriver', 'report'));        
        
        $acl->allow('admin', 'index');       

        //- разрешаем operator просматривать ресурс operator
        $acl->allow('operator', 'operator', array('index','onwork','offwork', 'closeorder', 'editorder', 'cancelorder', 'addorder','appoint', 'cancelcabdriver'));        

        
        // получаем экземпляр главного контроллера
        $fc = Zend_Controller_Front::getInstance();
        
        // регистрируем плагин с названием AccessCheck, в который передаём
        // на ACL и экземпляр Zend_Auth
        $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
    }
}
