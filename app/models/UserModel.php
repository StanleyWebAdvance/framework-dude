<?php 
namespace app\models;

use core\DB\Model;

class UserModel extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'User');
    }
}