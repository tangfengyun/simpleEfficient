<?php
/**
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/18
 * Time: 16:28
 */
class AdminModel extends Model{
    public function check($admin_name,$admin_pass){
        $sql = "select * from bg_admin where admin_name = $admin_name and admin_pass = md5('$admin_pass')";
        return $this->dao->fetchRow($sql);
    }

    public function updateAdminInfo($admin_id)
    {
        //获取服务器的相关信息$_SESSION
        $login_ip = $_SERVER["REMOTE_ADDR"];
        $login_time =time();
        $sql = "update bg_admin set log_ip = '$login_ip',login_time ='$login_time', login_nums=login_nums+1 where admin_id= $admin_id ";
        return $this->dao->my_query($sql);
    }
}