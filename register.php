<?php

// 引入Consul工具类
require_once("./ConsulToolClass.php");

$http = new swoole_http_server("114.215.190.171", 9111);
$http->set(array('worker_num' => 4));


// 监听start事件
$http->on('start', function () {
    $data = array(
        "ID"=>"sw_service1",
        "Name"=>"sw_service1",
        "Tags"=>array("primary"),
        "Address"=>"114.215.190.171",
        "Port"=>9111,
        "Check"=>array("HTTP"=>"114.215.190.171","Interval"=>"5s")
    );

    $consul = new ConsulToolClass();
    $consul->registerService(json_encode($data)); //往Consul里注册服务
});


// 监听request请求
$http->on('request', function ($request, $response) {
    $response->end('ok');
});


// 开始
$http->start();