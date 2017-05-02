<?php
/**
 * Color Swatches plugin for Craft CMS
 *
 * Choose a color from a selection of admin defined colors
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   ColorSwatches
 * @since     1.0.0
 */

namespace Craft;

class ColorSwatchesPlugin extends BasePlugin
{
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
	public function getDescription()
	{
		return Craft::t('Choose a color from a selection of admin defined colors');
	}

	/**
	 * @return string
	 */
	public function getDocumentationUrl()
	{
		return 'https://github.com/vigetlabs/craft-color-swatches/blob/master/README.md';
	}

	/**
	 * @return string
	 */
	public function getReleaseFeedUrl()
	{
		return 'https://raw.githubusercontent.com/vigetlabs/craft-color-swatches/master/releases.json';
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return '1.0.0';
	}

	/**
	 * @return string
	 */
	public function getSchemaVersion()
	{
		return '1.0.0';
	}

	/**
	 * @return string
	 */
	public function getDeveloper()
	{
		return 'Trevor Davis';
	}

	/**
	 * @return string
	 */
	public function getDeveloperUrl()
	{
		return 'https://www.viget.com';
	}
}
