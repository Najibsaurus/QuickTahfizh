<?php

/**
 * OauthController class file.
 *
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @link http://oneaccess.co.id/
 * @copyright Copyright &copy; 2012-2012 One Access Interactive
 * @license http://oneaccess.co.id/license
 * @version $Id$
 * @package system
 * @since 1.0
 */
class OauthController extends CController {

	/**
	 * Controller oauth/facebook
	 * this method print popup output for facebook connect dialog
	 * If user has connected this popup will closed and try to login through {@see \facebook\UserIdentity::login()} Component
	 */
	public function actionFacebook() {
		Yii::app()->getRequest()->urlReferrer;

		$redirectUrl = Yii::app()->user->returnUrl;
		if (Yii::app()->facebook->user === 0 && !isset($_GET['error'])) {
			$this->redirect(Yii::app()->facebook->getLoginUrl(array('scope' => 'email')));
		}
		else if (!isset($_GET['error'])) {
			//if cant login forward to register url 
			if (!Yii::app()->facebook->login()) {
				$redirectUrl = $this->createAbsoluteUrl(Yii::app()->facebook->registerUrl);
			}
			echo "<head>";
			echo "<script type='text/javascript'>
				window.opener.location.replace('" . $redirectUrl . "');
				window.close();
			</script>";
			echo "</head>";
		}
		else {
			echo "<head>";
			echo "<script type='text/javascript'>
				window.opener.location.reload();
				window.close();
			</script>";
			echo "</head>";
		}
		Yii::app()->end();
	}

	public function actionTwitter() {
		if (Yii::app()->twitter->getUserProfile() === null) {
			$this->redirect(Yii::app()->twitter->getLoginUrl());
		}
		else {
			echo "<script type='text/javascript'>
				window.opener.location.replace('" . Yii::app()->homeUrl . "');
				window.close();
			</script>";
		}
	}
}

?>
