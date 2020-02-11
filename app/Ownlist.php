<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ownlist extends Model
{
    //
    protected $table = 'lists';//未設定
    protected $fillable = ['email','title','msg','tododate','deletlist'];
}
