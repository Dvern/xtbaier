<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\common\model;

use app\common\tool\Tool;

/**
 * Description of AdminModel
 *
 * @author Dvern
 */
class AdminModel extends BasicModel {
    //put your code here
    
    // 设置完整的数据表（包含前缀）
    protected $name = 'admin';

    protected $type = [
        'role' => 'array'
    ];
    
    //初始化属性
    protected function initialize()
    {

    }

    /**
     * 获取器 last_login_ip  long2ip 转换Ip地址
     *
     * @return string
     */
    public function getLastLoginIpAttr($value,$data){
        $info = \thinkcms\auth\model\ActionLog::where('user_id', $data['admin_id'])->column('action_ip');
        $index = count($info) - 1;
        if($index >= 0) {
            return long2ip($info[$index]);
        } else {
            return long2ip($value);
        }   
    }
    
    /**
     * 后台登录数据处理
     *
     * @param  string  $param
     * @return string
     */
    public static function login($param)
    {
        $result = self::get(['admin_name'=>$param['admin_name']]);

        if(!empty($result)){
            $password   = Tool::get('helper')->getMd5($param['admin_password']);

            if($password === $result->admin_password && $result->login_priv == '1'){
                return $result;
            }
        }

        return false;
    }
    
}
