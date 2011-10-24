<?php

class View {
	public static function updated ($text) {
		return '<div class="updated"><p>'.$text.'</p></div>';
	}
	
	public static function error ($text) {
		return '<div class="error"><p>'.$text.'</p></div>';
	}
	
	public static function displayOptions ($html) {
		$rtn = '<div class="wrap">
				 <h2>Piratenpartei Theme Options</h2>
				 '.$html.'
				</div>';
		echo $rtn;
	}
	
	public static function displayEvents ($html) {
		$rtn = '<div class="wrap">
				 <h2>TinyEvents - Terminverwaltung</h2>
				 '.$html.'
				</div>';
		echo $rtn;
	}

	public static function contentBox ($title, $content, $width = "75%") {
		$rtn = '<div id="poststuff" class="metabox-holder has-right-sidebar" style="width:'.$width.';">
				 <div id="post-body">
				  <div id="post-body-content">
				   <div class="stuffbox">
				    <h3>'.$title.'</h3>
				    <div class="inside">
				     '.$content.'
				    </div>
				   </div>
				  </div>
				 </div>
				</div>';
		return $rtn;
	}
	
	public static function displayOptionIds ($values,$rtn = "") {
		$title = "Wichtige IDs festlegen";
		$content = '<form method="post" action="">
					 <p style="float: left; width: 25%;">Welche ID hat die Startseite?</p>
					 <input id="startpage" type="text" value="'.$values["startPage"].'" tabindex="1" name="startpage" style="width:50%;float: left;" />
					 <br class="clear" />
					 <p style="float: left; width: 25%;">Welche ID hat die Metaebene?</p>
					 <input id="metaebene" type="text" value="'.$values["metaebene"].'" tabindex="1" name="metaebene" style="width:50%;float: left;" />
					 <br class="clear" />
					 <p style="float: left; width: 25%;">Welche ID hat die Blog-Ober-Kategorie?</p>
					 <input id="blogcategory" type="text" value="'.$values["blogCategory"].'" tabindex="1" name="blogcategory" style="width:50%;float: left;" />
					 <br class="clear" />
					 <p style="float: left; width: 25%;">Welche ID hat die Blog-Seite?</p>
					 <input id="blogid" type="text" value="'.$values["blogId"].'" tabindex="1" name="blogid" style="width:50%;float: left;" />
					 <br class="clear" />
					 <p style="float: left; width: 25%;">Welche ID hat die Datenschutz-Seite?</p>
					 <input id="privacyid" type="text" value="'.$values["privacyid"].'" tabindex="1" name="privacyid" style="width:50%;float: left;" />
					 <br class="clear" />
					 <p style="float: left; width: 25%;">Welche ID hat die Kontakt-Seite?</p>
					 <input id="contactid" type="text" value="'.$values["contactid"].'" tabindex="1" name="contactid" style="width:50%;float: left;" />
					 <br class="clear" />
					 <p style="float: left; width: 25%;">Welche ID hat die Impressum-Seite?</p>
					 <input id="imprintid" type="text" value="'.$values["imprintid"].'" tabindex="1" name="imprintid" style="width:50%;float: left;" />
					 <br class="clear" />
					 <input name="save_startpage_setting" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="speichern" style="float: right;" />';
		$content .= '<br class="clear" />
					</form>';
		$rtn = View::contentBox($title,$content);
		return $rtn;
	}
	
	public static function displayOptionBoxList ($boxname,$boxlist,$rtn = "") {
		$title = "Klappbox definieren";
		$content = '<form method="post" action="">
					 <p style="float: left; width: 25%;">Titel der Box?</p>
					 <input id="boxname" type="text" value="'.$boxname.'" tabindex="1" name="boxname" style="width:50%;float: left;" />
					 <br class="clear" />
					 <p style="float: left; width: 25%;">Definiere die Box-Inhalte<br /><small>linkname::linkurl<br />Ein Eintrag pro Zeile</small></p>
					 <textarea cols="40" id="boxlist" name="boxlist" rows="10">'.$boxlist.'</textarea>
					 <br class="clear" />
					 <input name="save_box_settings" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="speichern" style="float: right;" />';
		$content .= '<br class="clear" />
					</form>';
		$rtn = View::contentBox($title,$content);
		return $rtn;
	}
	
	public static function displayOptionBannerList ($bannerlist,$rtn = "") {
		$title = "Banner definieren";
		$content = '<form method="post" action="">
					 <p style="float: left; width: 25%;">Definiere die Banner-Inhalte<br /><small>bild::url<br />Ein Eintrag pro Zeile</small></p>
					 <textarea cols="40" id="bannerlist" name="bannerlist" rows="10">'.$bannerlist.'</textarea>
					 <br class="clear" />
					 <input name="save_banner_settings" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="speichern" style="float: right;" />';
		$content .= '<br class="clear" />
					</form>';
		$rtn = View::contentBox($title,$content);
		return $rtn;
	}
	
