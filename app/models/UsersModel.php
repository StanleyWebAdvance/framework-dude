<?php 
namespace app\models;

use core\DB\Model;

class UsersModel extends Model
{
    //  your name table
    public $table = 'users';

    public $fillable = array(

        'name',
        'email',
        'password',
        '_token' => null
    );
}