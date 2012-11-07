<?php

namespace bootstrap\widgets;

use CWidget;
use CJavaScript;
use CHtml;
use Yii;


/**
 * Modal class file.
 *
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @link http://phpindonesia.net/
 * @copyright Copyright &copy; 2012-2012 PHP ID Jawa Barat
 * @license http://phpindonesia.net/license
 * @version $Id$
 * @package Widgets
 * @since 1.0
 */
class Modal extends CWidget {
	/**
	 * @var boolean indicates whether to automatically open the modal when initialized. Defaults to 'false'.
	 */
	public $autoOpen = false;

	/**
	 * @var boolean indicates whether the modal should use transitions. Defaults to 'true'.
	 */
	public $fade = true;

	/**
	 * @var array the options for the Bootstrap Javascript plugin.
	 */
	public $options = array();

	/**
	 * @var string[] the Javascript event handlers.
	 */
	public $events = array();

	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		if (!isset($this->htmlOptions['id']))
			$this->htmlOptions['id'] = $this->getId();

		if ($this->autoOpen === false && !isset($this->options['show']))
			$this->options['show'] = false;

		$classes = array('modal');

		if ($this->fade === true)
			$classes[] = 'fade';

		if (!empty($classes))
		{
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class']))
				$this->htmlOptions['class'] .= ' ' . $classes;
			else
				$this->htmlOptions['class'] = $classes;
		}

		echo CHtml::openTag('div', $this->htmlOptions);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$id = $this->htmlOptions['id'];

		echo '</div>';

		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();

		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';
		$cs->registerScript(__CLASS__ . '#' . $id, "jQuery('#{$id}').modal({$options});");

		foreach ($this->events as $name => $handler)
		{
			$handler = CJavaScript::encode($handler);
			$cs->registerScript(__CLASS__ . '#' . $id . '_' . $name, "jQuery('#{$id}').on('{$name}', {$handler});");
		}
	}
}

?>
