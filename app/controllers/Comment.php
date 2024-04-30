<?php
class Comment extends Controller
{

    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('CommentModel');
    }

    public function index($params = [])
    {
        $unvalid_words = $this -> model -> getUnvalidWords();

        $this->data = array(
            'title' => 'Eshop Admin - Comment',
            'content' => 'comment/comment',
            'data' => [
                'unvalid_words' => $unvalid_words
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function add_unvalid(){
        if($_POST['string'] != ''){
            $this -> model -> insertUnvalidString($_POST['string']);
        }

        header("Location:"._WEB_ROOT.'/comment');
    }

    public function delete_unvalid($string = ''){
        $this -> model -> deleteUnvalidString($string);

        header("Location:"._WEB_ROOT.'/comment');
    }
}
