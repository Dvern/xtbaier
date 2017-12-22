<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\common\base;

use think\Controller;

/**
 * Description of BaseController
 *
 * @author Dvern
 */
class BaseController extends Controller {
    //put your code here
    
    public function __construct() {
        // 关闭错误报告
        // error_reporting(0);
        parent::__construct();
    }
    
}
