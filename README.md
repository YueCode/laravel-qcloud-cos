# laravel-qcloud-cos v4.2.3 for Laravel 5

###
laravel-qcloud-cos

腾讯云V4对象存储的composer包

###### ***************************

# laravel Installation
### Install via composer
Run the following command to pull in the latest version:
###### composer命令安装扩展包
```php
composer require jingling0101/laravel-qcloud-cos
```

### After updating composer, add the ServiceProvider to the providers array in ``` config/app.php ```
###### 配置config/app.php中providers数组 ``` config/app.php ```
```php
'providers' => [

        /*
         * Application Service Providers...
         */
         ......
        YueCode\Cos\QCloudCosServiceProvider::class,
    ],
```

### To publish the config settings in Laravel 5 use:
###### 执行命令复制COS配置文件到config目录
```php
php artisan vendor:publish --provider="YueCode\Cos\QCloudCosServiceProvider"
```

### Configure config 
###### 配置config/cos.php 
```php
config/cos.php 
```

# Usage
######  使用
```php

......

    // 云对象存储V4 Bucket
    $bucket = 'your bucket';

    
    $cos = app('cos');

     /*
     * 创建目录
     * @param  string  $bucket bucket名称
     * @param  string  $folder       目录路径
     * @param  string  $bizAttr    目录属性
     */
     $cos->createFolder($bucket, $folder, $bizAttr);
    
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
     $cos->upload($bucket, $srcPath, $dstPath, $bizAttr, $sliceSize, $insertOnly);

    /*
     * 目录列表
     * @param  string  $bucket bucket名称
     * @param  string  $path     目录路径，sdk会补齐末尾的 '/'
     * @param  int     $num      拉取的总数
     * @param  string  $pattern  eListBoth,ListDirOnly,eListFileOnly  默认both
     * @param  int     $order    默认正序(=0), 填1为反序,
     * @param  string     透传字段,用于翻页,前端不需理解,需要往前/往后翻页则透传回来
     */
     $cos->listFolder($bucket, $folder, $num, $pattern, $order, $context);
 

    /*
     * 目录列表(前缀搜索)
     * @param  string  $bucket bucket名称
     * @param  string  $prefix   列出含此前缀的所有文件
     * @param  int     $num      拉取的总数
     * @param  string  $pattern  eListBoth(默认),ListDirOnly,eListFileOnly
     * @param  int     $order    默认正序(=0), 填1为反序,
     * @param  string     透传字段,用于翻页,前端不需理解,需要往前/往后翻页则透传回来
     */
     $cos->prefixSearch($bucket, $prefix, $num, $pattern, $order, $context);


    /*
     * 目录更新
     * @param  string  $bucket bucket名称
     * @param  string  $folder      文件夹路径,SDK会补齐末尾的 '/'
     * @param  string  $bizAttr   目录属性
     */
     $cos->updateFolder($bucket, $folder, $bizAttr);

     /*
      * 查询目录信息
      * @param  string  $bucket bucket名称
      * @param  string  $folder       目录路径
      */
      $cos->statFolder($bucket, $folder);

    /*
     * 查询文件信息
     * @param  string  $bucket  bucket名称
     * @param  string  $path        文件路径
     */
     $cos->stat($bucket, $path);


    /**
     * Copy a file.
     * @param $bucket bucket name.
     * @param $srcFpath source file path.
     * @param $dstFpath destination file path.
     * @param $overwrite if the destination location is occupied, overwrite it or not?
     * @return array|mixed.
     */
     $cos->copyFile($bucket, $srcFpath, $dstFpath, $overwrite);
 

    /**
     * Move a file.
     * @param $bucket bucket name.
     * @param $srcFpath source file path.
     * @param $dstFpath destination file path.
     * @param $overwrite if the destination location is occupied, overwrite it or not?
     * @return array|mixed.
     */
     $cos->moveFile($bucket, $srcFpath, $dstFpath, $overwrite);


    /*
     * 删除文件
     * @param  string  $bucket
     * @param  string  $path      文件路径
     */
     $cos->delFile($bucket, $path);

    /*
     * 删除目录
     * @param  string  $bucket bucket名称
     * @param  string  $folder       目录路径
     *  注意不能删除bucket下根目录/
     */
     $cos->delFolder($bucket, $folder);
  

```



###### ***************************





# Lumen Installation

### Install via composer
Run the following command to pull in the latest version:
```php
composer require jingling0101/laravel-qcloud-cos
```
Bootstrap file changes.
Add the following snippet to the bootstrap/app.php file under the providers section as follows:
###### 添加以下代码到```bootstrap/app``` 文件中 Register Service Providers 部分
```php
$app->register(YueCode\Cos\QCloudCosServiceProvider::class);
```
### Configure config 
###### 配置config/cos.php 
```php
config/cos.php 
```
