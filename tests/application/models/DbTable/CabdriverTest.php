<?php
require_once dirname(__FILE__) . '../../../../../application/models/DbTable/Cabdriver.php';

class Application_Model_DbTable_CabdriverTest extends ControllerTestCase
{
    protected $object ;
    private $id;
    public function setUp(){
            parent::setUp();
            $this->object = new Application_Model_DbTable_Cabdriver();		
    }      
	
	public function setId($a){
		$this->id=$a;
	}

        public function isEqualsArray($A = null, $B = null ){
		$tests = array_diff($A,$B);
		return $tests == null;
	}
	
	public function addCabdriver($name,$contract,$phone,$namber_car,$list_car,$status)
                {
		///$db = NULL;
                ///$db = Zend_Registry::get('connectDB',$db);		
		$this->object->addCabdriver($name,$contract,$phone,$namber_car,$list_car,$status);
		///$id = $db->lastInsertId();
		///$this->setId($id);
		$te = $this->object->getAll();
                //print_r ($te);
		$val = (array)end($te);
                //print_r ($val);
                $this->setId($val['id']);
                //print_r ($this->id);
                $arr = array(
                "name" => $name,
                "contract" => $contract,
                "phone" => $phone,
                "namber_car" => $namber_car,
                "list_car" => $list_car,
                "status" => $status 
                        );
		$this->assertTrue($this->isEqualsArray($arr,$val));		
	}
	public function updateCabdriver($id,$name_update,$contract_update,$phone_update,$namber_car_update,$list_car_update,$status_update){
		$this->object->updateCabdriver($id,$name_update,$contract_update,$phone_update,$namber_car_update,$list_car_update,$status_update);
		$te = $this->object->getCabdriver($id);
                $val = (array) $te;
                $arr = array(
                    "name" => $name_update,
                    "contract" => $contract_update,
                    "phone" => $phone_update,
                    "namber_car" => $namber_car_update,
                    "list_car" => $list_car_update,
                    "status" => $status_update 
                        );
		$this->assertTrue($this->isEqualsArray($arr,$val));		
	
	}        
	public function deleteCabdriver($id){
                print_r ($id);
		$this->object->deleteCabdriver($id);				
		$te = $this->object->getAll();
                $val = (array)end($te);
                if($val['id'] != $id){$this->assertTrue(true);}
                else {$this->assertTrue(false);}
	}
        public function testCabdriver(){
                    $name = "1";
                    $contract = "2";
                    $phone = "3";
                    $namber_car = "4";
                    $list_car = "5";
                    $status = "не работает" ;
                    
                    $name_update = "11";
                    $contract_update = "12";
                    $phone_update = "13";
                    $namber_car_update = "14";
                    $list_car_update = "15";
                    $status_update = "свободен" ;                    
    
	   $this->addCabdriver($name,$contract,$phone,$namber_car,$list_car,$status);            
	   $this->updateCabdriver($this->id,$name_update,$contract_update,$phone_update,$namber_car_update,$list_car_update,$status_update);
           $this->deleteCabdriver($this->id);
	}
        

}

