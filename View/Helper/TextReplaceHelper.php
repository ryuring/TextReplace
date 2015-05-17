<?php
/**
 * [Helper] TextReplace
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			TextReplace
 * @license			MIT
 */
class TextReplaceHelper extends AppHelper
{
	/**
	 * ヘルパー
	 *
	 */
	public $helpers = array('BcBaser');
	
	/**
	 * 検索語句
	 * 
	 * @var string
	 */
	public $searchText = '';
	
	/**
	 * 置換後
	 * 
	 * @var string
	 */
	public $replaceText = '';
	
	/**
	 * 設定ファイルの設定値
	 * 
	 * @var array
	 */
	public static $pluginSetting = array();
	
	/**
	 * constructor
	 * 
	 * @param \View $View
	 * @param array $settings
	 */
	function __construct(\View $View, $settings = array())
	{
		parent::__construct($View, $settings);
		self::setSelfValue();
	}
	
	/**
	 * 初期設定
	 * 
	 */
	public static function setSelfValue()
	{
		self::$pluginSetting = Configure::read('TextReplace.target');
	}
	
	/**
	 * 検索語句を置換後で置換する
	 * 
	 * @param string $data
	 * @return string
	 */
	public function getReplaceData($data = '')
	{
		$result = '';
		if ($this->request->data['TextReplace']['search_regex']) {
			$result = preg_replace($this->searchText, $this->replaceText, $data);
		} else {
			$result = str_replace($this->searchText, $this->replaceText, $data);
		}
		return $result;
	}
	
	/**
	 * モデル名とタイトルのリストを取得する
	 * 
	 * @return array
	 */
	public function getModelList()
	{
		$setting = self::$pluginSetting;
		$list = array();
		foreach ($setting as $model => $fieldData) {
			$list[$fieldData['name']] = $fieldData['title'];
		}
		return $list;
	}
	
}
