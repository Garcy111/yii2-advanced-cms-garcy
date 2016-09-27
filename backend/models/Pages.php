<?php

namespace backend\models;

use Yii;

class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'link'], 'required', 'message' => 'Поле не должно быть пустым'],
            [['name'], 'string', 'max' => 20],
            [['link'], 'string', 'max' => 50],
            ['link', 'match', 'pattern' => '/^([a-z0-9-._]{3,25})?$/', 'message' => 'Только буквы (a-z), цифры (0-9), не меньше 3 и не больше 25 символов, знаки "-._"'],
            [['updated_at', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'link' => 'Адрес',
            'content' => 'Содержимое',
            'updated_at' => 'Изменено',
        ];
    }
}
