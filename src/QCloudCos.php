<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2017/3/3
 * Time: 12:18
 */

namespace YueCode\Cos;

include_once __DIR__ . '/plugins/ErrorCode.php';
include_once __DIR__ . '/plugins/HttpClient.php';
include_once __DIR__ . '/plugins/LibCurlHelper.php';
include_once __DIR__ . '/plugins/LibCurlWrapper.php';
include_once __DIR__ . '/plugins/SliceUploading.php';
include_once __DIR__ . '/plugins/Auth.php';
include_once __DIR__ . '/plugins/CosApi.php';

class QCloudCos
{
    static private $conf;

    public function __construct($config)
    {
        self::$conf = $config["qcloudcos"];
        CosApi::setTimeout(self::$conf['time_out']);
        CosApi::setRegion(self::$conf['location']);
    }

    static public function getAppId()
    {
        return self::$conf['app_id'];
    }

    /*
     * 创建目录
     * @param  string  $bucket bucket名称
     * @param  string  $folder       目录路径
     * @param  string  $bizAttr    目录属性
     */
    static public function createFolder($bucket, $folder, $bizAttr = null)
    {
        $ret = CosApi::createFolder($bucket, $folder, $bizAttr);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /**
     * 上传文件,自动判断文件大小,如果小于20M则使用普通文件上传,大于20M则使用分片上传
     * @param  string  $bucket   bucket名称
     * @param  string  $srcPath      本地文件路径
     * @param  string  $dstPath      上传的文件路径
     * @param  string  $bizAttr      文件属性
     * @param  string  $slicesize    分片大小(512k,1m,2m,3m)，默认:1m
     * @param  string  $insertOnly   同名文件是否覆盖
     * @return [type]                [description]
     */
    static public function upload($bucket, $srcPath, $dstPath, $bizAttr=null, $sliceSize=null, $insertOnly=null)
    {
        $ret = Cosapi::upload($bucket, $srcPath, $dstPath, $bizAttr, $sliceSize, $insertOnly);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /*
     * 目录列表
     * @param  string  $bucket bucket名称
     * @param  string  $path     目录路径，sdk会补齐末尾的 '/'
     * @param  int     $num      拉取的总数
     * @param  string  $pattern  eListBoth,ListDirOnly,eListFileOnly  默认both
     * @param  int     $order    默认正序(=0), 填1为反序,
     * @param  string  $offset   透传字段,用于翻页,前端不需理解,需要往前/往后翻页则透传回来
     */
    static public function listFolder($bucket, $folder, $num = 20, $pattern = 'eListBoth', $order = 0, $context = null)
    {
        $ret = CosApi::listFolder($bucket, $folder, $num, $pattern, $order, $context);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /*
     * 目录更新
     * @param  string  $bucket bucket名称
     * @param  string  $folder      文件夹路径,SDK会补齐末尾的 '/'
     * @param  string  $bizAttr   目录属性
     */
    static public function updateFolder($bucket, $folder,$bizAttr = null)
    {
        $ret = Cosapi::updateFolder($bucket, $folder, $bizAttr);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /*
      * 查询目录信息
      * @param  string  $bucket bucket名称
      * @param  string  $folder       目录路径
      */
    static public function statFolder($bucket, $folder)
    {
        $ret = Cosapi::statFolder($bucket, $folder);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /*
     * 查询文件信息
     * @param  string  $bucket  bucket名称
     * @param  string  $path        文件路径
     */
    static public function stat($bucket, $path)
    {
        $ret = Cosapi::stat($bucket, $path);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /**
     * Copy a file.
     * @param $bucket bucket name.
     * @param $srcFpath source file path.
     * @param $dstFpath destination file path.
     * @param $overwrite if the destination location is occupied, overwrite it or not?
     * @return array|mixed.
     */
    static public function copyFile($bucket, $srcFpath, $dstFpath, $overwrite = false)
    {
        $ret = Cosapi::copyFile($bucket, $srcFpath, $dstFpath, $overwrite);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /**
     * Move a file.
     * @param $bucket bucket name.
     * @param $srcFpath source file path.
     * @param $dstFpath destination file path.
     * @param $overwrite if the destination location is occupied, overwrite it or not?
     * @return array|mixed.
     */
    static public function moveFile($bucket, $srcFpath, $dstFpath, $overwrite = false)
    {
        $ret = Cosapi::moveFile($bucket, $srcFpath, $dstFpath, $overwrite);
        return json_encode($ret,JSON_UNESCAPED_SLASHES);
    }

    /*
     * 删除文件
     * @param  string  $bucket
     * @param  string  $path      文件路径
     */
    static public function delFile($bucket, $path)
    {
        $ret = Cosapi::delFile($bucket, $path);
        return $ret;
    }

    /*
     * 删除目录
     * @param  string  $bucket bucket名称
     * @param  string  $folder       目录路径
     *  注意不能删除bucket下根目录/
     */
    static public function delFolder($bucket, $folder)
    {
        $ret = Cosapi::delFolder($bucket, $folder);
        return $ret;
    }

}