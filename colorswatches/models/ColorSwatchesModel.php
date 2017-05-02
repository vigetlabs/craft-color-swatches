<?php
/**
 * Color Swatches plugin for Craft CMS
 *
 * ColorSwatches Model
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   ColorSwatches
 * @since     1.0.0
 */

namespace Craft;

class ColorSwatchesModel extends BaseModel
{
	/**
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), array(
			'label' => array(AttributeType::String),
			'color' => array(AttributeType::String),
		));
	}

	/**
	 * Use the label as its string representation.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->label;
	}

}
