<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
//khai báo thuộc tính trong bảng task trong Eloquent Model
{
   protected $fillable = ['title',
                        'description',
                        'status',
                        'due_date',
                        'user_id'];
}
