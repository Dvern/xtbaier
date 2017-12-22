<?php

namespace app\admin\controller;

use thinkcms\auth\Auth;
use thinkcms\auth\library\Tree;

class Index extends BasicController {

    public function __construct()
    {

        parent::__construct();
        $this->id       = !empty($this->request->param('id'))?intval($this->request->param('id')):$this->id;
        $this->validate = [
            ['admin_name|用户名', 'require|unique:admin,admin_name,'.$this->id.',admin_id'],
            ['admin_email|邮箱', 'email'],
            ['admin_password|密码', 'require'],
            ['role|角色', 'require'],
        ];

        $nav = [
            '员工列表' =>['url'=>'admin/index'],
            '员工增加' =>['url'=>'admin/add'],
            '员工修改' =>['url'=>['admin/edit', ['id' => $this->id]], 'style'=>"display: none;"],
        ];
        $this->assign('navTabs',  parent::navTabs($nav));
    }

    //首页
    public function index()
    {
        $list = AdminModel::paginate(20);

        return $this->fetch('',[
            'list'  => $list,
            'page'  => $list->render()
        ]);
    }

    public function GetAllUserInfo() {
        $userinfo = new Userinfo();
        echo $userinfo->GetAllUserInfo();
    }
}
