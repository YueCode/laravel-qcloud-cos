<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2017/3/3
 * Time: 12:17
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
    'api_cos_api_end_point' =>  'http://sh.file.myqcloud.com/files/v2/',
    'app_id' => '123456',
    'secret_id' => 'CCC',
    'secret_key' => 'DDD',
    'user_agent' => 'cos-php-sdk-'.$version,
    'time_out' => 180,
    'location' => $location,
];