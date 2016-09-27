<?php
namespace backend\models;

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
			['name', 'required'],
			[['url', 'link'], 'safe'],
		];
	}

	public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'link' => 'Страница',
            'url' => 'url',
        ];
    }
}