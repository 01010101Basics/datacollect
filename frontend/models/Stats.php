<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stats".
 *
 * @property int $id
 * @property string|null $employee_name
 * @property string|null $medical_activity
 * @property string|null $set_complete
 * @property string|null $category
 * @property string|null $file
 * @property string|null $status
 */
class Stats extends \yii\db\ActiveRecord
{
 

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['employee_name', 'medical_activity', 'category','status','set_complete'], 'safe'],
            [['employee_name',  'medical_activity', 'set_complete', 'category',], 'string', 'max' => 255],
              
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_name' => 'Employee Name',
            'status' => 'Status',
            'category' => 'Category',
            'medical_activity' => 'Medical Activity',
            'set_complete' => 'Set Complete',
            'file' => 'Select file',
        ];
    }
}
