<?php
class CommentModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getUnvalidWords(){
        $data = $this -> db -> select('unvalid_string') -> table('language_filter') -> get();

        return $data;
    }

    public function insertUnvalidString($string = ''){
        $this -> db -> INSERT(
            'language_filter',
            ['unvalid_string'],
            [$string]
        );
    }

    public function deleteUnvalidString($string = ''){
        $this -> db -> DELETE(
            'language_filter',
            "unvalid_string ='".$string."'"
        );
    }
}
