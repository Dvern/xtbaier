<?php

namespace app\admin\controller;

use thinkcms\auth\Auth;
use thinkcms\auth\library\Tree;

class Index extends BasicController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $user = Auth::sessionGet('user');
        $this->assign('uname', $user['nickname']);
        $this->assign([
            'menu' => self::menu(),
        ]);
        return $this->fetch();
    }
	
	//更新菜单
	public function menu() {
		$this->fetch();
	}
	
	public function home() {
		$this->fetch();
	}
	
	public function update() {
		$this->fetch();
	}

}
