<?php

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class Image
{
    private $upload;

    public function __construct()
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => 'dwewnjnbm',
                'api_key' => '716727992422141',
                'api_secret' => 'rbK0RmggWhExFJfwW-6uLtF7nQ0'
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        $this->upload = new UploadApi();
    }

    public function upload($path = '', $id = '', $type = '')
    {
        $type = '/' . $type;

        $res = $this->upload->upload(
            $path,
            [
                "public_id" => $id,
                'folder' => 'uploads' . $type
            ]
        );

        return $res['url'];
    }

    public function delete($id = '')
    {
        $this->upload->destroy($id);
    }
}
