<?php

    /**
     * 状态码说明
     * 200 成功
     * 201 未登录
     * 202 失败
     * 203 空值
     * 204 无结果
     */

	// 页面编码
	header("Content-type:application/json");
	
    // 判断登录状态
    session_start();
    if(isset($_SESSION["yinliubao"])){
        
        // 数据库配置
    	include '../Db.php';
    
    	// 实例化类
    	$db = new DB_API($config);
    
    	// 数据库huoma_user表
    	$huoma_user = $db->set_table('huoma_user');
    	
    	// 已登录
        // 获取用户管理权限
        $getadmin = ['user_name'=>$_SESSION["yinliubao"]];
        $getadminResult = $huoma_user->find($getadmin);
        $user_admin = json_decode(json_encode($getadminResult))->user_admin;
        $user_name = json_decode(json_encode($getadminResult))->user_name;
    
        $result = array(
            'code' => 200,
            'msg' => '已登录',
            'user_name' => $user_name,
            'user_admin' => $user_admin
        );
    }else{
        
        // 未登录
        $result = array(
            'code' => 201,
            'msg' => '未登录或登录过期'
        );
    }

    // 输出JSON
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>