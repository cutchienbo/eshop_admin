<?php
class ProductModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function searchProduct(
        $name = '',
        $min_price = '',
        $max_price = '',
        $type = '',
        $char_size = [],
        $min_size = '',
        $max_size = '',
        $quantity = '',
        $star = '',
        $discount = '',
        $deleted = 1,
        $start = 0,
        $limit = 10,
    ) {

        $data = $this->db->select('p.id, p.id_type, p.name, p.cost, s.discount, pt.name_type, p.quantity, p.star, p.status')->table('product p')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->where('p.name', 'like', "'%" . $name . "%'")
            ->where('p.id_type', 'like', "'%" . $type . "%'", 'AND')
            ->where('p.cost', 'BETWEEN', $min_price . " AND " . $max_price, 'AND')
            ->where($quantity ?'p.quantity':"''", '=', "'".$quantity."'", 'AND')
            ->where($star ?'p.star':"''", '=', "'".$star."'", 'AND')
            ->where($discount ?'s.discount':"''", '=', "'".$discount."'", 'AND')
            ->where('p.status', '=', $deleted, 'AND')
            ->get();

        foreach ($data as $key => $value) {
            $size = $this->db->select('id_size')->table('using_size_list')
                ->where('id_product', '=', "'" . $value['id'] . "'")->get();

            foreach ($size as $i => $value) {
                $size[$i] = $value['id_size'];
            }

            if (!empty($char_size) && ($min_size != '19' || $max_size != '19')) {
                if ((int)$size[0] != 0 && $size[0] != '') {
                    $check = true;

                    foreach ($size as $i => $value) {
                        if ($value >= $min_size && $value <= $max_size) {
                            $check = false;
                            break;
                        }
                    }

                    if ($check) {
                        unset($data[$key]);
                    }
                } else if ((int)$size[0] == 0 && $size[0] != '') {
                    if (count(array_intersect($size, $char_size)) < count($char_size)) {
                        unset($data[$key]);
                    }
                } else {
                    unset($data[$key]);
                }
            } else if (!empty($char_size)) {
                if (count(array_intersect($size, $char_size)) < count($char_size)) {
                    unset($data[$key]);
                }
            } else if ($min_size != '19' || $max_size != '19') {
                $check = true;

                foreach ($size as $i => $value) {
                    if ($value >= $min_size && $value <= $max_size) {
                        $check = false;
                        break;
                    }
                }

                if ($check) {
                    unset($data[$key]);
                }
            }
        }

        $data = array_values($data);

        return [
            'count' => count($data),
            'product' => array_slice($data, $start, $limit),
        ];
    }

    public function getProductType()
    {
        $data = $this->db->select('pt.name_type, pt.id, pt.image')->table('product_type pt')
            ->where('pt.status', '=', '1')
            ->get();

        return $data;
    }

    public function getRangeProductPrice($type = '')
    {
        if ($type != '' && $type != 'search') {
            $data = $this->db->select('MAX(cost), MIN(cost)')->table('product')
                ->where('id_type', '=', "'" . $type . "'")->get();
        } else {
            $data = $this->db->select('MAX(cost), MIN(cost)')->table('product')->get();
        }

        return [
            'max' => $data[0]['MAX(cost)'],
            'min' => $data[0]['MIN(cost)']
        ];
    }

    public function getProductTypeById($id_type)
    {
        $data = $this->db->select()->table('product_type pt')
            ->where('id', '=', "'" . $id_type . "'")
            ->where('pt.status', '=', '1', 'AND')->get();

        return $data[0];
    }

    public function getProduct($start = 0, $limit = 3)
    {
        $data = $this->db->select('p.id, p.id_type, p.name, p.cost, s.discount, pt.name_type, p.quantity, p.star, p.status')
            ->table('product p')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->where('p.status', '=', '1')
            ->limit($start, $limit)
            ->get();

        return $data;
    }

    public function countProduct()
    {
        $data = $this->db->select('COUNT(p.id)')->table('product p')
            ->where('p.status', '=', '1')
            ->get();

        return $data[0]['COUNT(p.id)'];
    }

    public function countProductType($type)
    {
        $data = $this->db->select('COUNT(p.id)')->table('product p')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->where('p.id_type', '=', "'" . $type . "'")
            ->where('pt.status', '=', '1', 'AND')
            ->get();

        return $data[0]['COUNT(p.id)'];
    }

    public function getProductByType($type)
    {
        $data = $this->db->select('p.id, p.id_type, p.name, p.cost, s.discount, pt.name_type, p.quantity, p.star, p.status')->table('product p')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->where('pt.id', '=', "'" . $type . "'")
            ->where('p.status', '=', '1', 'AND')
            ->get();

        return $data;
    }



    public function getProductById($id = '')
    {
        $data = $this->db->select('p.*, pt.name_type, s.discount')->table('product p')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->where('p.id', '=', "'" . $id . "'")
            ->where('p.status', '=', '1', 'AND')->get();

        return $data[0];
    }

    public function addProductType($id = '', $name = '', $image = '')
    {

        $this->db->INSERT(
            'product_type',
            ['id', 'name_type', 'image', 'status'],
            [$id, $name, $image, '1']
        );
    }

    public function updateProductType($data, $id)
    {
        $this->db->UPDATE(
            'product_type',
            $data,
            "id = '" . $id . "'"
        );
    }

    public function deleteProductType($id)
    {
        $product = $this->getProductByType($id);

        $this->db->UPDATE(
            'product_type',
            ['status' => '0'],
            "id='" . $id . "'"
        );
    }

    public function addProduct($value = [], $size = [], $color = [], $image = [], $new_item = false, $trending_item = false, $discount = '')
    {
        $id = $this->db->INSERT(
            'product',
            ['name', 'id_type', 'quantity', 'cost', 'content', 'star', 'review', 'status'],
            $value
        );

        if (!empty($size)) {
            foreach ($size as $key => $value) {
                $size_insert = strtoupper($value);

                $this->db->INSERT(
                    'size_list',
                    ['size'],
                    [$size_insert]
                );

                $this->db->INSERT(
                    'using_size_list',
                    ['id_product', 'id_size'],
                    [$id, $size_insert]
                );
            }
        }

        foreach ($image['id'] as $key => $value) {
            if (!empty($value)) {
                $this->db->INSERT(
                    'image_store',
                    ['id_image', 'color', 'url'],
                    [$image['id'][$key], $color[$key], $image['url'][$key]]
                );

                $this->db->INSERT(
                    'using_image_product',
                    ['id_product', 'id_image'],
                    [$id, $image['id'][$key]]
                );
            }
        }

        if ($new_item) {
            $this->db->INSERT(
                'new_product',
                ['id_product'],
                [$id]
            );
        }

        if ($trending_item) {
            $this->db->INSERT(
                'trending_product',
                ['id_product'],
                [$id]
            );
        }

        if ($discount) {
            $this->db->INSERT(
                'sale',
                ['id_product', 'discount'],
                [$id, $discount]
            );
        }
    }

    public function addSize($id = '', $size = [])
    {
        if (!empty($size)) {
            foreach ($size as $key => $value) {
                if (is_numeric($value)) {
                    $size_item = $value;
                } else {
                    $size_item = strtoupper($value);
                }

                $this->db->INSERT(
                    'size_list',
                    ['size'],
                    [$size_item]
                );

                $this->db->INSERT(
                    'using_size_list',
                    ['id_product', 'id_size'],
                    [$id, $size_item]
                );
            }
        }
    }

    public function deleteSize($id = '', $size = [])
    {
        if (!empty($size)) {
            foreach ($size as $key => $value) {
                if (is_numeric($value)) {
                    $size_item = $value;
                } else {
                    $size_item = strtoupper($value);
                }

                $condition = "id_product='" . $id . "' AND id_size='" . $size_item . "'";

                $this->db->DELETE(
                    'using_size_list',
                    $condition
                );
            }
        }
    }

    public function deleteImage($id_product = '', $id_image = '', $color = '')
    {
        $color = trim($color, '#');

        $using_image_condition = "id_image ='" . $id_image . "' AND id_product ='" . $id_product . "'";

        $this->db->DELETE(
            'using_image_product',
            $using_image_condition
        );

        $image_store_condition = "id_image ='" . $id_image . "' AND color ='" . $color . "'";

        $this->db->DELETE(
            'image_store',
            $image_store_condition
        );
    }

    public function deleteProduct($id = '')
    {
        $this->db->UPDATE(
            'product',
            ['status' => '0'],
            "id='" . $id . "'"
        );
    }

    public function addImage($id_image = '', $url = '', $color = '', $id_product = '')
    {
        $color = trim($color, '#');

        $this->db->INSERT(
            'image_store',
            ['id_image', 'color', 'url'],
            [$id_image, $color, $url]
        );

        $this->db->INSERT(
            'using_image_product',
            ['id_product', 'id_image'],
            [$id_product, $id_image]
        );
    }

    public function updateDiscount($id = '', $discount = '')
    {
        $this->db->UPDATE(
            'sale',
            ['discount' => $discount],
            "id_product ='" . $id . "'"
        );
    }

    public function updateProduct($id = '', $data = [])
    {
        $this->db->UPDATE(
            'product',
            $data,
            "id='" . $id . "'"
        );
    }

    public function getBestSeller($year = '', $precious = '', $month = ''){
        $data = $this -> db -> select('p.id, p.name, COUNT(name) as count') -> table('orders o')
        -> innerJoin('detail_order do', 'do.id_cart', '=', 'o.id_cart')
        -> innerJoin('product p', 'p.id', '=', 'do.id_product')
        -> where($year?'YEAR(create_date)':'true', '=', $year?$year:'true')
        -> where($month?'MONTH(create_date)':'true', '=', $month?$month:'true', 'AND')
        -> where($precious?'MONTH(create_date)':'1', 'BETWEEN', $precious?((($precious-1)*3)." AND ".(($precious-1)*3 + 3)):'0 AND 2', 'AND')
        -> where('o.status', '=', '4', 'AND') 
        -> groupBy('p.id, p.name')
        -> oderBy('COUNT(p.name)', 'DESC')
        -> limit(0, 3) -> get();

        foreach($data as $key => $value){
            $data_image = $this -> db -> select('ist.url as id_image') -> table('product p')
            -> innerJoin('using_image_product uip', 'uip.id_product', '=', 'p.id')
            -> innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
            -> where('p.id', '=', $value['id']) -> get()[0]['id_image'];

            $data[$key]['image'] = $data_image;
        }

        return $data;
    }
}
