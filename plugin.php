<?php
class adminTheme extends Plugin
{

	public function init()
	{
		$this->dbFields = array(
			'themeurl' => "",
			'customcss' => ""
		);
	}
	public function form()
	{
		$html = '<label>Set themes in admin area</label>
		<input type="text" name="themeurl" id="themeurl" placeholder="https://cdn.jsdelivr.net/npm/bootswatch@4.4.1/dist/darkly/bootstrap.min.css" value="' . $this->getValue('themeurl') . '">
		<br>
		<textarea name="customcss" id="customcss" placeholder="custom css code">' . $this->getValue('customcss') . '</textarea>
		<br>
		<div class="alert alert-info" role="alert">
		<strong>Info</strong>
		<br>
		To apply styles in the admin area, just copy the address of your css file into the input above and hit save.
		<br>
		Some Bludit elements might not look good, so you have to add custom css.
		</div>
		';
		$html .= '<h2>Bootswatch Themes</h2>';
		$html .= '<div class="row" id="bootswatch_themes"></div>';
		return $html;
	}
	public function adminHead()
	{
		return '
		<link rel="stylesheet" href="' . $this->getValue("themeurl") . '">
		<style>' . $this->getValue('customcss') . '</style>
		';
	}
	public function adminBodyEnd()
	{
		$scripts = "";
		$scripts .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js"></script>';
		$scripts .= '<script>' . file_get_contents($this->phpPath() . DS . 'main.js') . '</script>';
		return $scripts;
	}
}
