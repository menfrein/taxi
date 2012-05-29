<?php
require_once dirname(__FILE__) . '../../../../../application/models/DbTable/Order.php';

class Application_Model_DbTable_OrderTest extends ControllerTestCase
{
    protected $object ;
    private $id;
    public function setUp(){
            parent::setUp();
            $this->object = new Application_Model_DbTable_Order();		
    }      
	
	public function setId($a){
		$this->id=$a;
	}

        public function isEqualsArray($A = null, $B = null ){
		$tests = array_diff($A,$B);
		return $tests == null;
	}
    // Метод для добавление новой записи        
    public function addOrder($date,$phone_client,$name_client, $time_start,$address_start,$address_stop,$parking,$comments,$status)
               {	
		$this->object->addOrder($date,$phone_client,$name_client, $time_start,$address_start,$address_stop,$parking,$comments,$status);
		$te = $this->object->getAll();
                //print_r ($te);
		$val = (array)end($te);
                //print_r ($val);
                $this->setId($val['id']);
                //print_r ($this->id);
                $data = array(
                    'date' => $date,
                    'phone_client' => $phone_client,
                    'name_client' => $name_client,
                    'time_start' => $time_start,
                    'address_start' => $address_start,
                    'address_stop' => $address_stop,
                    'parking' => $parking,
                    'comments' => $comments,
                    'status' => $status
                ); 
		$this->assertTrue($this->isEqualsArray($data,$val));		
	}

    // Метод для обновления записи
    public  function updateOrder($id,$date,$phone_client,$name_client, $time_start,$address_start,$address_stop,$parking,$comments)
    {
        // Формируем массив значений
		$this->object->updateOrder($id,$date,$phone_client,$name_client, $time_start,$address_start,$address_stop,$parking,$comments);
		$te = $this->object->getOrder($id);
                $val = (array) $te; 
                //print_r ($val);
                $data = array(
                    'date' => $date,
                    'phone_client' => $phone_client,
                    'name_client' => $name_client,
                    'time_start' => $time_start,
                    'address_start' => $address_start,
                    'address_stop' => $address_stop,
                    'parking' => $parking,
                    'comments' => $comments,
                 ); 
                //print_r ($data);
		$this->assertTrue($this->isEqualsArray($data,$val));	
    }
    public function cancelOrder($id, $failure,$fault_t,$fault_c, $status)
    {         
        $this->object->cancelOrder($id, $failure,$fault_t,$fault_c, $status);
        $te = $this->object->getOrder($id);
        $val = (array) $te;
        $data = array(
            'failure' => $failure,
            'fault_t' => $fault_t,
            'fault_c' => $fault_c,
            'status' => $status 
        );        
        $this->assertTrue($this->isEqualsArray($data,$val));
    }  
    public function closeOrder($id, $money, $address_stop, $time_stop, $parking, $comments, $status)
    {         
        $this->object->closeOrder($id, $money, $address_stop, $time_stop, $parking, $comments, $status);
        $te = $this->object->getOrder($id);
        $val = (array) $te;
        $data = array(
            'time_stop' => $time_stop,
            'address_stop' => $address_stop,
            'parking' => $parking,
            'money' => $money,
            'comments' => $comments,            
            'parking' => $parking,
            'status' => $status 
        );        
        $this->assertTrue($this->isEqualsArray($data,$val));
    }
    
    public function appointTaxiOrder($id, $id_cab, $status)
    {         
    {         
        $this->object->appointTaxiOrder($id, $id_cab, $status);
        $te = $this->object->getOrder($id);
        $val = (array) $te;
    } 
        $data = array(
            'id_cab' => $id_cab,
            'status' => $status 
        );        
        $this->assertTrue($this->isEqualsArray($data,$val));
    }

        public function testOrder(){
                    $date = "2012-05-26";
                    $time_start = "10:15:00";
                    $phone_client = "namber";
                    $name_client = "name";
                    $address_start = "text";
                    $address_stop = "text" ;
                    $parking = "0";
                    $name_client = "name";
                    $comments = "text";
                    $status = "text" ;                    
	   $this->addOrder($date,$phone_client,$name_client, $time_start,$address_start,$address_stop,$parking,$comments,$status);            
                   
                    $date_update = "2012-05-29";
                    $time_start_update = "10:15:30";
                    $phone_client_update = "phone";
                    $name_client_update = "name";
                    $address_start_update = "text";
                    $address_stop_update = "text" ;
                    $parking_update = "1";
                    $name_client_update = "name";
                    $comments_update = "text";
  	   $this->updateOrder($this->id,$date_update,$phone_client_update,$name_client_update, $time_start_update,$address_start_update,$address_stop_update,$parking_update,$comments_update);

                    $id_cab = 1;
                    $status = "на обслуживании";                      
           $this->appointTaxiOrder($this->id, $id_cab, $status);
                    
                    $money = "150";
                    $address_stop = "text";
                    $time_stop = "10:30:30";
                    $parking = "1";
                    $comments = "text";
                    $status = "закрыт";
           $this->closeOrder($this->id, $money, $address_stop, $time_stop, $parking, $comments, $status);                    
  
                    $failure =  "text";
                    $fault_t = 1;
                    $fault_c = 1;
                    $status = "отменен";                  
           $this->cancelOrder($this->id, $failure,$fault_t,$fault_c, $status);
           
	}    

}

