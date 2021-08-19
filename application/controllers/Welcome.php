<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//MVC模式 model-view-control  在这三个文件夹中进行编程
//  访问
//   http://localhost/myci/welcome/login
//   http://localhost/项目名/控制器名/方法名

//访问control的方法之前要先改基础路径，默认的端口为80，apache服务器端口是8081
//在config.php第28行改基础路径 $config['base_url'] = 'http://localhost:8081/myci/';

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
    public function login(){
        $this->load->view('login');
    }
    public function regist(){
        $this->load->view('regist');

    }

    public function save(){

        //1.接收数据

        $name = $this->input->post('username');
        $pwd1 = $this->input->post('pwd1');
        $pwd2 = $this->input->post('pwd2');


        //2.验证
        $data = array(
            'name'=>$name
        );

        if($name == ''){
//            如果输入的用户名为空 则提示不能为空
            $data['name_error'] = "用户名不能为空";
//            this->load->view('regist',$data)是加载页面，地址栏会加载welcome/save 点击注册会重复添加一次页面内容，
//              这里应该用重定向redirect("welcome/regist") 相当于重新跳转路径
//			redirect("welcome/regist1?name=zs&pwd1=123");

        }
        if($pwd1 != $pwd2){
            $data['pwd_error'] = '两次密码不一致';

        }

        if(count($data) > 1){
            $this -> load->view('regist',$data);
        }else{

            //3.连接数据库(加载model, 调用model里面的方法)

            //先加载页面：this -> load ->要加载的页面

            $this -> load ->model("User_model");
            //再调用model里的方法
            $rows = $this -> User_model -> save($name,$pwd1);

            if($rows > 0){
                echo 'success';
            }else{
                echo 'fail';
            }
        }


        //4.跳转页面

//		echo 'save...';
    }



    public function login_check(){
//	    点击登录后 调用login_check  接收数据
        $name = $this -> input ->post('username');
        $pwd = $this -> input ->post('pwd1');
//        加载页面
        $this->load->model('User_model');
//        调用model里的方法  数据库生成的查询结果返回给result
        $result = $this->User_model->get_user_by_name_and_pwd($name,$pwd);

        //将用户信息存到session里面
        //   config中的384行 $config['sess_expiration'] = 7200; 需设置为0
        $this->session->set_userdata('user',$result);

//		var_dump($result);
//        跳转到welcome页面 把result传给user,在welcome页面中显示出来
        $this -> load ->view('welcome_message',array(
            'user'=> $result,
//            'age'=> 13
        ));

    }
    public function detail(){
        $this -> load ->view('detail');
    }



}
