<?php
class LoginModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function checkSuperAdmin($account = '', $password = ''){
        $data = $this -> db -> select('role') -> table('super_admin')
        -> where('account', '=', "'".$account."'") 
        -> where('password', '=', "'".$password."'", 'AND')
        -> get();

        return $data;
    }
    
    public function checkAdmin($account = '', $password = ''){
        $data = $this -> db -> select('name, image') -> table('admin')
        -> where('account', '=', "'".$account."'") 
        -> where('password', '=', "'".$password."'", 'AND')
        -> where('status', '=', '1', 'AND') -> get();

        return $data;
    }

    public function checkStaff($account = '', $password = ''){
        $data = $this -> db -> select('name, image') -> table('staff')
        -> where('account', '=', "'".$account."'") 
        -> where('password', '=', "'".$password."'", 'AND')
        -> where('status', '=', '1', 'AND') -> get();

        return $data;
    }
}
