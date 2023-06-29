<?php

namespace app\modules\edit\models;

use app\modules\edit\models\Gallery;
use app\modules\edit\models\Linked;

class LogicModel
{
    public $table; //модль таблицы. Передается с контроллера
    public $gallery;
    public $galleryId;
    public $linked;


    public function __construct()
    {
        $this->gallery = new Gallery(); 
        $this->linked = new Linked();
    }
    /**
     * gallery
     */


}
