<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Kiểm tra xem admin đã tồn tại chưa
        $adminExists = User::where('email', 'admin@admin.com')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'), // Đổi password mạnh hơn sau này
                'role' => 'admin',
            ]);
            
            $this->command->info(' Super Admin created successfully!');
            $this->command->info(' Email: admin@admin.com');
            $this->command->info(' Password: admin123');
        } else {
            $this->command->info(' Admin user already exists.');
        }
    }
}