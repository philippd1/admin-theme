<?php
class adminTheme extends Plugin {
	
	public function init(){
		$this->dbFields = array(
			'themeurl'=>"",
			'customcss'=>""
		);
	}
	public function form(){
		$html = '<label>Set themes in admin area</label>
		<input type="text" name="themeurl" id="themeurl" placeholder="https://bootswatch.com/4/darkly/bootstrap.min.css" value="'.$this->getValue('themeurl').'">
		<br>
		<textarea name="customcss" id="customcss" placeholder="custom css code">'.$this->getValue('customcss').'</textarea>
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
		<script>autosize(document.querySelector("textarea"));</script>
		<script>
		function setTheme(themeurl){
			document.getElementById("themeurl").value = themeurl;
			document.getElementsByName("save")[0].click();
		}
		</script>
		';
		
		$themes = json_decode(file_get_contents("https://bootswatch.com/api/4.json"));
		$themes = $themes->themes;
		$html .= '<h2>Bootswatch Themes</h2>';
		$html .= '<style>.preview {background: #dee2e6;margin-bottom: 1rem;padding: 1rem;}</style>';
		$html .= '<div class="row">';
		foreach ($themes as $theme) {
			$html .= '<div class="col-lg-4 col-sm-6"><div class="preview"><div class="image"><img style="width: 100%;" src="'.$theme->thumbnail.'" class="img-responsive" alt="Cerulean"></div><div class="options"><h3>'.$theme->name.'</h3><p>'.$theme->description.'</p><div><span name="themeurl" onclick="setTheme(`'.$theme->cssCdn.'`)" class="btn btn-primary btn-block" href="'.$theme->cssCdn.'">use theme</span></div></div></div></div>';
		}
		$html .= '</div>';
		
		return $html;
	}
	public function adminSidebar(){
		$adminpath = HTML_PATH_ADMIN_ROOT;
		$html = '
		<link rel="stylesheet" href="'.$this->getValue("themeurl").'">
		<style>'.$this->getValue('customcss').'</style>
		<li class="nav-item"><a class="nav-link" href="'.$adminpath.'configure-plugin/adminTheme">Admin Themes</a></li>
		';
		
		return $html;
	}
}