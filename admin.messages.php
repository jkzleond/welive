<?php

// +---------------------------------------------+
// |     Copyright  2010 - 2028 WeLive           |
// |     http://www.weentech.com                 |
// |     This file may not be redistributed.     |
// +---------------------------------------------+

define('AUTH', true);

include('includes/welive.Core.php');
include(BASEPATH . 'includes/welive.Admin.php');

if($userinfo['usergroupid'] != 1) exit();

PrintHeader($userinfo['username'], 'messages');

$success[] = '抱歉, 免费版无此功能, 但不影响WeLive的正常使用.';
$success[] = '此功能方便管理员查阅、管理客服人员的交流记录.';
$success[] = 'WeLive商业版仅售 <span class=blueb>100</span> 元, 一次性付费, 永久使用及免费升级.';
$success[] = '购买商业版: QQ <span class=note>20577229</span> (加入时请注明: <span class=note>WeLive商业版</span>) <BR>&nbsp;&nbsp;&nbsp;&nbsp;或 致电 <a href="http://www.weentech.com/" target="_blank">闻泰网络</a>. 感谢您的支持!';

$successtitle = '功能限制说明';

BR(6);

PrintSuss($success, $successtitle);


PrintFooter();

?>