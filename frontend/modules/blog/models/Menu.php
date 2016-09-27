<?php
namespace frontend\modules\blog\models;

use yii\db\ActiveRecord;
use Yii;

class Menu extends ActiveRecord {

	public static function tableName()
	{
		return '{{%menu}}';
	}

	public function rules()
	{
		return [
			[['name'], 'required'],
			[['url', 'link'], 'safe'],
		];
	}
}