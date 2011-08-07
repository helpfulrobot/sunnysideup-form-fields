<?php

class ColorField extends TextField {

	function __construct($name, $title = null, $value = '#000000') {
		parent::__construct($name, $title, $value);
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript('formfieldsextra/javascript/jquery/farbtastic.js');
		Requirements::javascript('formfieldsextra/javascript/jquery/colorfield.js');
		Requirements::css('formfieldsextra/css/ColorField.css');
		Requirements::css('formfieldsextra/css/farbtastic.css');//echo $this->value;
	}

	function Field() {
		$field = parent::Field();
		$field .= '<img src="formfieldsextra/images/colorfield/color-icon.png" class="coloricon"/><div class="colorpopup"></div>';
		return $field;
	}
}

class ColorField_ReadOnly extends ReadonlyField {

	function Field() {
		if($this->value) $value = $this->dontEscape ? ($this->reserveNL ? Convert::raw2xml($this->value) : $this->value) : Convert::raw2xml($this->value);
		else $value = '<i>(' . _t('FormField.NONE', 'none') . ')</i>';

		$attributes = array(
			'id' => $this->id(),
			'class' => 'readonly' . ($this->extraClass() ? $this->extraClass() : '')
		);
		if($this->value) $attributes['style'] = "background-color: $this->value";

		$hiddenAttributes = array(
			'type' => 'hidden',
			'name' => $this->name,
			'value' => $this->value,
			'tabindex' => $this->getTabIndex()
		);

		$containerSpan = $this->createTag('span', $attributes, $value);
		$hiddenInput = $this->createTag('input', $hiddenAttributes);

		return $containerSpan . "\n" . $hiddenInput;
	}

}

?>