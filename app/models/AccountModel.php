<?php
class AccountModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // public function updateImageee($url = '', $id = ''){
    //     $this -> db -> UPDATE(
    //         'image_store',
    //         ['url' => $url],
    //         "id_image = '".$id."'"
    //     );
    // }

    // public function getListImageee(){
    //     $res = $this -> db -> select() -> table('image_store ist')
    //     -> get();

    //     return $res;
    // }

    public function getAccountLimit($start = '', $limit = '', $type = '')
    {
        $data = $this->db->select()->table($type)
            ->limit($start, $limit)->get();

        return $data;
    }

    public function getAccountByName($start = '', $limit = '', $type = '', $name = ''){
        $data = $this->db->select()->table($type)
        ->where('name', 'like', "'%".$name."%'")
        ->limit($start, $limit)->get();

        $data_count = $this->db->select('COUNT(id)')->table($type)
        ->where('name', 'like', "'%".$name."%'")
        ->get();

        return [
            'count' => $data_count[0]['COUNT(id)'],
            'account' => $data
        ];
    }

    public function getCustomerDefaultAddress($id_customer = ''){
        $data = $this -> db -> select('cl.location') -> table('customer_location cl')
        -> where('id_customer', '=', $id_customer)
        -> where('status', '=', '1', 'AND') -> get();

        return empty($data)?'':$data[0]['location'];
    }

    public function getAllCustomerAddress($id_customer = ''){
        $data = $this -> db -> select() -> table('customer_location cl')
        -> where('id_customer', '=', $id_customer)
        -> get();

        return empty($data)?[]:$data;
    }

    public function getCustomerAddress($id_address = '', $id_customer = ''){
        $data = $this -> db -> select() -> table('customer_location cl')
        -> where('id_customer', '=', $id_customer)
        ->where('id', '=', $id_address, 'AND')
        -> get();

        return empty($data)?[]:$data[0]['location'];
    }

    public function countAccount($type = '')
    {
        $data = $this->db->select('COUNT(id)')->table($type)->get();

        return $data[0]['COUNT(id)'];
    }

    public function addAccount($column = '', $value = '', $role = '')
    {
        $id = $this->db->INSERT(
            $role,
            $column,
            $value
        );
    }

    public function updateStatus($id = '', $type = '')
    {
        $lock = $this->db->select('status')->table($type)
            ->where('id', '=', "'" . $id . "'")->get()[0]['status'];

        $lock =( $lock + 1 ) % 2;

        $this->db->UPDATE(
            $type,
            ['status' => $lock],
            "id='" . $id . "'"
        );
    }

    public function getAccount($id = '', $type = ''){
        $data = $this -> db -> select() -> table($type) 
        -> where('id', '=', $id) -> get();

        return $data[0];
    }

    public function updateAccount($id = '', $data = '', $type = ''){
        $this -> db -> UPDATE(
            $type,
            $data,
            "id='".$id."'"
        );
    }

    public function checkEmail($type = '', $email = ''){
        $data = $this -> db -> select('email') -> table($type) 
        -> where('email', '=', "'".$email."'") -> get();

        return empty($data)?false:true;
    }

    public function checkPhone($type = '', $phone = ''){
        $data = $this -> db -> select('phone_number') -> table($type) 
        -> where('phone_number', '=', "'".$phone."'") -> get();

        return empty($data)?false:true;
    }

    public function checkAccount($type = '', $account = ''){
        $data = $this -> db -> select('account') -> table($type) 
        -> where('account', '=', "'".$account."'") -> get();

        return empty($data)?false:true;
    }

    public function deleteAddress($id_address = '', $id_customer = ''){
        $condition = "id=".$id_address." AND id_customer=".$id_customer;

        $this -> db -> DELETE(
            'customer_location',
            $condition
        );
    }

    
    public function setDefaultAddress($id_address = '', $id_customer = ''){
        $condition1 = "id=".$id_address." AND id_customer=".$id_customer;
        $condition2 = "id!=".$id_address." AND id_customer=".$id_customer;

        $this -> db -> UPDATE(
            'customer_location',
            ['status' => 1],
            $condition1
        );

        $this -> db -> UPDATE(
            'customer_location',
            ['status' => 0],
            $condition2
        );
    }

    public function addCustomerAddress($id_customer = '', $address = ''){
        $count = $this -> db -> select('COUNT(id)') -> table('customer_location')
        -> where('id_customer', '=', $id_customer) -> get()[0]['COUNT(id)'];

        $status = '0';

        if(!$count){
            $status = '1';
        }

        $this -> db -> INSERT(
            'customer_location',
            ['id_customer', 'location', 'status'],
            [$id_customer, $address, $status]
        );
    }

    public function updateCustomerAddress($id_customer = '', $id_address = '', $address = ''){
        $condition = "id = ".$id_address." AND id_customer = ".$id_customer;

        $this -> db -> UPDATE(
            'customer_location',
            ['location' => $address],
            $condition
        );
    }
}
