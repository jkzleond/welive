<?php
ini_set('display_errors', 1);
header('Content-Type:text/html;charset=utf-8');
include('includes/welive.Core.php');

header_nocache();

if($_CFG['cActived'])
{
	$online_cache_file = BASEPATH.'cache/online_cache.php';

	@include($online_cache_file);

	if(!isset($welive_onlines) OR !is_array($welive_onlines)){
		$welive_onlines = storeCache();
		if(!$welive_onlines) die('Save cache failed!');
	}

	$from_url = base64_encode($_SERVER['HTTP_REFERER']);
	$cm_user_id = isset($_GET['userId']) ? $_GET['userId'] : '';

	$online_users = array();
	$offline_users = array();

	foreach($welive_onlines as $usergroup)
	{
		foreach($usergroup['user'] as $user_id => $user)
		{
			//print_r($user);
			if( $user['type'] != 1 ) continue;

			if( $user['isonline'] == 1 )
			{
				$online_users[$user_id] = $user;
			}
			else
			{
				$offline_users[$user_id] = $user;
			}
		}
	}

	$vvckey = PassGen(8);
	$code = null;

	if( !empty($online_users) )
	{
		$rand_key = array_rand($online_users);
		$selected_user = $online_users[$rand_key];
		$code = base64_encode(authcode(COOKIE_KEY.$rand_key, 'ENCODE', $vvckey, 3600));
	}
	elseif( !empty($offline_users) )
	{
		$rand_key = array_rand($offline_users);
		$selected_user = $online_users[$rand_key];
		$code = base64_encode(authcode(COOKIE_KEY.$rand_key, 'ENCODE', $vvckey, 3600));
	}
	else
	{
		die('系统没有添加客服');
	}

	/*if($selected_user['isonline'])
	{*/
	$location_url = BASEURL.'enter.php?uid='.$rand_key.'&code='.$code.'&vvckey='.$vvckey.'&url='.$from_url.'&cm_user_id='.$cm_user_id;
	/*}
	else
	{
		$location_url = BASEURL.'comment.php?uid='.$rand_key.'&code='.$code.'&vvckey='.$vvckey.'&cm_user_id='.$cm_user_id;
	}*/

	header('Location:'.$location_url);
}
else
{
	echo '客服系统已停用';
}