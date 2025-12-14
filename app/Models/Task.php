<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class Task extends Model
//khai báo thuộc tính trong bảng task trong Eloquent Model
{
   // Thêm trait vào trong model Task
    use HasFactory;
   protected $fillable = ['title',
                        'description',
                        'status',
                        'due_date',
                        'user_id'];
   const NOT_STARTED =0;
   const IN_PROGRESS =1;
   const COMPLETED =2;
   /**
 * Create a new factory instance for the model.
 * Định nghĩa factory cho model
 */
   protected static function newFactory()
   {
      // COMMAND 3: Trả về instance(đối tượng) mới của TaskFactory
        // Tác dụng: Khi gọi Task::factory(), Laravel sẽ dùng factory này
      return TaskFactory::new();
   }
   public function user(){
      //COMMAND 5: Trả về quan hệ "thuộc về" (belongsTo)
        // Tác dụng: Mỗi task thuộc về một user
      return $this->belongsTo(User::class);
   }
}
