<?php
/**
* @copyright Copyright &copy; Saranga Abeykoon, nterms.com, 2014
* @package yii2-fontawesome-widget
* @version 1.0.0
*/
namespace nterms\fontawesome;


use yii\web\AssetBundle;

/**
 * @author Saranga Abeykoon <amisaranga@gmail.com>
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/nterms/yii2-fontawesome-widget/assets/';
    public $js = [
        'fontawesome/fontawesome-and-player.min.js',
    ];
	public $css = [
		'fontawesome/fontawesome.css',
	];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
    ];
}
