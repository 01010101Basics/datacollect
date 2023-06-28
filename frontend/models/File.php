<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $file
 */
class File extends \yii\db\ActiveRecord
{
    public $file;
    
    public $uploadFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }
    public function upload()
    {
        if (Yii::$app->request->isPost) {
            $this->uploadFile->saveAs('media/files/' . $this->uploadFile->baseName . '.' . $this->uploadFile->extension);
            return true;
        } else {
            return false;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions'=>'csv'],
            [['uploadFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, docx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'File',
            'path' => 'Path',
        ];
    }
}
