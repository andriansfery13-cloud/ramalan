<?php

namespace Database\Seeders;

use App\Models\FortuneTemplate;
use Illuminate\Database\Seeder;

class FortuneTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Generating fortune templates...');

        // Generate General Fortune Templates (5000)
        $this->generateGeneral();
        $this->command->info('✓ General templates done');

        // Generate Funny Templates (5000)
        $this->generateFunny();
        $this->command->info('✓ Funny templates done');

        // Generate Luck Templates (5000)
        $this->generateLuck();
        $this->command->info('✓ Luck templates done');

        // Generate Love Templates (5000)
        $this->generateLove();
        $this->command->info('✓ Love templates done');
    }

    private function generateGeneral(): void
    {
        $subjects = [
            'Kamu', 'Dirimu', 'Hatimu', 'Jiwamu', 'Pikiranmu', 'Hidupmu',
            'Langkahmu', 'Perjalananmu', 'Masa depanmu', 'Takdirmu',
            'Semangatmu', 'Tekadmu', 'Mimpimu', 'Harapanmu', 'Doamu',
        ];

        $actions = [
            'akan menemukan', 'akan mengalami', 'akan mendapatkan', 'akan merasakan',
            'segera mendapat', 'akan diberkahi', 'akan dipenuhi dengan', 'akan dihadapkan pada',
            'akan meraih', 'akan menyaksikan', 'akan membuka pintu menuju', 'akan dikelilingi oleh',
            'akan terhubung dengan', 'akan memulai fase baru dalam', 'akan disuguhkan',
        ];

        $objects = [
            'kebahagiaan yang luar biasa', 'peluang baru yang menjanjikan', 'kejutan menyenangkan',
            'keberuntungan tak terduga', 'momen spesial', 'hal-hal positif', 'perubahan besar',
            'kesuksesan gemilang', 'kedamaian batin', 'energi positif yang kuat',
            'inspirasi baru', 'jalan yang lebih terang', 'berkah melimpah',
            'pengalaman berharga', 'hikmah yang mendalam', 'pertanda baik',
            'keajaiban kecil', 'rezeki tak terduga', 'solusi brilian', 'ketenangan jiwa',
        ];

        $timeframes = [
            'dalam waktu dekat', 'minggu ini', 'hari ini', 'segera',
            'dalam beberapa hari ke depan', 'bulan ini', 'tidak lama lagi',
            'saat kamu tidak menyangka', 'ketika waktunya tepat', 'lebih cepat dari yang kamu kira',
        ];

        $advice = [
            'Tetap semangat dan jangan menyerah!', 'Percaya pada prosesnya.',
            'Bersyukurlah atas hal-hal kecil.', 'Jangan takut untuk bermimpi besar.',
            'Teruslah berusaha, hasilnya akan terasa.', 'Jalanmu sudah benar, lanjutkan!',
            'Kebaikanmu akan kembali padamu.', 'Bersabarlah, semua ada waktunya.',
            'Jaga energi positifmu.', 'Kamu lebih kuat dari yang kamu kira.',
            'Alam semesta mendukungmu.', 'Fokus pada hal yang bisa kamu kendalikan.',
            'Senyummu adalah kekuatanmu.', 'Jangan lupa istirahat.',
            'Keberuntungan berpihak padamu.', 'Jangan abaikan firasat baikmu.',
        ];

        $emojis = ['🌟', '✨', '💫', '🔮', '🌈', '⭐', '🍀', '💎', '🎯', '🌙'];

        $templates = [];
        $count = 0;

        foreach ($subjects as $s) {
            foreach ($actions as $a) {
                foreach ($objects as $o) {
                    $tf = $timeframes[array_rand($timeframes)];
                    $adv = $advice[array_rand($advice)];
                    $emoji = $emojis[array_rand($emojis)];
                    $luck = rand(40, 95);

                    $templates[] = [
                        'type' => 'general',
                        'title' => 'Ramalan Kehidupan',
                        'content' => "{$s} {$a} {$o} {$tf}. {$adv}",
                        'emoji' => $emoji,
                        'luck_level' => $luck,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $count++;
                    if ($count >= 5000) break 3;

                    if (count($templates) >= 500) {
                        FortuneTemplate::insert($templates);
                        $templates = [];
                    }
                }
            }
        }

        if (!empty($templates)) {
            FortuneTemplate::insert($templates);
        }
    }

    private function generateFunny(): void
    {
        $intros = [
            'Berdasarkan analisis AI canggih,', 'Menurut bintang-bintang,', 'Setelah konsultasi dengan kucing tetangga,',
            'Berdasarkan mimpi semalam,', 'Menurut ramalan biskuit keberuntungan,', 'Kata angin malam tadi,',
            'Berdasarkan getaran kosmik,', 'Setelah meditasi 0.5 detik,', 'Menurut ramalan cuaca hati,',
            'Berdasarkan perhitungan matematika asal-asalan,', 'Kata cicak di dinding,',
            'Setelah membaca posisi awan,', 'Menurut sensor wifi terdekat,',
            'Berdasarkan vibes yang kamu pancarkan,', 'Kata burung di luar jendela,',
        ];

        $bodies = [
            'kamu akan menemukan uang di saku celana yang sudah lama tidak dipakai.',
            'seseorang akan mentraktirmu makan. Siap-siap!',
            'kamu akan mendapat ide brilian saat mandi.',
            'harimu akan secerah senyum orang yang kamu sukai.',
            'kamu akan menang adu argumen hari ini. Congrats!',
            'WiFi-mu akan lancar seharian. Itu sudah keberuntungan level dewa.',
            'kamu akan menemukan makanan enak di tempat tak terduga.',
            'orang yang kamu pikirkan sedang memikirkanmu juga. Atau mungkin tidak. Tapi siapa tahu?',
            'keberuntunganmu hari ini setara dengan menemukan parkir kosong di mall saat weekend.',
            'kamu akan mendapat notifikasi yang membuatmu senyum.',
            'energimu hari ini se-level kopi espresso double shot.',
            'kamu akan mendapat compliment yang bikin senyum-senyum sendiri.',
            'rezekimu hari ini datang dari arah yang tidak disangka-sangka.',
            'kamu akan ketemu teman lama dan nostalgia bareng.',
            'mood-mu akan naik drastis setelah mendengar lagu favorit.',
            'kamu akan jadi bintang di grup chat hari ini.',
            'level kegantengan/kecantikanmu naik 200% hari ini.',
            'aura sultanmu sedang di puncak. Flex aja terus!',
            'kamu akan menemukan series baru yang bikin begadang.',
            'semua traffic light akan hijau untukmu hari ini.',
            'kamu bakal dapet diskon gede di tempat makan favorit.',
            'seseorang diam-diam ngeship kamu dengan orang lain.',
            'kamu akan jadi MVP di apapun yang kamu lakukan hari ini.',
            'skill masakmu akan naik level hari ini. Chef vibes!',
            'kamu akan menemukan meme yang relatable banget.',
        ];

        $closings = [
            '😂 Tapi ini cuma ramalan hiburan ya!', '🤣 Jangan terlalu serius!',
            '😆 Yang penting happy!', '🎭 Ini cuma for fun kok!',
            '😜 Percaya atau tidak, yang penting senyum!', '🤪 Hidup ini terlalu singkat untuk tidak tertawa!',
            '😎 Stay cool, stay awesome!', '🎪 Ingat, ini cuma hiburan!',
            '🥳 Semoga harimu menyenangkan!', '😁 Keep smiling!',
        ];

        $emojis = ['😂', '🤣', '😆', '😜', '🤪', '😎', '🥳', '😁', '🎭', '🤡'];

        $templates = [];
        $count = 0;

        foreach ($intros as $i) {
            foreach ($bodies as $b) {
                foreach ($closings as $c) {
                    $templates[] = [
                        'type' => 'funny',
                        'title' => 'Ramalan Lucu',
                        'content' => "{$i} {$b} {$c}",
                        'emoji' => $emojis[array_rand($emojis)],
                        'luck_level' => rand(30, 99),
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $count++;
                    if ($count >= 5000) break 3;

                    if (count($templates) >= 500) {
                        FortuneTemplate::insert($templates);
                        $templates = [];
                    }
                }
            }
        }

        if (!empty($templates)) {
            FortuneTemplate::insert($templates);
        }
    }

    private function generateLuck(): void
    {
        $openers = [
            'Hari ini keberuntunganmu', 'Tingkat hokimu', 'Level keberuntunganmu',
            'Aura keberuntunganmu', 'Bintang keberuntunganmu', 'Energi hokimu',
            'Getaran keberuntunganmu', 'Sinyal hokimu', 'Radar keberuntunganmu',
            'Frekuensi hokimu', 'Kompas keberuntunganmu', 'Magnet rezkimu',
        ];

        $levels = [
            'sedang di puncak tertinggi!', 'sangat kuat hari ini!', 'memancar terang!',
            'sedang naik-naiknya!', 'luar biasa cemerlang!', 'sedang dalam mode turbo!',
            'berkilau seperti berlian!', 'sedang aktif maksimal!', 'tidak terbendung!',
            'melebihi batas normal!', 'mengalir deras seperti sungai!', 'sedang on fire!',
        ];

        $predictions = [
            'Angka keberuntunganmu adalah', 'Warna hokimu adalah', 'Arah keberuntunganmu dari',
            'Waktu terbaik untukmu', 'Element keberuntunganmu adalah', 'Batu keberuntunganmu adalah',
        ];

        $predValues = [
            ['7', '3', '9', '11', '21', '88', '168', '8', '13', '27', '33', '42', '77', '99'],
            ['Biru', 'Emas', 'Hijau', 'Merah', 'Ungu', 'Silver', 'Cyan', 'Pink', 'Orange'],
            ['Timur', 'Barat', 'Utara', 'Selatan', 'atas', 'bawah', 'depan', 'belakang'],
            ['pagi hari', 'siang hari', 'sore hari', 'malam hari', 'tengah malam', 'subuh'],
            ['Air', 'Api', 'Tanah', 'Angin', 'Cahaya', 'Es', 'Petir'],
            ['Safir', 'Ruby', 'Zamrud', 'Berlian', 'Amethyst', 'Topaz', 'Opal'],
        ];

        $tips = [
            'Jangan lupa bersedekah hari ini!', 'Tersenyumlah kepada orang asing.',
            'Lakukan sesuatu yang baik untuk dirimu sendiri.', 'Bagikan kebaikanmu.',
            'Mulailah hari dengan rasa syukur.', 'Jaga pikiran positif sepanjang hari.',
            'Ambil risiko yang terukur hari ini.', 'Percayai instingmu!',
            'Kelilingi dirimu dengan orang-orang positif.', 'Jangan lewatkan kesempatan yang datang!',
            'Ucapkan terima kasih lebih sering.', 'Fokus pada solusi, bukan masalah.',
        ];

        $emojis = ['🍀', '🎰', '🌟', '💰', '🎯', '🔥', '⚡', '💎', '🏆', '🎲'];

        $templates = [];
        $count = 0;

        foreach ($openers as $o) {
            foreach ($levels as $l) {
                for ($p = 0; $p < count($predictions); $p++) {
                    $val = $predValues[$p][array_rand($predValues[$p])];
                    $tip = $tips[array_rand($tips)];
                    $emoji = $emojis[array_rand($emojis)];

                    $templates[] = [
                        'type' => 'luck',
                        'title' => 'Ramalan Keberuntungan',
                        'content' => "{$o} {$l} {$predictions[$p]} {$val}. {$tip}",
                        'emoji' => $emoji,
                        'luck_level' => rand(50, 100),
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $count++;
                    if ($count >= 5000) break 3;

                    if (count($templates) >= 500) {
                        FortuneTemplate::insert($templates);
                        $templates = [];
                    }
                }
            }
        }

        // Fill remaining with variations
        while ($count < 5000) {
            $templates[] = [
                'type' => 'luck',
                'title' => 'Ramalan Keberuntungan',
                'content' => $openers[array_rand($openers)] . ' ' . $levels[array_rand($levels)] . ' ' .
                             $predictions[array_rand($predictions)] . ' ' .
                             $predValues[array_rand($predValues)][0] . '. ' .
                             $tips[array_rand($tips)],
                'emoji' => $emojis[array_rand($emojis)],
                'luck_level' => rand(50, 100),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $count++;
            if (count($templates) >= 500) {
                FortuneTemplate::insert($templates);
                $templates = [];
            }
        }

        if (!empty($templates)) {
            FortuneTemplate::insert($templates);
        }
    }

    private function generateLove(): void
    {
        $openers = [
            'Dalam urusan cinta,', 'Di bidang asmara,', 'Soal hati,',
            'Tentang percintaan,', 'Masalah jodoh,', 'Urusan romantis,',
            'Di ranah cinta,', 'Dalam hal perasaan,', 'Soal pasangan,',
            'Tentang belahan jiwa,', 'Di dunia romansa,', 'Perihal asmara,',
        ];

        $predictions = [
            'kamu akan bertemu seseorang yang spesial', 'hubunganmu akan semakin kuat',
            'ada seseorang yang diam-diam memperhatikanmu', 'cinta sejatimu sudah dekat',
            'perasaan yang kamu pendam akan terbalas', 'komunikasi dengan pasangan akan membaik',
            'momen romantis menanti di depan', 'orang yang tepat sedang dalam perjalanan menujumu',
            'keharmonisan dalam hubungan akan tercapai', 'ada kejutan manis dari seseorang',
            'chemistry dengan seseorang akan terasa kuat', 'rasa sayangmu akan diapresiasi',
            'seseorang sedang jatuh hati padamu', 'kesetiaan akan membawa berkah',
            'cinta yang tulus akan datang tanpa diduga', 'jodohmu sedang dipersiapkan',
        ];

        $timeframes = [
            'dalam waktu dekat.', 'minggu ini.', 'bulan ini.', 'segera.',
            'saat kamu tidak menyangka.', 'ketika kamu sudah siap.',
            'lebih cepat dari yang kamu kira.', 'di momen yang tepat.',
            'saat hatimu paling tenang.', 'ketika kamu sudah berdamai dengan dirimu.',
        ];

        $advice = [
            'Buka hatimu dan terima cinta dengan tulus. 💕', 'Cinta datang saat kamu tidak mencarinya. 💗',
            'Jadilah dirimu sendiri, itulah daya tarik terbesarmu. 💖', 'Jangan terburu-buru, cinta butuh waktu. 💝',
            'Komunikasi adalah kunci hubungan yang sehat. 💞', 'Percayai prosesnya dan nikmati perjalanan. 💘',
            'Yang terbaik akan datang untuk yang mau bersabar. 💓', 'Cintai dirimu dulu, baru yang lain. ❤️',
            'Ketulusan selalu menemukan jalannya. 💗', 'Jangan takut untuk membuka hati. 💕',
            'Hubungan yang baik dibangun dari kepercayaan. 💞', 'Setiap orang layak dicintai, termasuk kamu. 💖',
        ];

        $emojis = ['💕', '💗', '💖', '💝', '💞', '💘', '💓', '❤️', '😍', '🥰'];

        $templates = [];
        $count = 0;

        foreach ($openers as $o) {
            foreach ($predictions as $p) {
                foreach ($timeframes as $t) {
                    $adv = $advice[array_rand($advice)];
                    $emoji = $emojis[array_rand($emojis)];

                    $templates[] = [
                        'type' => 'love',
                        'title' => 'Ramalan Cinta',
                        'content' => "{$o} {$p} {$t} {$adv}",
                        'emoji' => $emoji,
                        'luck_level' => rand(45, 99),
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $count++;
                    if ($count >= 5000) break 3;

                    if (count($templates) >= 500) {
                        FortuneTemplate::insert($templates);
                        $templates = [];
                    }
                }
            }
        }

        if (!empty($templates)) {
            FortuneTemplate::insert($templates);
        }
    }
}
