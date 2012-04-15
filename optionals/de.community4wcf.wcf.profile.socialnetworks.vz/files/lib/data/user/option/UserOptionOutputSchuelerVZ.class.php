<?php
// wcf imports
require_once(WCF_DIR.'lib/data/user/User.class.php');
require_once(WCF_DIR.'lib/data/user/option/UserOptionOutput.class.php');
require_once(WCF_DIR.'lib/data/user/option/UserOptionOutputContactInformation.class.php');

/*
 * Implements an SchuelerVZ Profilefield
 * @package		de.community4wcf.wcf.profile.socialnetworks.vz
*/
 
class UserOptionOutputSchuelerVZ implements UserOptionOutput, UserOptionOutputContactInformation {
	protected $type = 'schuelervz';
	
	/*
	 * getURL from Options
	*/
	public function getURL() {
		return $url = 'http://www.schuelervz.net/#Profile/U:@';
	}
	
	/*
	 * @see UserOptionOutput::getShortOutput()
	*/
	public function getShortOutput(User $user, $optionData, $value) {
		if (empty($value)) return '';
		return $this->getLink($user, $this->getImage($user, 'S'), $value);
	}

	/*
	 * @see UserOptionOutput::getMediumOutput()
	*/
  
	public function getMediumOutput(User $user, $optionData, $value) {
		if (empty($value)) return '';
		return $this->getLink($user, $this->getImage($user), $value);
	}
	
	/*
	 * @see UserOptionOutput::getOutput()
	*/
   
	public function getOutput(User $user, $optionData, $value) {
		if (empty($value)) return '';
		return $this->getImage($user) . ' ' . $this->getLink($user, StringUtil::encodeHTML($value), $value);
	}
	
	/*
	 * @see UserOptionContactInformation::getOutput()
	*/
   
	public function getOutputData(User $user, $optionData, $value) {
		if (empty($value)) return null;
	
		return array(
			'icon' => StyleManager::getStyle()->getIconPath($this->type.'M.png'),
			'title' => WCF::getLanguage()->get('wcf.user.option.'.$optionData['optionName']),
			'value' => StringUtil::encodeHTML($value),
			'url' => $this->getURL().StringUtil::encodeHTML($value)
		);
	}

	/*
	 * Returns the icon html code.
	 * 
	 * @return	string 
	*/
   
	protected function getImage(User $user, $imageSize = 'M') {
		$title = WCF::getLanguage()->get('wcf.user.profile.'.$this->type.'.title', array('$username' => StringUtil::encodeHTML($user->username)));
		return '<img src="'.RELATIVE_WCF_DIR.'icon/'.$this->type.$imageSize.'.png" alt="" title="'.$title.'" />';
	}
	
	/*
	 * Returns the link html code.
	 * 
	 * @return	string 
	*/
   
	protected function getLink(User $user, $title, $value) {
		return '<a href="'.$this->getURL().StringUtil::encodeHTML($value).'">'.$title.'</a>';
	}
}
?>