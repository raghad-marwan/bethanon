<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::create([
            'title' => 'تم إضافة مشروع جديد',
            'message' => 'مشروع دعم الأرامل والأيتام',
        ]);

        Notification::create([
            'title' => 'تم اعتماد 100 مستفيد جديد',
            'message' => 'في مشروع دعم الأسر المتعففة',
        ]);

        Notification::create([
            'title' => 'مناشدة عاجلة',
            'message' => 'توفير مساعدات إغاثية عاجلة',
        ]);
    }
}
