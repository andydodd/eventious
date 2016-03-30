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

define('DEFAULT_CONTENT_01','<h1>Refer a friend</h1><p>Invite your friends and receive a bonus of <b>10% of all their review earnings</b>!</p>
                    <p>Commission from their reviews will be added straight to your balance.</p>

				<p><a onclick="goTo(\'login\');return false;">Login</a> to get your unique referral link</p>');
define('DEFAULT_CONTENT_02','<h1>Track of the day</h1><p>Get a great new track sent to your inbox every single day</p>');


function formatReturn($data){
	$result = json_encode(array('result' => $data));
	return $result;
}

switch ($_POST['type']) {
	case "splash":
		$result['content'] .='
	<div class="splashBox">
		<div class="contentBox doubleBox splash_helper">
			<h1>Get paid to write reviews</h1>
			<div class="bumper" style="height: 3vmin;"></div>
			<p>Discover and influence the latest music and fashion trends - 24 hours a day!</p>
			<div class="bumper" style="height: 3vmin;"></div>
			<h1 class="bling bling_dollaz">2,024,680</h1>
			<h1 class="bling bling_thumbz">16,871,176</h1>
			<p class="bling">Dollars earned</p>
			<p class="bling">Reviews submitted</p>
		</div>
		<div id="loginBox" class="contentBox singleBox whiteBack">
			<h1>Have your say</h1>
			<div class="bumper" style="height: 1vmin;"></div>
			<p>Start Earning now, We want your opinion on the latest trends and tracks!</p>
			<form>
				<input type="text" name="Email" placeholder="Email"/>
				<input type="password" name="Password" placeholder="Password"/>
			</form>
			<div class="bumper" style="height: 1vmin;"></div>
			<button>sign in</button><br>
			<button>learn more</button>

		</div>

	</div>

	<div class="contentBox halfBox">
		<h1>What is Slicethepie?</h1>
		<p>We help people make decisions.</p>
		<p>It\'s simple. We pay you to write reviews on new songs, commercials and fashion items before they release.</p>
		<p>Most of your reviews go directly to unsigned artists or fashion designers to give them feedback. You also help us to find the best brands and artists to put forward for radio placement and other advertisement opportunities.</p>
		<button>learn more</button>
	</div>

	<div class="contentBox halfBox">
		<div class="contentBox fullBox redBack boxShadow">
			<h1>Discover</h1>
			<p>Get a great new track sent to your inbox every single day</p>
			<button>sign up</button>
		</div>
		<div class="contentBox fullBox greenBack boxShadow">
			<h1>Refer a Friend</h1>
			<p>Invite your friends and receive commission for every review they submit!</p>
			<button>learn more</button>
		</div>
	</div>
		';
		break;
	case "review":
		$result['content'] .='Review';
		$result['redirect'] ='login';
		break;
	case "login":
		$result['content'] .='Login';
		break;
	case "about":
		$result['content'] .='
			<div id="contentBox_1" class="contentBox singleBox whiteBack boxShadow">
				'.DEFAULT_CONTENT_01.'
			</div>
			<div id="contentBox_2" class="contentBox singleBox">
				<h1>About Slicethepie</h1>
				<p>Slicethepie was launched back in 2007 as a fun and interactive site to identify the best up and coming artists. It soon evolved into the web’s largest music review engine that now gives on demand feedback to record labels and thousands of independent artists every month.</p>

<p>Recently we have also started working with fashion retailers in the UK and US to help them decide what garments are going to resonate most strongly with consumers when they hit the stores. So if you have opted in you will increasingly be asked to review fashion items which you may well see on the high street in a few months time!</p>

<p>We pay you for your opinion and you can review 24/7!<br>
<br>
If you have any questions about using the site just hop over to our <a href="" onclick="goTo(\'faq\');">FAQs.</a></p>

			</div>
			<div id="contentBox_3" class="contentBox singleBox whiteBack boxShadow">
				'.DEFAULT_CONTENT_02.'
			</div>
		';
		$result['box_order'][3] = "contentBox_3";
		$result['box_order'][2] = "contentBox_2";
		$result['box_order'][1] = "contentBox_1";
		break;
}

$return = formatReturn($result);
echo $return;
