<?php
class StoreModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getOrders($start = '', $limit = '', $status = ''){
        $data = $this -> db -> select() -> table('orders o')
        -> where('o.status', '=', "'".$status."'")
        -> limit($start, $limit) -> get();

        return $data;
    }

    public function getOrdersByDate(
        $start = '', 
        $limit = '', 
        $status = '', 
        $year = false, 
        $month = false, 
        $day = false
    ){
        $data = $this -> db -> select() -> table('orders o')
        -> where($year?'YEAR(create_date)':'true', '=', $year?$year:'true')
        -> where($month?'MONTH(create_date)':'true', '=', $month?$month:'true', 'AND')
        -> where($day?'DAY(create_date)':'true', '=', $day?$day:'true', 'AND')
        -> where('o.status', '=', "'".$status."'", 'AND')
        -> limit($start, $limit) -> get();

        $data_count = $this -> db -> select('COUNT(id_cart)') -> table('orders o')
        -> where($year?'YEAR(create_date)':'true', '=', $year?$year:'true')
        -> where($month?'MONTH(create_date)':'true', '=', $month?$month:'true', 'AND')
        -> where($day?'DAY(create_date)':'true', '=', $day?$day:'true', 'AND')
        -> where('o.status', '=', "'".$status."'", 'AND')
        -> get();

        return [
            'count' => $data_count[0]['COUNT(id_cart)'],
            'orders' => $data
        ];
    }

    public function countOrders($status = ''){
        $data = $this -> db -> select('COUNT(id_customer)') -> table('orders o')
        -> where('o.status', '=', "'".$status."'") -> get();

        return $data[0]['COUNT(id_customer)'];
    }

    public function updateStatus($id_cart = '', $id_customer = '', $status = ''){
        $condition = "id_cart='".$id_cart."' AND id_customer='".$id_customer."'";
        $this -> db -> UPDATE(
            'orders', 
            ['status' => $status + 1],
            $condition
        );
    }

    public function getOrderLocation($id_cart = '', $id_customer = ''){
        $data = $this -> db -> select('location') -> table('orders o')
        -> where("id_cart", '=', "'".$id_cart."'") 
        -> where('id_customer', '=', "'".$id_customer."'", 'AND')
        -> get();

        return $data[0]['location'];
    }

    public function updateLocation($location = '', $id_cart = '', $id_customer = ''){
        $condition = "id_cart ='".$id_cart."' AND id_customer = '".$id_customer."'";

        $this -> db -> UPDATE(
            'orders', 
            ['location' => $location],
            $condition
        );
    }

    public function updateProductQuantity($id_cart = '', $id_customer = ''){
        $product = $this -> db -> select('do.id_product, do.quantity') -> table('detail_order do')
        -> where("do.id_cart", '=', "'".$id_cart."'") 
        -> where('do.id_customer', '=', "'".$id_customer."'", 'AND')
        -> get();

        foreach($product as $key => $value){
            $quantity = $this -> db -> select('p.quantity') -> table('product p')
            -> where('p.id', '=', "'".$value['id_product']."'") -> get()[0]['quantity'];

            $this -> db -> UPDATE(
                'product',
                ['quantity' => $quantity - $value['quantity']],
                "id='".$value['id_product']."'"
            );
        }
    }

    public function getProductInDetailOrder($id_cart = '', $id_customer = ''){
        $data = $this -> db -> select('p.*, pt.name_type, s.discount, do.size, do.color') -> table('product p')
        -> innerJoin('detail_order do', 'do.id_product', '=', 'p.id')
        -> innerJoin('sale s', 's.id_product', '=', 'p.id')
        -> innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
        -> where("do.id_cart", '=', "'".$id_cart."'") 
        -> where('do.id_customer', '=', "'".$id_customer."'", 'AND')
        -> get();

        return $data;
    }

    public function countProductInDetailOrder($id_cart = '', $id_customer = ''){
        $data = $this -> db -> select('COUNT(p.id)') -> table('product p')
        -> innerJoin('detail_order do', 'do.id_product', '=', 'p.id')
        -> where("do.id_cart", '=', "'".$id_cart."'") 
        -> where('do.id_customer', '=', "'".$id_customer."'", 'AND')
        -> get();

        return $data[0]['COUNT(p.id)'];
    }

    public function cancelOrder($id_cart = '', $id_customer = ''){
        $condition = "id_cart ='".$id_cart."' AND id_customer = '".$id_customer."'";

        $this -> db -> UPDATE(
            'orders',
            ['status' => 5],
            $condition
        );
    }
}
