<?php
namespace frontend\modules\shop\models;

use yii\db\ActiveRecord;

class Value extends ActiveRecord {

	public static function tableName()
	{
		return '{{%value}}';
	}

	 /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttribute()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }
}