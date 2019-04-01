<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2017/3/3
 * Time: 12:18
 */

namespace YueCode\Cos;


use YueCode\Cos\QCloud\CosApi;


class QCloudCos
{
    static protected $conf;
    static protected $cosApi;

    function __construct($config)
    {
        self::$conf = $config["cos"];
        self::$cosApi = new CosApi(self::$conf);
    }

    /**
     * @return mixed
     */
    public static function getAppId()
    {
        return self::$conf['app_id'];
    }


    /*
     * 创建目录
     * @param  string  $bucket bucket名称
     * @param  string  $folder       目录路径
     * @param  string  $bizAttr    目录属性
     */
    public static function createFolder($bucket, $folder, $bizAttr = null)
    {
        $ret = self::$cosApi->createFolder($bucket, $folder, $bizAttr);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /**
     * 上传文件,自动判断文件大小,如果小于20M则使用普通文件上传,大于20M则使用分片上传
     * @param  string $bucket bucket名称
     * @param  string $srcPath 本地文件路径
     * @param  string $dstPath 上传的文件路径
     * @param  string $bizAttr 文件属性
     * @param  string $slicesize 分片大小(512k,1m,2m,3m)，默认:1m
     * @param  string $insertOnly 同名文件是否覆盖
     * @return [type]                [description]
     */
    public static function upload($bucket, $srcPath, $dstPath, $bizAttr = null, $sliceSize = null, $insertOnly = null)
    {
        $ret = self::$cosApi->upload($bucket, $srcPath, $dstPath, $bizAttr, $sliceSize, $insertOnly);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /*
     * 目录列表
     * @param  string  $bucket bucket名称
     * @param  string  $path     目录路径，sdk会补齐末尾的 '/'
     * @param  int     $num      拉取的总数
     * @param  string  $pattern  eListBoth,ListDirOnly,eListFileOnly  默认both
     * @param  int     $order    默认正序(=0), 填1为反序,
     * @param  string     透传字段,用于翻页,前端不需理解,需要往前/往后翻页则透传回来
     */
    public static function listFolder($bucket, $folder, $num = 20, $pattern = 'eListBoth', $order = 0, $context = null)
    {
        $ret = self::$cosApi->listFolder($bucket, $folder, $num, $pattern, $order, $context);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /*
     * 目录列表(前缀搜索)
     * @param  string  $bucket bucket名称
     * @param  string  $prefix   列出含此前缀的所有文件
     * @param  int     $num      拉取的总数
     * @param  string  $pattern  eListBoth(默认),ListDirOnly,eListFileOnly
     * @param  int     $order    默认正序(=0), 填1为反序,
     * @param  string     透传字段,用于翻页,前端不需理解,需要往前/往后翻页则透传回来
     */
    public static function prefixSearch($bucket, $prefix, $num = 20, $pattern = 'eListBoth', $order = 0, $context = null)
    {
        $ret = self::$cosApi->prefixSearch($bucket, $prefix, $num, $pattern, $order, $context);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /*
     * 目录更新
     * @param  string  $bucket bucket名称
     * @param  string  $folder      文件夹路径,SDK会补齐末尾的 '/'
     * @param  string  $bizAttr   目录属性
     */
    public static function updateFolder($bucket, $folder, $bizAttr = null)
    {
        $ret = self::$cosApi->updateFolder($bucket, $folder, $bizAttr);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /*
      * 查询目录信息
      * @param  string  $bucket bucket名称
      * @param  string  $folder       目录路径
      */
    public static function statFolder($bucket, $folder)
    {
        $ret = self::$cosApi->statFolder($bucket, $folder);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /*
     * 查询文件信息
     * @param  string  $bucket  bucket名称
     * @param  string  $path        文件路径
     */
    public static function stat($bucket, $path)
    {
        $ret = self::$cosApi->stat($bucket, $path);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /**
     * Copy a file.
     * @param string $bucket bucket name.
     * @param string $srcFPath source file path.
     * @param string $dstFPath destination file path.
     * @param boolean $overwrite if the destination location is occupied, overwrite it or not?
     * @return array|mixed.
     */
//    public static function copyFile($bucket, $srcFPath, $dstFPath, $overwrite = false)
//    {
//        $ret = self::$cosApi->copyFile($bucket, $srcFPath, $dstFPath, $overwrite);
//        return json_encode($ret, JSON_UNESCAPED_SLASHES);
//    }

    /**
     * Move a file.
     * @param string $bucket bucket name.
     * @param string $srcFPath source file path.
     * @param string $dstFPath destination file path.
     * @param boolean $overwrite if the destination location is occupied, overwrite it or not?
     * @return array|mixed.
     */
//    public static function moveFile($bucket, $srcFpath, $dstFpath, $overwrite = false)
//    {
//        $ret = self::$cosApi->moveFile($bucket, $srcFpath, $dstFpath, $overwrite);
//        return json_encode($ret, JSON_UNESCAPED_SLASHES);
//    }

    /*
     * 删除文件
     * @param  string  $bucket
     * @param  string  $path      文件路径
     */
    public static function delFile($bucket, $path)
    {
        $ret = self::$cosApi->delFile($bucket, $path);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

    /*
     * 删除目录
     * @param  string  $bucket bucket名称
     * @param  string  $folder       目录路径
     *  注意不能删除bucket下根目录/
     */
    public static function delFolder($bucket, $folder)
    {
        $ret = self::$cosApi->delFolder($bucket, $folder);
        return json_encode($ret, JSON_UNESCAPED_SLASHES);
    }

}