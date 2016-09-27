<?php
namespace frontend\modules\blog\models;

use yii\db\ActiveRecord;
use Yii;

class PostCategory extends ActiveRecord {

	public static function tableName()
	{
		return '{{%post_category}}';
	}
}