<?php

namespace app\controllers;

use yii;
use app\components\Controller;
use app\helpers\FileHelper;
use app\helpers\UploadedFile;
use app\modules\edit\models\DynamicModel;
use Exception;
use yii\bootstrap\ActiveForm;
use yii\helpers\Json;
use app\modules\edit\models\Table;
use app\modules\edit\models\Field;

class ToolsController extends Controller
{
    public function actionUploadImage()
    {
        try {
            if ($uploadedFile = UploadedFile::getInstanceByName('image_files')) {
                if ($uploadedFile->saveToServer()) {
                    return Json::encode(array(
                        'preview' => $uploadedFile->getAbsoluteUrl(),
                        'filename' => $uploadedFile->getRelativeUrl(),
                    ));
                }
            }
        } catch (Exception $e) {
            return 'Ошибка при загрузке: ' .  $e->getMessage();
        }
        return 'Ошибка при загрузке';
    }
    public static function cropImage($sourceImagePath, $fromX = 0, $fromY = 0, $width = 0, $height = 0, $defaultWidth = 0, $defaultHeight = 0)
    {
        $file_type = pathinfo($sourceImagePath, PATHINFO_EXTENSION);

        if ($file_type == 'jpg' || $file_type == 'jpeg') {
            $image = imagecreatefromjpeg($sourceImagePath);
        } elseif ($file_type == 'png') {
            $image = imagecreatefrompng($sourceImagePath);
        } else {
            return false;
        }
        $dest_r = imagecreatetruecolor($defaultWidth, $defaultHeight);
        /******* Add these 2 lines maintain transparency of PNG images ****/
        imagealphablending($dest_r, false);
        imagesavealpha($dest_r, true);
        $transparent = imagecolorallocatealpha($dest_r, 255, 255, 255, 127);
        imagefilledrectangle($dest_r, 0, 0, $defaultWidth, $defaultHeight, $transparent);
        /********end*********/

        list($imgW,$imgH) = getimagesize($sourceImagePath);
        $srcX = 0;
        $srcY = 0;
        $dstX = -$fromX * $defaultWidth/$width;
        $dstY = -$fromY * $defaultHeight/$height;
        $srcW = $imgW;
        $srcH = $imgH;
        if (!imagecopyresampled($dest_r, $image, $dstX, $dstY, $srcX, $srcY, $srcW*$defaultWidth/$width, $srcH* $defaultHeight/$height, $srcW, $srcH)) {
            return false;
        }
        // save only png or jpeg pictures
        if ($file_type == 'jpg' || $file_type == 'jpeg') {
            imagejpeg($dest_r, $sourceImagePath, 81);
        } elseif ($file_type == 'png') {
            imagepng($dest_r, $sourceImagePath);
        }
        return true;
    }
    public function actionCrop()
    {
        $siteDirectory = pathinfo(\Yii::getAlias('@webroot'))['dirname'];
//        $siteHost = \Yii::$app->params['realtyDreamsHost'];
        try {
            if ($_POST['new_image']) {
                if ($image = UploadedFile::getInstanceByName('image_file')) {
                    $extension = strtolower($image->getExtension());
                } else {
                    echo "Файл не выбран";
                    return false;
                }

                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                    FileHelper::createDirectory($siteDirectory . '/images/croppersImage/' . $_POST['image_path']);
                    $pathToFile = '/images/croppersImage/'.$_POST['image_path'].'/' . FileHelper::getRandomFileName(\Yii::getAlias('@webroot') . '/images/'.$_POST['image_path'].'/' , $image->getExtension())  . '.' . $image->getExtension();
                } else {
                    echo "Неверный формат. Разрешены только *.png, *.jpg, *.jpeg";
                    return false;
                }
                $image->saveAs($siteDirectory . $pathToFile);
//                copy($siteDirectory . $pathToFile, $adminSiteDirectory . $pathToFile);
            } else {
                $pathToFile = $_POST['image_file'];
                $newPathToFile = '/images/top/' . FileHelper::getRandomFileName(\Yii::getAlias('@webroot') . '/images/top/' , strtolower(pathinfo($siteDirectory . $pathToFile, PATHINFO_EXTENSION)))  . '.' . strtolower(pathinfo($siteDirectory . $pathToFile, PATHINFO_EXTENSION));;
//                copy($adminSiteDirectory . $pathToFile, $siteDirectory  . $newPathToFile);
                $pathToFile = $newPathToFile;
            }
            self::cropImage($siteDirectory . $pathToFile, $_POST['crop_x'], $_POST['crop_y'], $_POST['crop_w'], $_POST['crop_h'], $_POST['width'], $_POST['height']);


            $data = array();
            $data['imageBaseName'] = strtolower(pathinfo($siteDirectory . $pathToFile, PATHINFO_BASENAME));
            $data['link'] = $pathToFile;
            $data['image'] = $pathToFile;

            return json_encode($data);

        } catch (Exception $e) {
            var_dump($e);
            echo "Ошибка при сохранении. Обратитесь к администратору";
            return false;
        }
    }
}
