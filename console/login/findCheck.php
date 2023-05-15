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
	
	// 接收参数
	$user_name = trim($_POST['user_name']);
	$user_email = trim($_POST['user_email']);
	$user_mb_answer = trim($_POST['user_mb_answer']);
	
	// sql防注入
    if(
        preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$user_name) || 
        preg_match("/[\',:;*?~`!#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$user_email) || 
        preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$user_mb_answer)){
            
            $result = array(
		        'code' => 203,
                'msg' => '你输入的内容包含了一些不安全字符'
	        );
	        echo json_encode($result,JSON_UNESCAPED_UNICODE);
	        exit;
    }else if(
        preg_match("/(and|or|select|update|drop|DROP|insert|create|delete|like|where|join|script|set)/i",$user_name) || 
        preg_match("/(and|or|select|update|drop|DROP|insert|create|delete|like|where|join|script|set)/i",$user_mb_answer)
    ){
        
        $result = array(
	        'code' => 203,
            'msg' => '你输入的内容包含了一些不安全字符'
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }
	
    // 过滤参数
    if(empty($user_name) || $user_name == '' || $user_name == null || !isset($user_name)){
        
        $result = array(
		    'code' => 203,
            'msg' => '账号未填写'
	    );
    }else if(preg_match("/[\x7f-\xff]/", $user_name)){
        
        $result = array(
		    'code' => 203,
            'msg' => '账号不能存在中文'
	    );
    }else if(preg_match("/[\',:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$user_name)){
        
        $result = array(
		    'code' => 203,
            'msg' => '账号不能存在特殊字符'
	    );
    }else if(empty($user_email) || $user_email == '' || $user_email == null || !isset($user_email)){
        
        $result = array(
		    'code' => 203,
            'msg' => '邮箱未填写'
	    );
    }else if(preg_match("/[\x7f-\xff]/", $user_email)){
        
        $result = array(
		    'code' => 203,
            'msg' => '邮箱不能存在中文'
	    );
    }else if(empty($user_mb_answer) || $user_mb_answer == '' || $user_mb_answer == null || !isset($user_mb_answer)){
        
        $result = array(
		    'code' => 203,
            'msg' => '密保问题答案未填写'
	    );
    }else{
        
        // 数据库配置
    	include '../Db.php';
    
    	// 实例化类
    	$db = new DB_API($config);
    
    	// 数据库huoma_user表
    	$huoma_user = $db->set_table('huoma_user');
    	
    	// 根据账号、邮箱、密保问题答案来验证用户信息的准确性
        $userinfoCheck = ['user_name'=>$user_name,'user_email'=>$user_email,'user_mb_answer'=>$user_mb_answer];
        $userinfoCheckResult = $huoma_user->find($userinfoCheck);
        if($userinfoCheckResult){
        
            $result = array(
                'code' => 200,
                'msg' => '验证通过'
            );
        }else{
            
            $result = array(
                'code' => 202,
                'msg' => '验证不通过'
            );
        }
        
    }

	// 输出JSON
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
	
?>