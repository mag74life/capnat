<?php

// radioGroup
Form::macro('radioGroup', function($name, $options, $attributes = array()) {
	if (empty($options)) {
		return null;
	}
	
	$html = '<ol>';
	foreach ($options as $key => $value) {
		$attributes['id'] = $name . '-' . $key;
		$html .= '<li>'
			. Form::radio($name, $key, null, $attributes)
			. ' '
			. Form::label($attributes['id'], $value)
			. '</li>';
	}
	$html .= '</ol>';
	
	return $html;
});