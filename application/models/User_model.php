<?php

//连接数据库  需要配置config里的database 数据库信息和autoload的61行
class User_model extends CI_Model
{
//    可以查看CI的用户手册  生成构造器类-插入数据
    public function save($name,$password){
        $data = array(
            'name' => $name,
            'password' => $password,
        );
        //把数据data插入到数据库表t_user里
        $query = $this->db->insert('t_user', $data);
        return $query;   //返回rows行数
    }



    public function get_user_by_name_and_pwd($name,$password){

//        get_where()根据条查询，生成查询结果
        $query = $this->db->get_where('t_user',array(
            'name'=>$name,
            'password'=>$password
        ));

        return $query->row();   //返回object对象  查出来是一个用户
//        return $query->result();   //返回array数组   查出来是链表 多个
    }
}