<?php
require_once dirname(__FILE__) . '../../../../../application/models/DbTable/Cabdriver.php';

class Application_Model_DbTable_UsersTest extends ControllerTestCase
{  protected $object ;
    private $id;
    public function setUp(){
            parent::setUp();
            $this->object = new Application_Model_DbTable_Users();		
    } 
    public function setId($a){
		$this->id=$a;
	}
   public function isEqualsArray($A = null, $B = null ){
		$tests = array_diff($A,$B);
		return $tests == null;
	}
        
     public function addUser($name, $contract, $phone, $username, $password, $role)
    {
        $this->object->addUser($name, $contract, $phone, $username, $password, $role);
        $te=$this->object->getAll();
        $val = (array)end($te);
         $this->setId($val['id']);
        $arr = array('name'=>$name, 
            'contract'=>$contract,
            'phone'=>$phone,
            'username'=>$username, 
            'password'=>$password,
            'role'=>$role);
       $this->assertTrue($this->isEqualsArray($arr,$val)); 
    }  
    public function updateUser($id, $name, $contract, $phone, $username, $password, $role){
		$this->object->updateUser($id, $name, $contract, $phone, $username, $password, $role);
		$te = $this->object->getUser($id);
                $val = (array) $te;
                $arr = array('name'=>$name, 
            'contract'=>$contract,
            'phone'=>$phone,
            'username'=>$username, 
            'password'=>$password,
            'role'=>$role);
		$this->assertTrue($this->isEqualsArray($arr,$val));		
	 	}  
                
              public function deleteUser($id){
                print_r ($id);
		$this->object->deleteUser($id);				
		$te = $this->object->getAll();
                $val = (array)end($te);
                if($val['id'] != $id){$this->assertTrue(true);}
                else {$this->assertTrue(false);}
	}  
                
     public function testUser(){
                    $name = "name";
                    $contract = "text";
                    $phone = "namber";
                    $username = "name";
                    $password = "text";
                    $role = "не работает" ;
                    
                    $name_update = "name_update";
                    $contract_update = "text_update";
                    $phone_update = "namber_update";
                    $username_update = "login_update";
                    $password_update = "text_update";
                    $role_update = "свободен" ;                    
    
	   $this->addUser($name, $contract, $phone, $username, $password, $role);            
	   $this->updateUser($this->id, $name_update, $contract_update,$phone_update,$username_update,$password_update,$role_update ); 
           $this->deleteUser($this->id);
	}
      

        
}

