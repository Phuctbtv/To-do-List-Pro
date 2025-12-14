<?php // COMMAND 1: Khai báo đây là file PHP

namespace Database\Factories; // COMMAND 2: Khai báo namespace cho file này

use App\Models\Task; // COMMAND 3: Import model Task để sử dụng
use App\Models\User; // COMMAND 4: Import model User để sử dụng
use Illuminate\Database\Eloquent\Factories\Factory; // COMMAND 5: Import Factory class gốc của Laravel

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory // COMMAND 6: Tạo class TaskFactory kế thừa từ Factory
{
    protected $model = Task::class; // COMMAND 7: Khai báo factory này dùng để tạo dữ liệu cho model Task

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array // COMMAND 8: Định nghĩa phương thức trả về dữ liệu mẫu
    {
        $user = User::first(); // COMMAND 9: Lấy user đầu tiên từ database

        return [ // COMMAND 10: Bắt đầu trả về mảng dữ liệu
            'title' => $this->faker->sentence(5), // COMMAND 11: Tạo tiêu đề ngẫu nhiên 5 từ
            'description' => $this->faker->paragraph(), // COMMAND 12: Tạo mô tả ngẫu nhiên 1 đoạn văn
            'status' => $this->faker->randomElement([ // COMMAND 13: Chọn ngẫu nhiên một trạng thái
                Task::NOT_STARTED, // COMMAND 14: Hằng số trạng thái "Chưa bắt đầu"
                Task::IN_PROGRESS, // COMMAND 15: Hằng số trạng thái "Đang thực hiện"
                Task::COMPLETED, // COMMAND 16: Hằng số trạng thái "Đã hoàn thành"
            ]),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'), // COMMAND 17: Tạo ngày hết hạn từ nay đến 1 tháng sau
            'user_id' => $user->id // COMMAND 18: Gán ID của user đầu tiên làm user_id
        ]; // COMMAND 19: Kết thúc mảng dữ liệu
    } // COMMAND 20: Kết thúc phương thức definition()
} // COMMAND 21: Kết thúc class TaskFactory