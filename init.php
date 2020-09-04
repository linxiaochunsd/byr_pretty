<?php

class Byr_Pretty extends Plugin {
	private $host;
	
	function about() {
		return array(
			1.0,
			"去除北邮人BT的RSS订阅Content中的css样式乱码",
			"linxiaochunsd",
		);
	}
	
	function flags() {
		return array();
	}
	
	function init($host) {
		$this->host = $host;
		
		$host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
	}
	
	function hook_article_filter($article) {
		$owner_uid = $article["owner_uid"];
		
		
		if (strpos($article["link"], "bt.byr.cn") !== false) {
			
			$article["plugin_data"] = "byr_pretty,$owner_uid:" . $article["plugin_data"];
			$article["content"]     = htmlspecialchars_decode(clean($article["content"]));
			
			$article["plugin_data"] = "byr_pretty,$owner_uid:" . $article["plugin_data"];
			$article["content"]     = htmlspecialchars_decode(clean($article["content"]));
			$article["content"] = str_replace("</fieldset>","</div>",$article["content"]);
			$article["content"] = str_replace("<fieldset ","<div ",$article["content"]);
		}
		
		return $article;
	}
	
	function api_version() {
		return 2;
	}
	
}
