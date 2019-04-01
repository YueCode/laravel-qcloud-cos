<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2019/4/1
 * Time: 17:33
 */

class CosTest extends TestCase
{
    protected $cos;
    protected $app_id;
    protected $bucket;

    public function setUp(): void
    {
        parent::setUp(); //
        $config = [];
        $app_id = 'XXX';
        $location = 'sh';
        $bucket = 'tests';

        $this->app_id = $app_id;
        $this->bucket = $bucket;
        $config['cos'] = [
            'version' => '4.2.3',
            'api_cos_api_end_point' => 'http://' . $location . '.file.myqcloud.com/files/v2/',
            'app_id' => $app_id,
            'secret_id' => 'XXX',
            'secret_key' => 'XXX',
            'user_agent' => 'cos-php-sdk-4.2.3',
            'time_out' => 180,
            'location' => $location
        ];
        $this->cos = new \YueCode\Cos\QCloudCos($config);
    }


    //测试获取app id
    public function testCosGetAppId()
    {
        $this->assertEquals($this->app_id, $this->cos->getAppId());
    }


    //测试获取创建目录
    public function testCosCreateFolder()
    {
        $folder = '/t1';
        $res = $this->cos->createFolder($this->bucket, $folder);
        $this->isJson($res);
        $data = json_decode($res);
        $folder = '/t3';
        $res = $this->cos->createFolder($this->bucket, $folder);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }

    //测试获取目录下文件列表
    public function testCosListFolder()
    {
        $folder = '/';
        $res = $this->cos->listFolder($this->bucket, $folder);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }

    //测试查找前缀
    public function testCosPrefixSearch()
    {
        $folder = '/t';
        $res = $this->cos->prefixSearch($this->bucket, $folder);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }

    //测试
    public function testCosUpdateFolder()
    {
        $folder = '/t1';
        $res = $this->cos->updateFolder($this->bucket, $folder);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }

    //测试删除目录
    public function testCosDelFolder()
    {
        $folder = '/t3';
        $res = $this->cos->delFolder($this->bucket, $folder);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }


    //测试查询目录属性
    public function testCosStatFolder()
    {
        $folder = '/t1';
        $res = $this->cos->statFolder($this->bucket, $folder);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }


    //测试上传文件
    public function testCosUpload()
    {
        $linuxSrcPath = '/www/image/1.jpg';
        $windowsSrcPath = 'E:/1.jpg';
        $dstPath = 't1/1.jpg';
        $res = $this->cos->upload($this->bucket, $windowsSrcPath, $dstPath);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }

    //测试查询文件属性
    public function testCosStat()
    {
        $dstPath = 't1/1.jpg';
        $res = $this->cos->stat($this->bucket, $dstPath);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }

    //测试复制文件
    public function testCosCopyFile()
    {
        $srcPath = 't1/1.jpg';
        $dstPath = 't1/2.jpg';
        $res = $this->cos->copyFile($this->bucket, $srcPath, $dstPath);
        $this->isJson($res);
        $data = json_decode($res);
        dd($data);
        $this->assertEquals($data->code, 0);
    }

    //测试移动文件
    public function testCosMoveFile()
    {
        $srcPath = 't1/1.jpg';
        $dstPath = 't1/3.jpg';
        $res = $this->cos->moveFile($this->bucket, $srcPath, $dstPath);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }

    //测试删除文件
    public function testCosDelFile()
    {
        $dstPath = 't1/1.jpg';
        $res = $this->cos->delFile($this->bucket, $dstPath);
        $this->isJson($res);
        $data = json_decode($res);
        $this->assertEquals($data->code, 0);
    }


}