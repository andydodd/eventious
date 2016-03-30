<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 25/08/15
 * Time: 10:19
 */
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description, Authorization, X-Requested-With');


function formatReturn($data){
	$result = json_encode(array('result' => $data));
	return $result;
}

switch ($_POST['type']) {
	case "footerBar":
		$result['content'] .='
			<a onclick="goTo(\'splash\');">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="goTo(\'about\');">About</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="goTo(\'faq\');">FAQ</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="goTo(\'privacy\');">Privacy Policy</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="goTo(\'terms\');">Ts &amp; Cs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			©Slicethepie Limited 2015
		';
		break;
	case "navigation":
		$result['content'] .='
			<li>
				<a href="" onclick="goTo(\'review\');return false;">Review</a>
			</li>
			<li>
				<a href="#">Account</a>
			</li>
			<li>
				<a href="#">Refer a friend</a>
			</li>
		';
		break;

}



$return = formatReturn($result);
echo $return;
