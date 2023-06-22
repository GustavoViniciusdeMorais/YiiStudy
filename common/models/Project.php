<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $tech_stack
 * @property string $description
 * @property int|null $start_date
 * @property int|null $end_date
 *
 * @property ProjectImage[] $projectImages
 * @property Testimonial[] $testimonials
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @var yii\web\UploadedFile
     */
    public $imageFiles;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tech_stack', 'description'], 'required'],
            [['tech_stack', 'description'], 'string'],
            [['start_date', 'end_date'], 'date'],
            [['name'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'tech_stack' => Yii::t('app', 'Tech Stack'),
            'description' => Yii::t('app', 'Description'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
        ];
    }

    /**
     * Gets query for [[ProjectImages]].
     *
     * @return \yii\db\ActiveQuery|ProjectImageQuery
     */
    public function getProjectImages()
    {
        return $this->hasMany(ProjectImage::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Testimonials]].
     *
     * @return \yii\db\ActiveQuery|TestimonialQuery
     */
    public function getTestimonials()
    {
        return $this->hasMany(Testimonial::class, ['project_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    public function saveImages()
    {
        Yii::$app->db->transaction(function ($db) {
            foreach ($this->imageFiles as $imageFile) {
                /**
                 * @var $db yii\db\Connection
                 */
                // $uploadPath = 'uploads/projects';
                $uploadPath = Yii::$app->params['uploads']['projects'];
                $backendFolder = Yii::$app->params['uploads']['backend'];
                $file = new File();
                $file->name = uniqid('gus', true) . '.' . $imageFile->extension;
                $file->path_url = $backendFolder;
                $file->base_url = Yii::$app->urlManager->createAbsoluteUrl($backendFolder);
                $file->mime_type = mime_content_type($imageFile->tempName);
                $file->save();

                $projectImage = new ProjectImage();
                $projectImage->project_id = $this->id;
                $projectImage->file_id = $file->id;
                $projectImage->save();

                $fileName = "/{$uploadPath}/{$file->name}";

                // just reduces the byte size of the image
                $thambunial = Image::thumbnail($imageFile->tempName, null, 1080);
                $wasFileSaved = $thambunial->save($fileName);
                
                // $wasFileSaved = $imageFile->saveAs($fileName);

                if (!$wasFileSaved) {
                    $db->transaction->rollBack();
                }
            }
        });
    }

    public function hasImages()
    {
        return count($this->projectImages) > 0;
    }

    public function imagemAbsolutUrl()
    {
        $urls = [];
        foreach ($this->projectImages as $image) {
            $urls[] = $image->file->absoluteUrl();
        }
        return $urls;
    }

    public function imageConfig()
    {
        $configs = [];
        foreach ($this->projectImages as $image) {
            $configs[] = [
                'key' => $image->id
            ];
        }
        return $configs;
    }

    public function loadUploadedImageFiles()
    {
        $this->imageFiles = UploadedFile::getInstances($this, 'imageFiles');
    }
}
