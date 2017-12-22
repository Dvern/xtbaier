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

    //增加
    public function add()
    {
        //add_post 数据处理
        if($this->request->isPost()){
            $post = $this->request->post();

            //数据验证
            $result = $this->validate($post,$this->validate);
            if (true !== $result) {
                return $this->error($result);
            }

            //写入数据库
            $post['admin_password'] = Tool::get('helper')->getMd5($post['admin_password']);
            $add = AdminModel::create($post);
            if($add){

                //加入角色
                $authRoleUser = new AuthRoleUser();
                $authRoleUser->authRoleUserAdd($post['role'], $add['admin_id']);

                return $this->success(lang('Add success'), url($this->url));
            }else{
                return $this->error(lang('Add failed'));
            }
        }

        //页面渲染
        $info['role_html'] = self::role();

        return $this->fetch('',[
            'info' => $info
        ]);
    }

    //编辑
    public function edit()
    {
        $info = AdminModel::get($this->id);
        if(empty($info)){
          return abort(404, lang('404 not found'));
        }
        $info['role_html'] = self::role($info['role']);

        return $this->fetch('',[
            'info' => $info
        ]);
    }

}