	public static function displayOptionHeader ($header, $rtn = "") {
		$title = "Header definieren";
		$content = '<form method="post" action="">
					 <p style="float: left; width: 25%;">Definiere das Header Bild<br /><small>relativer Pfad</small></p>
					 <textarea cols="40" id="headerpic" name="headerpic" rows="5">'.$header.'</textarea>
					 <br class="clear" />
					 <input name="save_header_settings" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="speichern" style="float: right;" />';
		$content .= '<br class="clear" />
					</form>';
		$rtn = View::contentBox($title,$content);
		return $rtn;
	}
	
	public static function displayOptionPicture ($picturedef, $rtn = "") {
		$title = "Oberes Bild definieren";
		$content = '<form method="post" action="">
					 <p style="float: left; width: 25%;">Definiere das Header Bild<br /><small>relativer Pfad</small></p>
					 <textarea cols="40" id="picturedef" name="picturedef" rows="5">'.$picturedef.'</textarea>
					 <br class="clear" />
					 <input name="save_picture_settings" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="speichern" style="float: right;" />';
		$content .= '<br class="clear" />
					</form>';
		$rtn = View::contentBox($title,$content);
		return $rtn;
	}
	
	public static function displayOptionWelcome ($welcome, $rtn = "") {
		$title = "Welcometext definieren";
		$content = '<form method="post" action="">
					 <p style="float: left; width: 25%;">Definiere den Welcometext<br /><small>HTML</small></p>
					 <textarea cols="40" id="welcometext" name="welcometext" rows="5">'.$welcome.'</textarea>
					 <br class="clear" />
					 <input name="save_welcome_settings" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="speichern" style="float: right;" />';
		$content .= '<br class="clear" />
					</form>';
		$rtn = View::contentBox($title,$content);
		return $rtn;
	}
	
	public static function displayEventsAdd ($values,$rtn = "") {
		$title = "Event eintragen";
		$content = '<form method="post" action="">
					 <p style="float: left; width: 110px; margin: 0 5px 0 0;">
					  Datum (jjjj-mm-dd)<br />
					  <input type="text" name="date" id="date" value="'.$values["date"].'" style="width: 105px;" />
					 </p>
					 <p style="float: left; width: 100px; margin: 0 5px 0 0;">
					  Ort<br />
					  <input type="text" name="town" id="town" value="'.$values["town"].'" style="width: 95px;" />
					 </p>
					 <p style="float: left; width: 235px; margin: 0 5px 0 0;">
					  Titel<br />
					  <input type="text" name="title" id="title" value="'.$values["title"].'" style="width: 230px;" />
					 </p>
					 <p style="float: left; width: 235px; margin: 0 5px 0 0;">
					  Link<br />
					  <input type="text" name="link" id="link" value="'.$values["link"].'" style="width: 230px;" />
					 </p>
					 <p style="float: left; width: 66px; margin: 0 5px 0 0;">
					  &nbsp;<br />
					  <input name="save_events_add" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="speichern" style="float: right;" />
					 </p>';
		$content .= '<br class="clear" />
					</form>';
		$rtn = View::contentBox($title,$content,"1090px");
		return $rtn;
	}
	
	public static function displayEventsEdit ($forms,$rtn = "") {
		$title = "Events editieren";
		$content = $forms;
		$rtn = View::contentBox($title,$content,"1090px");
		return $rtn;
	}
	
	public static function displayEventsEditform ($values,$rtn = "") {
		$rtn = '<form method="post" action="">
					 <p style="float: left; width: 110px; margin: 0 5px 0 0;">
					  Datum (jjjj-mm-dd)<br />
					  <input type="text" name="date" id="date" value="'.$values->post_date.'" style="width: 105px;" />
					 </p>
					 <p style="float: left; width: 100px; margin: 0 5px 0 0;">
					  Ort<br />
					  <input type="text" name="town" id="town" value="'.$values->post_name.'" style="width: 95px;" />
					 </p>
					 <p style="float: left; width: 235px; margin: 0 5px 0 0;">
					  Titel<br />
					  <input type="text" name="title" id="title" value="'.$values->post_title.'" style="width: 230px;" />
					 </p>
					 <p style="float: left; width: 235px; margin: 0 5px 0 0;">
					  Link<br />
					  <input type="text" name="link" id="link" value="'.$values->post_excerpt.'" style="width: 230px;" />
					 </p>
					 <p style="float: left; width: 66px; margin: 0 5px 0 0;">
					  <span class="delete"><a class="submitdelete" href="'.get_bloginfo("url").'/wp-admin/edit.php?post_type=page&page=tinyEvents&delete='.$values->ID.'">l&ouml;schen</a></span><br />
					  <input type="hidden" name="ID" value="'.$values->ID.'" />
					  <input name="save_events_edit" type="submit" class="button-secondary" id="publish" tabindex="4" accesskey="p" value="editieren" style="float: right;" />
					 </p>';
		$rtn .= '<br class="clear" /><br />
					</form>';
		return $rtn;
	}
	
	public static function displayEventsDelete ($rtn = "") {
		$title = "Alle vergangenen Events l&ouml;schen";
		$content = '<form method="post" action="">
					 <input name="delete_old_events" type="submit" class="button-primary" id="publish" tabindex="4" accesskey="p" value="Es werden alle vergangenen Termine gel&ouml;scht" />
					</form>';
		$rtn = View::contentBox($title,$content,"1090px");
		return $rtn;
	}
}