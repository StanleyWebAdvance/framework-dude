<?php

namespace app\models;

use core\DB\Model;

class PageModel extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'page');
    }
}