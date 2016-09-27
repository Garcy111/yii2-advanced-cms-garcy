<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $active
 *
 * @property Value[] $values
 * @property Attribute[] $attributes
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'price', 'active'], 'integer'],
            [['name', 'price', 'active'], 'required'],
            [['description', 'photo'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Фото',
            'category_id' => 'Категория',
            'name' => 'Название',
            'description' => 'Описание',
            'price' => 'Цена',
            'active' => 'Активность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('{{%value}}', ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\ProductQuery(get_called_class());
    }
}
