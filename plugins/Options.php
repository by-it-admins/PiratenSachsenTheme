<?php

class ThemeOptions {
	public function init () {
		add_theme_page('PP Theme Options','PP Theme Options',9,'themeOptions',array(&$this,'optionsConstructor'));
	}
	
	public function optionsConstructor ($rtn = "") {
		
		$rtn .= $this->showStartPage();
		$rtn .= $this->showBoxList();
		$rtn .= $this->showBannerList();
		
		$rtn .= $this->showHeader();
		$rtn .= $this->showWelcome();
		$rtn .= $this->showPicture();
		
		View::displayOptions($rtn);
	}
	
	public function showStartPage ($rtn = "") {
		$set = unserialize(getOptions("idSet"));
		$values["startPage"] = $set["startpage"];
		$values["metaebene"] = $set["metaebene"];
		$values["blogCategory"] = $set["blogcategory"];
		$values["blogId"] = $set["blogid"];
		$values["privacyid"] = $set["privacyid"];
		$values["contactid"] = $set["contactid"];
		$values["imprintid"] = $set["imprintid"];
		if (isset($_POST["save_startpage_setting"])) {
			unset($_POST["save_startpage_setting"]);
			$set = serialize($_POST);
			setOption("idSet",$set);
			$rtn .= View::updated("IDs wurden gesetzt.");
			$values["startPage"] = $_POST["startpage"];
			$values["blogCategory"] = $_POST["blogcategory"];
			$values["blogId"] = $_POST["blogid"];
			$values["metaebene"] = $_POST["metaebene"];
			$values["privacyid"] = $_POST["privacyid"];
			$values["contactid"] = $_POST["contactid"];
			$values["imprintid"] = $_POST["imprintid"];
		}
		
		$rtn .= View::displayOptionIds($values);
		return $rtn;
	}
	
	public function showBoxList ($rtn = "") {
		
		$set = unserialize(getOptions("boxSet"));
		$boxName = $set["boxname"];
		$boxList = $set["boxlist"];
		if (isset($_POST["save_box_settings"])) {
			unset($_POST["save_box_settings"]);
			$set = serialize($_POST);
			setOption("boxSet",$set);
			$rtn .= View::updated("Die Box wurde definiert.");
			$boxName = $_POST["boxname"];
			$boxList = $_POST["boxlist"];
		}
		
		$rtn .= View::displayOptionBoxList($boxName,$boxList);
		return $rtn;
	}
	
	public function showBannerList ($rtn = "") {
		
		$bannerList = getOptions("bannerlist");
		if (isset($_POST["save_banner_settings"])) {
			setOption("bannerlist",$_POST["bannerlist"]);
			$rtn .= View::updated("Die Banner wurde definiert.");
			$bannerList = $_POST["bannerlist"];
		}
		
		$rtn .= View::displayOptionBannerList($bannerList);
		return $rtn;
	}
	
	
	public function showHeader ($rtn = "") {
		
		$header = getOptions("headerpicture");
		if (isset($_POST["save_header_settings"])) {
			setOption("headerpicture",$_POST["headerpic"]);
			$rtn .= View::updated("Der Header wurde definiert.");
			$header = $_POST["headerpic"];
		}
		
		$rtn .= View::displayOptionHeader($header);
		return $rtn;
	}
	
		public function showWelcome ($rtn = "") {
		
		$welcome = getOptions("welcometext");
		if (isset($_POST["save_welcome_settings"])) {
			setOption("welcometext",$_POST["welcometext"]);
			$rtn .= View::updated("Der Welcome Text wurde definiert.");
			$welcome = $_POST["welcometext"];
		}
		
		$rtn .= View::displayOptionWelcome($welcome);
		return $rtn;
	}
	
	public function showPicture ($rtn = "") {
		
		$picturedef = getOptions("welcomepicture");
		if (isset($_POST["save_picture_settings"])) {
			setOption("welcomepicture",$_POST["picturedef"]);
			$rtn .= View::updated("Das Picture wurde definiert.");
			$picturedef = $_POST["picturedef"];
		}
		
		$rtn .= View::displayOptionPicture($picturedef);
		return $rtn;
	}
}