<?php
namespace frontend\modules\shop\models;

use yii\db\ActiveRecord;

class Attribute extends ActiveRecord {

	public static function tableName()
	{
		return '{{%attribute}}';
	}
}