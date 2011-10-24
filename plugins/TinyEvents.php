<?php

class TinyEvents {
	public function init () {
		add_pages_page('TinyEvents','TinyEvents',9,'tinyEvents',array(&$this,'tinyEventsConstructor'));
	}
	
	public function tinyEventsConstructor ($rtn = "") {
		
		if (isset($_POST["save_events_add"])) {
			foreach ($_POST as $key => $value) {
				if (trim($value) == "") {
					$error = TRUE;
				}
				$values[$key] = $value;
			}
			
			if ($error) {
				$rtn .= View::error("Bitte f&uuml;llen Sie alles aus!");
			}
			else {
				$this->putEvent($values);
				$rtn .= View::updated("Event hinzugef&uuml;gt.");
			}
		}
		
		if (isset($_POST["save_events_edit"])) {
			$this->putEventEdit($_POST);
			$rtn .= View::updated("Event editiert.");
		}
		
		if (isset($_GET["delete"])) {
			$this->deleteEvent($_GET["delete"]);
			$rtn .= View::updated("Event gel&ouml;scht.");
		}
		
		if (isset($_POST["delete_old_events"])) {
			$this->deleteOldEvents();
			$rtn .= View::updated("Es wurden alle vergangenen Termine gel&ouml;scht.");
		}
		
		$rtn .= $this->addEvent();
		$rtn .= $this->deleteAllEvents();
		$rtn .= $this->editEvents();
		
		View::displayEvents($rtn);
	}
	
	public function addEvent ($rtn = "") {
		$rtn .= View::displayEventsAdd($values);
		return $rtn;
	}
	
	public function deleteAllEvents ($rtn = "") {
		$rtn .= View::displayEventsDelete();
		return $rtn;
	}
	
	public function editEvents ($rtn = "") {
		
		$forms = "";
		$events = $this->getEvents();
		foreach ($events as $values) {
			$values->post_date = substr($values->post_date,0,10);
			$forms .= View::displayEventsEditform($values);
		}
		$rtn .= View::displayEventsEdit($forms);
		return $rtn;
	}
	
	public function putEventEdit ($values) {
		global $wpdb;
		$values["date"] = $wpdb->escape($values["date"]." 00:00:00");
		$values["town"] = $wpdb->escape($values["town"]);
		$values["title"] = $wpdb->escape($values["title"]);
		$values["link"] = $wpdb->escape($values["link"]);
		$wpdb->query("UPDATE ".$wpdb->prefix."posts
							SET `post_date` = '".$values["date"]."',
								`post_title` = '".$values["title"]."',
								`post_excerpt` = '".$values["link"]."',
								`post_name` = '".$values["town"]."'
							WHERE `id` = '".$values["ID"]."'");
	}
	
	public function putEvent ($values) {
		global $wpdb;
		$values["date"] = $wpdb->escape($values["date"]." 00:00:00");
		$values["town"] = $wpdb->escape($values["town"]);
		$values["title"] = $wpdb->escape($values["title"]);
		$values["link"] = $wpdb->escape($values["link"]);
		$wpdb->query("INSERT INTO ".$wpdb->prefix."posts
							SET `post_date` = '".$values["date"]."',
								`post_title` = '".$values["title"]."',
								`post_type` = 'event',
								`post_excerpt` = '".$values["link"]."',
								`post_name` = '".$values["town"]."'");
	}
	
	public function deleteEvent ($id) {
		global $wpdb;
		$id = $wpdb->escape($id);
		$wpdb->query("DELETE FROM ".$wpdb->prefix."posts WHERE `id` = '".$id."'");
	}
	
	public function deleteOldEvents () {
		global $wpdb;
		echo "DELETE FROM ".$wpdb->prefix."posts WHERE `post_type` = 'event' AND `post_date` < NOW()";
		$wpdb->query("DELETE FROM ".$wpdb->prefix."posts WHERE `post_type` = 'event' AND `post_date` < NOW()");
	}
	
	public function getEvents () {
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE `post_type` = 'event' ORDER BY `post_date` ASC");
	}
}