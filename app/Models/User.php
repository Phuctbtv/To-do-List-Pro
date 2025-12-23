<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Role constants - Hằng số định nghĩa các loại role
     * Đây là cách tốt nhất để tránh hardcode string trong code
     */
    const ROLE_ADMIN = 'admin';      // Giá trị 'admin' lưu trong database
    const ROLE_USER = 'user';        // Giá trị 'user' lưu trong database

    /**
     * The attributes that are mass assignable.
     * Các trường có thể gán hàng loạt (khi dùng create() hoặc update())
     * Thêm 'role' vào đây để có thể gán role khi tạo/sửa user
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // THÊM ROLE VÀO ĐÂY - cho phép gán giá trị role
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Các trường bị ẩn khi chuyển thành JSON (ví dụ API)
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * Định nghĩa kiểu dữ liệu cast tự động
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',  // Tự động cast thành Carbon instance
            'password' => 'hashed',             // Tự động hash password khi gán
        ];
    }

    /**
     * Check if user is admin
     * Kiểm tra xem user có phải là admin không
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;  // So sánh role với constant ADMIN
    }

    /**
     * Check if user is regular user
     * Kiểm tra xem user có phải là user thường không
     * @return bool
     */
    public function isUser(): bool
    {
        // User là user thường nếu role = 'user' HOẶC role = null (trường hợp user cũ chưa có role)
        return $this->role === self::ROLE_USER || $this->role === null;
    }

    /**
     * Scope a query to only include admin users.
     * Local scope để lọc chỉ admin users
     * Sử dụng: User::admins()->get()
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmins($query)
    {
        // Thêm điều kiện WHERE role = 'admin' vào query
        return $query->where('role', self::ROLE_ADMIN);
    }

    /**
     * Scope a query to only include regular users.
     * Local scope để lọc chỉ regular users
     * Sử dụng: User::regularUsers()->get()
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegularUsers($query)
    {
        // Thêm điều kiện WHERE role = 'user' vào query
        return $query->where('role', self::ROLE_USER);
    }

    /**
     * Get all available roles
     * Lấy danh sách tất cả role có sẵn
     * Hữu ích cho dropdown select trong form
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_ADMIN => 'Administrator',  // key: 'admin', value: 'Administrator'
            self::ROLE_USER => 'Regular User',    // key: 'user', value: 'Regular User'
        ];
    }

    /**
     * Relationship with Todo model (nếu bạn có model Todo)
     * Định nghĩa quan hệ một-nhiều: Một user có nhiều todo
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        public function tasks()
    {
        // Quan hệ hasMany: user_id là khóa ngoại trong bảng tasks
        return $this->hasMany(\App\Models\Task::class);
    }
    /**
     * Assign admin role to user
     * Gán role admin cho user và lưu vào database
     * @return void
     */
    public function makeAdmin(): void
    {
        $this->role = self::ROLE_ADMIN;  // Gán giá trị 'admin'
        $this->save();                   // Lưu thay đổi vào database
    }

    /**
     * Assign user role to user
     * Gán role user thường cho user và lưu vào database
     * @return void
     */
    public function makeUser(): void
    {
        $this->role = self::ROLE_USER;   // Gán giá trị 'user'
        $this->save();                   // Lưu thay đổi vào database
    }
}