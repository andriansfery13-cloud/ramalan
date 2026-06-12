<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Ramalan Umum',
                'slug' => 'umum',
                'icon' => '🔮',
                'description' => 'Ramalan tentang kehidupan sehari-hari',
                'sort_order' => 1,
                'subs' => [
                    ['name' => 'Kehidupan', 'slug' => 'kehidupan', 'icon' => '🌟'],
                    ['name' => 'Keberuntungan', 'slug' => 'keberuntungan', 'icon' => '🍀'],
                    ['name' => 'Nasib Hari Ini', 'slug' => 'nasib-hari-ini', 'icon' => '📅'],
                    ['name' => 'Nasib Minggu Ini', 'slug' => 'nasib-minggu-ini', 'icon' => '📆'],
                ],
            ],
            [
                'name' => 'Ramalan Cinta',
                'slug' => 'cinta',
                'icon' => '💕',
                'description' => 'Ramalan tentang asmara dan percintaan',
                'sort_order' => 2,
                'subs' => [
                    ['name' => 'Jodoh', 'slug' => 'jodoh', 'icon' => '💘'],
                    ['name' => 'Gebetan', 'slug' => 'gebetan', 'icon' => '😍'],
                    ['name' => 'Hubungan', 'slug' => 'hubungan', 'icon' => '💑'],
                    ['name' => 'Pernikahan', 'slug' => 'pernikahan', 'icon' => '💒'],
                ],
            ],
            [
                'name' => 'Ramalan Karier',
                'slug' => 'karier',
                'icon' => '💼',
                'description' => 'Ramalan tentang pekerjaan dan karier',
                'sort_order' => 3,
                'subs' => [
                    ['name' => 'Pekerjaan', 'slug' => 'pekerjaan', 'icon' => '🏢'],
                    ['name' => 'Karier', 'slug' => 'karier-sub', 'icon' => '📈'],
                    ['name' => 'Bisnis', 'slug' => 'bisnis', 'icon' => '💰'],
                    ['name' => 'Rezeki', 'slug' => 'rezeki', 'icon' => '🤑'],
                ],
            ],
            [
                'name' => 'Ramalan Hiburan',
                'slug' => 'hiburan',
                'icon' => '🎭',
                'description' => 'Ramalan lucu dan menghibur',
                'sort_order' => 4,
                'subs' => [
                    ['name' => 'Lucu', 'slug' => 'lucu', 'icon' => '😂'],
                    ['name' => 'Absurd', 'slug' => 'absurd', 'icon' => '🤪'],
                    ['name' => 'Sultan', 'slug' => 'sultan', 'icon' => '👑'],
                    ['name' => 'Gamer', 'slug' => 'gamer', 'icon' => '🎮'],
                    ['name' => 'Wibu', 'slug' => 'wibu', 'icon' => '🎌'],
                ],
            ],
            [
                'name' => 'TikTok Live Special',
                'slug' => 'tiktok-live',
                'icon' => '🎬',
                'description' => 'Ramalan khusus TikTok Live',
                'sort_order' => 5,
                'subs' => [
                    ['name' => 'Viewer Paling Hoki', 'slug' => 'viewer-hoki', 'icon' => '🎰'],
                    ['name' => 'Viewer Sultan', 'slug' => 'viewer-sultan', 'icon' => '👑'],
                    ['name' => 'Viewer Favorit', 'slug' => 'viewer-favorit', 'icon' => '⭐'],
                    ['name' => 'Viewer Beruntung Hari Ini', 'slug' => 'viewer-beruntung', 'icon' => '🌟'],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $subs = $catData['subs'];
            unset($catData['subs']);

            $category = Category::create($catData);

            foreach ($subs as $i => $sub) {
                $category->subCategories()->create(array_merge($sub, ['sort_order' => $i + 1]));
            }
        }
    }
}
