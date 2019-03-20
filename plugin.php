<?php
class adminTheme extends Plugin {
	
	public function init(){
		$this->dbFields = array(
			'themeurl'=>"",
			'customcss'=>""
		);
	}
	public function form(){
		$html = '<label>Set themes in admin area</label>';
		
		$html = <<<EOF
		<input type="text" name="themeurl" id="themeurl" placeholder="https://bootswatch.com/4/darkly/bootstrap.min.css" value="{$this->getValue('themeurl')}">
		<br>
		<textarea name="customcss" id="customcss" placeholder="custom css code">{$this->getValue('customcss')}</textarea>
		<br>
		<div class="alert alert-info" role="alert">
		<strong>Info</strong>
		<br>
		pick recommended themes from <a href="https://bootswatch.com/" target="_blank">https://bootswatch.com/</a>
		<br>
		To get the styles, just copy the address of [yourtheme].min.css / [yourtheme].css into the input above and hit save
		<br>
		Some Bludit elements might not look good, so you have to add custom css.
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js"></script>
		<script>autosize(document.querySelector('textarea'));</script>
		EOF;
		
		return $html;
	}
	public function adminSidebar(){
		$adminpath = HTML_PATH_ADMIN_ROOT;
		$html = <<<EOF
		<link rel="stylesheet" href="{$this->getValue('themeurl')}">
		<style>{$this->getValue('customcss')}</style>
		<li class="nav-item"><a class="nav-link" href="{$adminpath}configure-plugin/adminTheme">Admin Themes</a></li>
		EOF;
		
		return $html;
	}
}