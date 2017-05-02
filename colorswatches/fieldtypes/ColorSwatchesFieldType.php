<?php
/**
 * Color Swatches plugin for Craft CMS
 *
 * ColorSwatches FieldType
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   ColorSwatches
 * @since     1.0.0
 */

namespace Craft;

class ColorSwatchesFieldType extends BaseOptionsFieldType
{

	private $_options;

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return Craft::t('Color Swatches');
	}

	/**
	 * @return mixed
	 */
	public function defineContentAttribute()
	{
		return AttributeType::Mixed;
	}

	/**
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'options' => array(AttributeType::Mixed),
		);
	}

	/**
	 * @return array
	 */
	public function getSettingsHtml()
	{
		$options = $this->getOptions();

		if (!$options)
		{
			// Give it a default row
			$options = array(array('color' => ''));
		}

		$config = array(
			'instructions' => Craft::t('Define the available colors.'),
			'id'           => 'options',
			'name'         => 'options',
			'addRowLabel'  => Craft::t('Add a color'),
			'cols'         => array(
				'label' => array(
					'heading' => Craft::t('Label'),
					'type' => 'singleline'
				),
				'color' => array(
					'heading' => Craft::t('Hex Color'),
					'type' => 'singleline'
				),
				'default' => array(
					'heading'      => Craft::t('Default?'),
					'type'         => 'checkbox',
					'class'        => 'thin'
				),
			),
			'rows' => $options
		);

		craft()->templates->includeCssResource('colorswatches/css/fields/ColorSwatchesFieldType.css');

		return craft()->templates->render('colorswatches/settings', array(
			'config' => $config
		));
	}

	/**
	 * @return array
	 */
	public function getOptions()
	{
		if (!isset($this->_options))
		{
			$this->_options = $this->getSettings()->options;
		}

		return $this->_options;
	}

		/**
	 * @inheritDoc IFieldType::validate()
	 *
	 * @param mixed $value
	 *
	 * @return true|string|array
	 */
	public function validate($value)
	{
		// If there is no value, we're good
		if (!$value)
		{
			return true;
		}

		// Encode the model to compare to acceptable options
		$value = json_encode(array(
			'label' => $value->label,
			'color' => $value->color
		));

		$valid = true;

		// Get all of the acceptable values
		$acceptableValues = array();

		foreach ($this->getOptions() as $option)
		{
			$optionArray = array(
				'label' => $option['label'],
				'color' => $option['color']
			);

			$acceptableValues[] = json_encode($optionArray);
		}

		// Make sure that the value is on the list
		if (!in_array($value, $acceptableValues))
		{
			$valid = false;
		}

		if (!$valid)
		{
			return Craft::t('{attribute} is invalid.', array(
				'attribute' => Craft::t($this->model->name)
			));
		}

		// All good
		return true;
	}

	/**
	 * @param string $name
	 * @param mixed  $value
	 * @return string
	 */
	public function getInputHtml($name, $value)
	{
		if (!$value) {
			$value = new ColorSwatchesModel();
		}

		$id = craft()->templates->formatInputId($name);
		$namespacedId = craft()->templates->namespaceInputId($id);

		craft()->templates->includeCssResource('colorswatches/css/fields/ColorSwatchesFieldType.css');

		$variables = array(
			'id' => $id,
			'name' => $name,
			'namespaceId' => $namespacedId,
			'values' => $value,
			'options' => $this->getOptions()
		);

		return craft()->templates->render('colorswatches/fields/ColorSwatchesFieldType', $variables);
	}

	/**
	 * @param mixed $value
	 * @return mixed
	 */
	public function prepValueFromPost($value)
	{
		if (empty($value)) {
			return new ColorSwatchesModel();
		} else {
			$values = json_decode($value);

			$model = new ColorSwatchesModel();
			$model->label = $values->label;
			$model->color = $values->color;

			return $model;
		}
	}

	/**
	 * @param mixed $value
	 * @return mixed
	 */
	public function prepValue($value)
	{
		return $value;
	}

	/**
	 * @inheritDoc BaseOptionsFieldType::getOptionsSettingsLabel()
	 *
	 * @return string
	 */
	protected function getOptionsSettingsLabel()
	{
		return Craft::t('Color Options');
	}
}
