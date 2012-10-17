<?php

namespace bootstrap\widgets;

\Yii::import('zii.widgets.grid.CGridView');
\Yii::import('zii.widgets.grid.CDataColumn');

/**
 * GridView class file.
 *
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @copyright Copyright &copy; 2012-2012 Php Indonesia <Dashboard Jawa Barat>
 * @version $Id$
 * @package bootstrap-2.1.1-widgets
 */
class GridView extends \CGridView
{
	/**
	 * @var string the CSS class bootstrap type for the container of all data item display. Defaults to 'items'.
	 */
	public $type = 'table';

	public function init()
	{
		$this->itemsCssClass = "table " . $this->type;
		parent::init();
	}

	public function registerClientScript()
	{
		\Yii::app()->getClientScript()->registerCss("GridView", "
			.grid tr.filters input {width: 80%;} 
			.grid tr.filters td{text-align: center;}");
		parent::registerClientScript();
	}
}

?>
