<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2019/4/1
 * Time: 11:42
 */

// 设置COS所在的区域，对应关系如下：
//     华南  -> gz
//     华东  -> sh
//     华北  -> tj
$location = 'sh';
// 版本号
$version = 'v4.2.3';
return [
    'version' => $version,
    'api_cos_api_end_point' =>  'http://'.$version.'.file.myqcloud.com/files/v2/',
    'app_id' => 'your app_id',
    'secret_id' => 'your secret_id',
    'secret_key' => 'your secret_key',
    'user_agent' => 'cos-php-sdk-'.$version,
    'time_out' => 180,
    'location' => $location,
];