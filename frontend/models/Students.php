<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $date
 * @property int $completed
 * @property int $partial
 * @property int $medical_exemption
 * @property int $religious_exemption
 * @property int $unknown
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['completed', 'partial', 'medical_exemption', 'religious_exemption', 'unknown'], 'required'],
            [['completed', 'partial', 'medical_exemption', 'religious_exemption', 'unknown'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'completed' => 'Completed',
            'partial' => 'Partial',
            'medical_exemption' => 'Medical Exemption',
            'religious_exemption' => 'Religious Exemption',
            'unknown' => 'Unknown',
        ];
    }
}
