<?php
class Model extends Database
{
    protected $db;
    protected $product_type = [];

    function __construct()
    {
        $this->db = new Database();

        $this->product_type = $this->getProductType();
    }

    private function getProductType()
    {
        $data = $this->db->select('id, name_type')->table('product_type')->get();

        return $data;
    }

    public function pagination($index = '', $records = '', $max_record = '')
    {
        $tabs = ceil($records / $max_record);

        $start = $index - 1;
        $end = $index + 1;

        $prev = $index - 1;
        $next = $index + 1;

        if (!$start) {
            $start = 1;

            if ($tabs > 2) {
                $end = $start + 2;
            } else {
                $end = 2;
            }
        }

        if ($end > $tabs) {
            $end = $tabs;
            
            if ($tabs > 2) {
                $start = $end - 2;
            } else {
                $start = $tabs - 1;
            }
        }

        if ($tabs == 1 || $tabs == 0) {
            $start = 1;
            $end = 1;
        }

        if ($prev == 0) {
            $prev = 1;
        }

        if ($next > $tabs) {
            $next = $tabs;
        }

        return [
            'index' => $index,
            'prev' => $prev,
            'next' => $next,
            'start' => $start,
            'end' => $end,
            'tabs' => $tabs,
            'max_record' => $max_record
        ];
    }

    protected function convertListImage($list)
    {
        $list_size = is_array($list) ? count($list) : 0;
        if ($list_size) {
            $check = 0;
            $list[$check]['id_image'] = array($list[$check]['id_image']);

            for ($i = 1; $i < $list_size; $i++) {
                if ($list[$i]['id'] == $list[$check]['id']) {
                    array_push($list[$check]['id_image'], $list[$i]['id_image']);
                    unset($list[$i]);
                } else {
                    $check = $i;
                    $list[$check]['id_image'] = array($list[$check]['id_image']);
                }
            }
        }

        return $list;
    }

    public function getProductImage($id_product)
    {
        $data = $this->db->select('ist.url as id_image, ist.color, ist.id_image as public_id')->table('using_image_product uip')
            ->innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
            ->where('uip.id_product', '=', "'" . $id_product . "'")
            ->get();

        return $data;
    }

    public function getProductSize($id_product)
    {
        $data = $this->db->select('usl.id_size')->table('using_size_list usl')
            ->innerJoin('size_list sl', 'sl.size', '=', 'usl.id_size')
            ->innerJoin('product p', 'p.id', '=', 'usl.id_product')
            ->where('p.id', '=', "'" . $id_product . "'")
            ->get();

        return $data;
    }
}
