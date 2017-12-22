<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\common\tool;

use think\form\HtmlBuilder;

/**
 * Description of Tool
 *
 * @author Dvern
 */
class Tool {
    //put your code here
    
    public static $form;

    public static function get($name)
    {
       switch($name){
            case 'helper':
                return new Helper();
            case 'form':
                //单列form类
                if(!self::$form){
                    self::$form =  new Form(new HtmlBuilder(),['name' => '__token__','type' => 'md5']);
                }
                return self::$form;
           case 'file':
                return new File(CONF_PATH.'extra'.DS.'basic.php');
            default:
                return '没有这个工具';
        }
    }
    
}
