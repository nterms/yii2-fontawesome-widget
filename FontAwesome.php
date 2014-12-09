<?php
/**
* @copyright Copyright &copy; Saranga Abeykoon, nterms.com, 2014
* @package yii2-mediaelement-widget
* @version 1.0.0
*/

namespace nterms\fontawesome;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\widgets\InputWidget;

class FontAwesome extends InputWidget
{
	/**
	 * @var string the prefix for the icon name
	 */
	public $prefix = 'fa fa-';
	
	/**
	 * @var integer the height of the player in pixels
	 */
	public $height = 240;
	
	/**
	 * @var array the list of icons. All icons will be available by default.
	 */
	public $icons = [];
	
	/**
	 * @var array the HTML attributes for the container element.
	 */
	public $iconsOptions = [];
	
	/**
	 * @var array the HTML attributes for the icon.
	 */
	public $iconOptions = [];
	
	/**
	 * @var array the HTML attributes for the icon group wrapper.
	 */
	public $groupOptions = [];
		
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		if(empty($this->icons)) {
			$this->icons = $this->getIcons();
		}
		$this->renderInput();
	}
	
	/**
	 * Render the input.
	 */
	private function renderInput()
	{
		$view = $this->getView();
		
		$js = '$("video,audio").mediaelementplayer();';
		
		$view->registerJs($js, $view::POS_READY);
		
		if($this->hasModel()) {
			$input = Html::activeHiddenInput($this->model, $this->attribute, $this->options);
		} else {
			$input = Html::hiddenInput($this->name, $this->value, $this->options);
		}
		
		$icons = '';
		
		if(is_array(current($this->icons))) {
			$groupTag = (empty($this->groupOptions['tag']) ? 'div' : $this->groupOptions['tag']);
			
			foreach($this->icons as $key => $group) {
				if(!empty($group['icons'])) {
					$groupContent = '';
					if(!empty($group['title'])) {
						$groupContent .= Html::tag('h4', $group['title']);
					}
					
					$groupIcons = '';
					foreach($group['icons'] as $icon => $name) {
						$groupIcons .= Html::a(Html::tag('i', '', ['class' => $this->prefix . $icon]) . Html::tag('span', $name), '#', $this->iconOptions);
					}
					
					$groupContent .= Html::tag('div', $groupIcons);
					
					$icons .= Html::tag($groupTag, $groupContent, $this->groupOptions);
				}
			}
		} else {
			$icons .= Html::beginTag('div');
			foreach($this->icons as $icon => $name) {
				$icons .= Html::a(Html::tag('i', '', ['class' => $this->prefix . $icon]) . Html::tag('span', $name), '#', $this->iconOptions);
			}
			$icons .= Html::endTag('div');
		}
		 
		echo Html::tag('div', $input . "\n" . $icons, $this->iconsOptions);
	}
	
	private function getIcons()
	{
		return [
			'web-application' => [
				'title' => Yii::t('app','Web Application Icons'),
				'icons' => [
					'adjust' => 'adjust',
					'anchor' => 'anchor',
					'archive' => 'archive',
					'area-chart' => 'area-chart',
					'arrows' => 'arrows',
					'arrows-h' => 'arrows-h',
					'arrows-v' => 'arrows-v',
					'asterisk' => 'asterisk',
					'at' => 'at',
					'car' => 'automobile',
					'ban' => 'ban',
					'university' => 'bank',
					'bar-chart' => 'bar-chart',
					'bar-chart' => 'bar-chart-o',
					'barcode' => 'barcode',
					'bars' => 'bars',
					'beer' => 'beer',
					'bell' => 'bell',
					'bell-o' => 'bell-o',
					'bell-slash' => 'bell-slash',
					'bell-slash-o' => 'bell-slash-o',
					'bicycle' => 'bicycle',
					'binoculars' => 'binoculars',
					'birthday-cake' => 'birthday-cake',
					'bolt' => 'bolt',
					'bomb' => 'bomb',
					'book' => 'book',
					'bookmark' => 'bookmark',
					'bookmark-o' => 'bookmark-o',
					'briefcase' => 'briefcase',
					'bug' => 'bug',
					'building' => 'building',
					'building-o' => 'building-o',
					'bullhorn' => 'bullhorn',
					'bullseye' => 'bullseye',
					'bus' => 'bus',
					'taxi' => 'cab',
					'calculator' => 'calculator',
					'calendar' => 'calendar',
					'calendar-o' => 'calendar-o',
					'camera' => 'camera',
					'camera-retro' => 'camera-retro',
					'car' => 'car',
					'caret-square-o-down' => 'caret-square-o-down',
					'caret-square-o-left' => 'caret-square-o-left',
					'caret-square-o-right' => 'caret-square-o-right',
					'caret-square-o-up' => 'caret-square-o-up',
					'cc' => 'cc',
					'certificate' => 'certificate',
					'check' => 'check',
					'check-circle' => 'check-circle',
					'check-circle-o' => 'check-circle-o',
					'check-square' => 'check-square',
					'check-square-o' => 'check-square-o',
					'child' => 'child',
					'circle' => 'circle',
					'circle-o' => 'circle-o',
					'circle-o-notch' => 'circle-o-notch',
					'circle-thin' => 'circle-thin',
					'clock-o' => 'clock-o',
					'times' => 'close',
					'cloud' => 'cloud',
					'cloud-download' => 'cloud-download',
					'cloud-upload' => 'cloud-upload',
					'code' => 'code',
					'code-fork' => 'code-fork',
					'coffee' => 'coffee',
					'cog' => 'cog',
					'cogs' => 'cogs',
					'comment' => 'comment',
					'comment-o' => 'comment-o',
					'comments' => 'comments',
					'comments-o' => 'comments-o',
					'compass' => 'compass',
					'copyright' => 'copyright',
					'credit-card' => 'credit-card',
					'crop' => 'crop',
					'crosshairs' => 'crosshairs',
					'cube' => 'cube',
					'cubes' => 'cubes',
					'cutlery' => 'cutlery',
					'tachometer' => 'dashboard',
					'database' => 'database',
					'desktop' => 'desktop',
					'dot-circle-o' => 'dot-circle-o',
					'download' => 'download',
					'pencil-square-o' => 'edit',
					'ellipsis-h' => 'ellipsis-h',
					'ellipsis-v' => 'ellipsis-v',
					'envelope' => 'envelope',
					'envelope-o' => 'envelope-o',
					'envelope-square' => 'envelope-square',
					'eraser' => 'eraser',
					'exchange' => 'exchange',
					'exclamation' => 'exclamation',
					'exclamation-circle' => 'exclamation-circle',
					'exclamation-triangle' => 'exclamation-triangle',
					'external-link' => 'external-link',
					'external-link-square' => 'external-link-square',
					'eye' => 'eye',
					'eye-slash' => 'eye-slash',
					'eyedropper' => 'eyedropper',
					'fax' => 'fax',
					'female' => 'female',
					'fighter-jet' => 'fighter-jet',
					'file-archive-o' => 'file-archive-o',
					'file-audio-o' => 'file-audio-o',
					'file-code-o' => 'file-code-o',
					'file-excel-o' => 'file-excel-o',
					'file-image-o' => 'file-image-o',
					'file-video-o' => 'file-movie-o',
					'file-pdf-o' => 'file-pdf-o',
					'file-image-o' => 'file-photo-o',
					'file-image-o' => 'file-picture-o',
					'file-powerpoint-o' => 'file-powerpoint-o',
					'file-audio-o' => 'file-sound-o',
					'file-video-o' => 'file-video-o',
					'file-word-o' => 'file-word-o',
					'file-archive-o' => 'file-zip-o',
					'film' => 'film',
					'filter' => 'filter',
					'fire' => 'fire',
					'fire-extinguisher' => 'fire-extinguisher',
					'flag' => 'flag',
					'flag-checkered' => 'flag-checkered',
					'flag-o' => 'flag-o',
					'bolt' => 'flash',
					'flask' => 'flask',
					'folder' => 'folder',
					'folder-o' => 'folder-o',
					'folder-open' => 'folder-open',
					'folder-open-o' => 'folder-open-o',
					'frown-o' => 'frown-o',
					'futbol-o' => 'futbol-o',
					'gamepad' => 'gamepad',
					'gavel' => 'gavel',
					'cog' => 'gear',
					'cogs' => 'gears',
					'gift' => 'gift',
					'glass' => 'glass',
					'globe' => 'globe',
					'graduation-cap' => 'graduation-cap',
					'users' => 'group',
					'hdd-o' => 'hdd-o',
					'headphones' => 'headphones',
					'heart' => 'heart',
					'heart-o' => 'heart-o',
					'history' => 'history',
					'home' => 'home',
					'picture-o' => 'image',
					'inbox' => 'inbox',
					'info' => 'info',
					'info-circle' => 'info-circle',
					'university' => 'institution',
					'key' => 'key',
					'keyboard-o' => 'keyboard-o',
					'language' => 'language',
					'laptop' => 'laptop',
					'leaf' => 'leaf',
					'gavel' => 'legal',
					'lemon-o' => 'lemon-o',
					'level-down' => 'level-down',
					'level-up' => 'level-up',
					'life-ring' => 'life-bouy',
					'life-ring' => 'life-buoy',
					'life-ring' => 'life-ring',
					'life-ring' => 'life-saver',
					'lightbulb-o' => 'lightbulb-o',
					'line-chart' => 'line-chart',
					'location-arrow' => 'location-arrow',
					'lock' => 'lock',
					'magic' => 'magic',
					'magnet' => 'magnet',
					'share' => 'mail-forward',
					'reply' => 'mail-reply',
					'reply-all' => 'mail-reply-all',
					'male' => 'male',
					'map-marker' => 'map-marker',
					'meh-o' => 'meh-o',
					'microphone' => 'microphone',
					'microphone-slash' => 'microphone-slash',
					'minus' => 'minus',
					'minus-circle' => 'minus-circle',
					'minus-square' => 'minus-square',
					'minus-square-o' => 'minus-square-o',
					'mobile' => 'mobile',
					'mobile' => 'mobile-phone',
					'money' => 'money',
					'moon-o' => 'moon-o',
					'graduation-cap' => 'mortar-board',
					'music' => 'music',
					'bars' => 'navicon',
					'newspaper-o' => 'newspaper-o',
					'paint-brush' => 'paint-brush',
					'paper-plane' => 'paper-plane',
					'paper-plane-o' => 'paper-plane-o',
					'paw' => 'paw',
					'pencil' => 'pencil',
					'pencil-square' => 'pencil-square',
					'pencil-square-o' => 'pencil-square-o',
					'phone' => 'phone',
					'phone-square' => 'phone-square',
					'picture-o' => 'photo',
					'picture-o' => 'picture-o',
					'pie-chart' => 'pie-chart',
					'plane' => 'plane',
					'plug' => 'plug',
					'plus' => 'plus',
					'plus-circle' => 'plus-circle',
					'plus-square' => 'plus-square',
					'plus-square-o' => 'plus-square-o',
					'power-off' => 'power-off',
					'print' => 'print',
					'puzzle-piece' => 'puzzle-piece',
					'qrcode' => 'qrcode',
					'question' => 'question',
					'question-circle' => 'question-circle',
					'quote-left' => 'quote-left',
					'quote-right' => 'quote-right',
					'random' => 'random',
					'recycle' => 'recycle',
					'refresh' => 'refresh',
					'times' => 'remove',
					'bars' => 'reorder',
					'reply' => 'reply',
					'reply-all' => 'reply-all',
					'retweet' => 'retweet',
					'road' => 'road',
					'rocket' => 'rocket',
					'rss' => 'rss',
					'rss-square' => 'rss-square',
					'search' => 'search',
					'search-minus' => 'search-minus',
					'search-plus' => 'search-plus',
					'paper-plane' => 'send',
					'paper-plane-o' => 'send-o',
					'share' => 'share',
					'share-alt' => 'share-alt',
					'share-alt-square' => 'share-alt-square',
					'share-square' => 'share-square',
					'share-square-o' => 'share-square-o',
					'shield' => 'shield',
					'shopping-cart' => 'shopping-cart',
					'sign-in' => 'sign-in',
					'sign-out' => 'sign-out',
					'signal' => 'signal',
					'sitemap' => 'sitemap',
					'sliders' => 'sliders',
					'smile-o' => 'smile-o',
					'futbol-o' => 'soccer-ball-o',
					'sort' => 'sort',
					'sort-alpha-asc' => 'sort-alpha-asc',
					'sort-alpha-desc' => 'sort-alpha-desc',
					'sort-amount-asc' => 'sort-amount-asc',
					'sort-amount-desc' => 'sort-amount-desc',
					'sort-asc' => 'sort-asc',
					'sort-desc' => 'sort-desc',
					'sort-desc' => 'sort-down',
					'sort-numeric-asc' => 'sort-numeric-asc',
					'sort-numeric-desc' => 'sort-numeric-desc',
					'sort-asc' => 'sort-up',
					'space-shuttle' => 'space-shuttle',
					'spinner' => 'spinner',
					'spoon' => 'spoon',
					'square' => 'square',
					'square-o' => 'square-o',
					'star' => 'star',
					'star-half' => 'star-half',
					'star-half-o' => 'star-half-empty',
					'star-half-o' => 'star-half-full',
					'star-half-o' => 'star-half-o',
					'star-o' => 'star-o',
					'suitcase' => 'suitcase',
					'sun-o' => 'sun-o',
					'life-ring' => 'support',
					'tablet' => 'tablet',
					'tachometer' => 'tachometer',
					'tag' => 'tag',
					'tags' => 'tags',
					'tasks' => 'tasks',
					'taxi' => 'taxi',
					'terminal' => 'terminal',
					'thumb-tack' => 'thumb-tack',
					'thumbs-down' => 'thumbs-down',
					'thumbs-o-down' => 'thumbs-o-down',
					'thumbs-o-up' => 'thumbs-o-up',
					'thumbs-up' => 'thumbs-up',
					'ticket' => 'ticket',
					'times' => 'times',
					'times-circle' => 'times-circle',
					'times-circle-o' => 'times-circle-o',
					'tint' => 'tint',
					'caret-square-o-down' => 'toggle-down',
					'caret-square-o-left' => 'toggle-left',
					'toggle-off' => 'toggle-off',
					'toggle-on' => 'toggle-on',
					'caret-square-o-right' => 'toggle-right',
					'caret-square-o-up' => 'toggle-up',
					'trash' => 'trash',
					'trash-o' => 'trash-o',
					'tree' => 'tree',
					'trophy' => 'trophy',
					'truck' => 'truck',
					'tty' => 'tty',
					'umbrella' => 'umbrella',
					'university' => 'university',
					'unlock' => 'unlock',
					'unlock-alt' => 'unlock-alt',
					'sort' => 'unsorted',
					'upload' => 'upload',
					'user' => 'user',
					'users' => 'users',
					'video-camera' => 'video-camera',
					'volume-down' => 'volume-down',
					'volume-off' => 'volume-off',
					'volume-up' => 'volume-up',
					'exclamation-triangle' => 'warning',
					'wheelchair' => 'wheelchair',
					'wifi' => 'wifi',
					'wrench' => 'wrench',
				],
			],

			'file-type' => [
				'title' => Yii::t('app','File Type Icons'),
				'icons' => [
					'file' => 'file',
					'file-archive-o' => 'file-archive-o',
					'file-audio-o' => 'file-audio-o',
					'file-code-o' => 'file-code-o',
					'file-excel-o' => 'file-excel-o',
					'file-image-o' => 'file-image-o',
					'file-video-o' => 'file-movie-o',
					'file-o' => 'file-o',
					'file-pdf-o' => 'file-pdf-o',
					'file-image-o' => 'file-photo-o',
					'file-image-o' => 'file-picture-o',
					'file-powerpoint-o' => 'file-powerpoint-o',
					'file-audio-o' => 'file-sound-o',
					'file-text' => 'file-text',
					'file-text-o' => 'file-text-o',
					'file-video-o' => 'file-video-o',
					'file-word-o' => 'file-word-o',
					'file-archive-o' => 'file-zip-o',
				],
			],

			'spinner' => [
				'title' => Yii::t('app','Spinner Icons'),
				'icons' => [
					'circle-o-notch' => 'circle-o-notch',
					'cog' => 'cog',
					'cog' => 'gear',
					'refresh' => 'refresh',
					'spinner' => 'spinner',
				],
			],

			'form-control' => [
				'title' => Yii::t('app','Form Control Icons'),
				'icons' => [
					'check-square' => 'check-square',
					'check-square-o' => 'check-square-o',
					'circle' => 'circle',
					'circle-o' => 'circle-o',
					'dot-circle-o' => 'dot-circle-o',
					'minus-square' => 'minus-square',
					'minus-square-o' => 'minus-square-o',
					'plus-square' => 'plus-square',
					'plus-square-o' => 'plus-square-o',
					'square' => 'square',
					'square-o' => 'square-o',
				],
			],

			'payment' => [
				'title' => Yii::t('app','Payment Icons'),
				'icons' => [
					'cc-amex' => 'cc-amex',
					'cc-discover' => 'cc-discover',
					'cc-mastercard' => 'cc-mastercard',
					'cc-paypal' => 'cc-paypal',
					'cc-stripe' => 'cc-stripe',
					'cc-visa' => 'cc-visa',
					'credit-card' => 'credit-card',
					'google-wallet' => 'google-wallet',
					'paypal' => 'paypal',
				],
			],

			'chart' => [
				'title' => Yii::t('app','Chart Icons'),
				'icons' => [
					'area-chart' => 'area-chart',
					'bar-chart' => 'bar-chart',
					'bar-chart' => 'bar-chart-o',
					'line-chart' => 'line-chart',
					'pie-chart' => 'pie-chart',
				],
			],

			'currency' => [
				'title' => Yii::t('app','Currency Icons'),
				'icons' => [
					'btc' => 'bitcoin',
					'btc' => 'btc',
					'jpy' => 'cny',
					'usd' => 'dollar',
					'eur' => 'eur',
					'eur' => 'euro',
					'gbp' => 'gbp',
					'ils' => 'ils',
					'inr' => 'inr',
					'jpy' => 'jpy',
					'krw' => 'krw',
					'money' => 'money',
					'jpy' => 'rmb',
					'rub' => 'rouble',
					'rub' => 'rub',
					'rub' => 'ruble',
					'inr' => 'rupee',
					'ils' => 'shekel',
					'ils' => 'sheqel',
					'try' => 'try',
					'try' => 'turkish-lira',
					'usd' => 'usd',
					'krw' => 'won',
					'jpy' => 'yen',
				],
			],

			'text-editor' => [
				'title' => Yii::t('app','Text Editor Icons'),
				'icons' => [
					'align-center' => 'align-center',
					'align-justify' => 'align-justify',
					'align-left' => 'align-left',
					'align-right' => 'align-right',
					'bold' => 'bold',
					'link' => 'chain',
					'chain-broken' => 'chain-broken',
					'clipboard' => 'clipboard',
					'columns' => 'columns',
					'files-o' => 'copy',
					'scissors' => 'cut',
					'outdent' => 'dedent',
					'eraser' => 'eraser',
					'file' => 'file',
					'file-o' => 'file-o',
					'file-text' => 'file-text',
					'file-text-o' => 'file-text-o',
					'files-o' => 'files-o',
					'floppy-o' => 'floppy-o',
					'font' => 'font',
					'header' => 'header',
					'indent' => 'indent',
					'italic' => 'italic',
					'link' => 'link',
					'list' => 'list',
					'list-alt' => 'list-alt',
					'list-ol' => 'list-ol',
					'list-ul' => 'list-ul',
					'outdent' => 'outdent',
					'paperclip' => 'paperclip',
					'paragraph' => 'paragraph',
					'clipboard' => 'paste',
					'repeat' => 'repeat',
					'undo' => 'rotate-left',
					'repeat' => 'rotate-right',
					'floppy-o' => 'save',
					'scissors' => 'scissors',
					'strikethrough' => 'strikethrough',
					'subscript' => 'subscript',
					'superscript' => 'superscript',
					'table' => 'table',
					'text-height' => 'text-height',
					'text-width' => 'text-width',
					'th' => 'th',
					'th-large' => 'th-large',
					'th-list' => 'th-list',
					'underline' => 'underline',
					'undo' => 'undo',
					'chain-broken' => 'unlink',
				],
			],

			'directional' => [
				'title' => Yii::t('app','Directional Icons'),
				'icons' => [
					'angle-double-down' => 'angle-double-down',
					'angle-double-left' => 'angle-double-left',
					'angle-double-right' => 'angle-double-right',
					'angle-double-up' => 'angle-double-up',
					'angle-down' => 'angle-down',
					'angle-left' => 'angle-left',
					'angle-right' => 'angle-right',
					'angle-up' => 'angle-up',
					'arrow-circle-down' => 'arrow-circle-down',
					'arrow-circle-left' => 'arrow-circle-left',
					'arrow-circle-o-down' => 'arrow-circle-o-down',
					'arrow-circle-o-left' => 'arrow-circle-o-left',
					'arrow-circle-o-right' => 'arrow-circle-o-right',
					'arrow-circle-o-up' => 'arrow-circle-o-up',
					'arrow-circle-right' => 'arrow-circle-right',
					'arrow-circle-up' => 'arrow-circle-up',
					'arrow-down' => 'arrow-down',
					'arrow-left' => 'arrow-left',
					'arrow-right' => 'arrow-right',
					'arrow-up' => 'arrow-up',
					'arrows' => 'arrows',
					'arrows-alt' => 'arrows-alt',
					'arrows-h' => 'arrows-h',
					'arrows-v' => 'arrows-v',
					'caret-down' => 'caret-down',
					'caret-left' => 'caret-left',
					'caret-right' => 'caret-right',
					'caret-square-o-down' => 'caret-square-o-down',
					'caret-square-o-left' => 'caret-square-o-left',
					'caret-square-o-right' => 'caret-square-o-right',
					'caret-square-o-up' => 'caret-square-o-up',
					'caret-up' => 'caret-up',
					'chevron-circle-down' => 'chevron-circle-down',
					'chevron-circle-left' => 'chevron-circle-left',
					'chevron-circle-right' => 'chevron-circle-right',
					'chevron-circle-up' => 'chevron-circle-up',
					'chevron-down' => 'chevron-down',
					'chevron-left' => 'chevron-left',
					'chevron-right' => 'chevron-right',
					'chevron-up' => 'chevron-up',
					'hand-o-down' => 'hand-o-down',
					'hand-o-left' => 'hand-o-left',
					'hand-o-right' => 'hand-o-right',
					'hand-o-up' => 'hand-o-up',
					'long-arrow-down' => 'long-arrow-down',
					'long-arrow-left' => 'long-arrow-left',
					'long-arrow-right' => 'long-arrow-right',
					'long-arrow-up' => 'long-arrow-up',
					'caret-square-o-down' => 'toggle-down',
					'caret-square-o-left' => 'toggle-left',
					'caret-square-o-right' => 'toggle-right',
					'caret-square-o-up' => 'toggle-up',
				],
			],

			'video-player' => [
				'title' => Yii::t('app','Video Player Icons'),
				'icons' => [
					'arrows-alt' => 'arrows-alt',
					'backward' => 'backward',
					'compress' => 'compress',
					'eject' => 'eject',
					'expand' => 'expand',
					'fast-backward' => 'fast-backward',
					'fast-forward' => 'fast-forward',
					'forward' => 'forward',
					'pause' => 'pause',
					'play' => 'play',
					'play-circle' => 'play-circle',
					'play-circle-o' => 'play-circle-o',
					'step-backward' => 'step-backward',
					'step-forward' => 'step-forward',
					'stop' => 'stop',
					'youtube-play' => 'youtube-play',
				],
			],

			'brand' => [
				'title' => Yii::t('app','Brand Icons'),
				'icons' => [
					'adn' => 'adn',
					'android' => 'android',
					'angellist' => 'angellist',
					'apple' => 'apple',
					'behance' => 'behance',
					'behance-square' => 'behance-square',
					'bitbucket' => 'bitbucket',
					'bitbucket-square' => 'bitbucket-square',
					'btc' => 'bitcoin',
					'btc' => 'btc',
					'cc-amex' => 'cc-amex',
					'cc-discover' => 'cc-discover',
					'cc-mastercard' => 'cc-mastercard',
					'cc-paypal' => 'cc-paypal',
					'cc-stripe' => 'cc-stripe',
					'cc-visa' => 'cc-visa',
					'codepen' => 'codepen',
					'css3' => 'css3',
					'delicious' => 'delicious',
					'deviantart' => 'deviantart',
					'digg' => 'digg',
					'dribbble' => 'dribbble',
					'dropbox' => 'dropbox',
					'drupal' => 'drupal',
					'empire' => 'empire',
					'facebook' => 'facebook',
					'facebook-square' => 'facebook-square',
					'flickr' => 'flickr',
					'foursquare' => 'foursquare',
					'empire' => 'ge',
					'git' => 'git',
					'git-square' => 'git-square',
					'github' => 'github',
					'github-alt' => 'github-alt',
					'github-square' => 'github-square',
					'gittip' => 'gittip',
					'google' => 'google',
					'google-plus' => 'google-plus',
					'google-plus-square' => 'google-plus-square',
					'google-wallet' => 'google-wallet',
					'hacker-news' => 'hacker-news',
					'html5' => 'html5',
					'instagram' => 'instagram',
					'ioxhost' => 'ioxhost',
					'joomla' => 'joomla',
					'jsfiddle' => 'jsfiddle',
					'lastfm' => 'lastfm',
					'lastfm-square' => 'lastfm-square',
					'linkedin' => 'linkedin',
					'linkedin-square' => 'linkedin-square',
					'linux' => 'linux',
					'maxcdn' => 'maxcdn',
					'meanpath' => 'meanpath',
					'openid' => 'openid',
					'pagelines' => 'pagelines',
					'paypal' => 'paypal',
					'pied-piper' => 'pied-piper',
					'pied-piper-alt' => 'pied-piper-alt',
					'pinterest' => 'pinterest',
					'pinterest-square' => 'pinterest-square',
					'qq' => 'qq',
					'rebel' => 'ra',
					'rebel' => 'rebel',
					'reddit' => 'reddit',
					'reddit-square' => 'reddit-square',
					'renren' => 'renren',
					'share-alt' => 'share-alt',
					'share-alt-square' => 'share-alt-square',
					'skype' => 'skype',
					'slack' => 'slack',
					'slideshare' => 'slideshare',
					'soundcloud' => 'soundcloud',
					'spotify' => 'spotify',
					'stack-exchange' => 'stack-exchange',
					'stack-overflow' => 'stack-overflow',
					'steam' => 'steam',
					'steam-square' => 'steam-square',
					'stumbleupon' => 'stumbleupon',
					'stumbleupon-circle' => 'stumbleupon-circle',
					'tencent-weibo' => 'tencent-weibo',
					'trello' => 'trello',
					'tumblr' => 'tumblr',
					'tumblr-square' => 'tumblr-square',
					'twitch' => 'twitch',
					'twitter' => 'twitter',
					'twitter-square' => 'twitter-square',
					'vimeo-square' => 'vimeo-square',
					'vine' => 'vine',
					'vk' => 'vk',
					'weixin' => 'wechat',
					'weibo' => 'weibo',
					'weixin' => 'weixin',
					'windows' => 'windows',
					'wordpress' => 'wordpress',
					'xing' => 'xing',
					'xing-square' => 'xing-square',
					'yahoo' => 'yahoo',
					'yelp' => 'yelp',
					'youtube' => 'youtube',
					'youtube-play' => 'youtube-play',
					'youtube-square' => 'youtube-square',
				],
			],

			'medical' => [
				'title' => Yii::t('app','Medical Icons'),
				'icons' => [
					'ambulance' => 'ambulance',
					'h-square' => 'h-square',
					'hospital-o' => 'hospital-o',
					'medkit' => 'medkit',
					'plus-square' => 'plus-square',
					'stethoscope' => 'stethoscope',
					'user-md' => 'user-md',
					'wheelchair' => 'wheelchair',
				],
			],
		];
	}
}