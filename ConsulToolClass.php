<?php

/**
 * 封装一个Consul工具类
 * Class ConsulToolClass
 */
class ConsulToolClass{

    public $ip = "114.215.190.171";
    public $port = "8500";

    /**
     * 注册服务
     * @param $json
     * @return mixed
     */
    public function registerService($json){
        return $this->curlPUT("/v1/agent/service/register",$json);
    }

    /**
     * 销毁服务
     * @param $service_id
     * @return mixed
     */
    public function deregisterService($service_id){
        return $this->curlPUT("/v1/agent/service/deregister/$service_id",null);
    }

    /**
     * PUT请求
     * @param $request_uri
     * @param $data
     * @return mixed
     */
    public function curlPUT($request_uri,$data){
        $ch = curl_init();
        $header[] = "Content-type:application/json";

        curl_setopt($ch,CURLOPT_URL,"http://".$this->ip.":".$this->port.$request_uri);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"PUT");
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }
}