<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhodamTemplate;

class KhodamTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            // HEWAN KHAS / LUCU
            ['Macan Putih', 'Penjaga yang sangat berwibawa, tapi kadang manja minta dielus.', 'hewan', '🐅', 90],
            ['Macan Tutul', 'Sangat lincah dan galak kalau kamu lagi diganggu orang.', 'hewan', '🐆', 85],
            ['Harimau Sumatera', 'Aura sangar, bikin musuhmu auto kena mental sebelum bertarung.', 'hewan', '🐯', 95],
            ['Buaya Darat', 'Selalu tebar pesona dan pandai merayu mangsa.', 'hewan', '🐊', 75],
            ['Kucing Oren', 'Preman pasar gaib. Suka cari ribut tanpa alasan yang jelas.', 'hewan', '🐈', 99],
            ['Naga Sakti', 'Khodam legendaris tingkat tinggi. Menyemburkan api kejayaan di hidupmu.', 'hewan', '🐉', 100],
            ['Burung Garuda', 'Penuh wibawa dan menjunjung tinggi nilai-nilai kebangsaan.', 'hewan', '🦅', 95],
            ['Monyet Sakti', 'Lincah, banyak akal, tapi kadang suka nyolong pisang tetangga.', 'hewan', '🐒', 80],
            ['Kuda Jingkrak', 'Energi tak terbatas, membuatmu tidak pernah merasa capek.', 'hewan', '🐎', 85],
            ['Singa Padang Pasir', 'Raja segala raja, suaranya bisa bikin dompet bergetar.', 'hewan', '🦁', 92],
            ['Ikan Lele', 'Licin banget, susah ditangkap kalau lagi ngeles dari masalah.', 'hewan', '🐟', 40],
            ['Bebek Ngesot', 'Jalannya santai tapi suaranya bikin tetangga sekampung bangun.', 'hewan', '🦆', 30],
            ['Ayam Jago', 'Khodam tukang bangunin pagi, pantang menyerah sebelum berkokok.', 'hewan', '🐓', 60],
            ['Ular Kobra', 'Diam-diam mematikan, tatapannya bikin lawan langsung kaku.', 'hewan', '🐍', 88],
            ['Kelelawar Malam', 'Suka begadang dan baru aktif kalau matahari sudah terbenam.', 'hewan', '🦇', 70],
            ['Serigala Penyendiri', 'Lebih suka bergerak sendiri dalam gelap, sangat mandiri.', 'hewan', '🐺', 82],
            ['Gajah Mada', 'Kuat, besar, dan tidak mudah goyah oleh badai kehidupan.', 'hewan', '🐘', 94],
            ['Kura-kura Ninja', 'Santai tapi punya jurus rahasia yang tak terduga.', 'hewan', '🐢', 65],
            ['Kecoa Terbang', 'Khodam paling ditakuti umat manusia, bikin semua orang lari.', 'hewan', '🪳', 99],
            ['Cicak di Dinding', 'Suka diam-diam nguping rahasia orang lain.', 'hewan', '🦎', 20],
            
            // HANTU KHAS INDONESIA
            ['Kuntilanak Merah', 'Ketawanya nyaring, siap nakut-nakutin siapa saja yang berani nyakitin kamu.', 'hantu', '👻', 85],
            ['Pocong Ngesot', 'Suka melompat-lompat mengejar mimpimu yang tertunda.', 'hantu', '👻', 70],
            ['Tuyul Racing', 'Jago nyari cuan dengan kecepatan tinggi. Dompet auto tebal!', 'hantu', '👶', 95],
            ['Genderuwo Macho', 'Besar, berbulu, dan siap pasang badan kalau kamu dibully.', 'hantu', '👹', 88],
            ['Wewe Gombel', 'Punya sifat keibuan, suka melindungimu saat kamu merasa sendirian.', 'hantu', '🧟‍♀️', 75],
            ['Sundel Bolong', 'Penampilannya menipu, belakangnya bolong tapi hatinya baik.', 'hantu', '🧛‍♀️', 80],
            ['Jelangkung', 'Datang tak diundang, pulang tak diantar, tapi selalu setia nemenin.', 'hantu', '🎎', 60],
            ['Babi Ngepet', 'Ahli dalam urusan finansial. Kalau kamu jaga lilin, dia yang cari uang.', 'hantu', '🐷', 90],
            ['Suster Ngesot', 'Jalannya lambat tapi pasti, tekadnya kuat banget.', 'hantu', '🏥', 65],
            ['Palasik', 'Mengincar kesuksesan yang masih baru menetas.', 'hantu', '🦇', 78],
            ['Buto Ijo', 'Khodam kelas berat, bikin rezekimu hijau dan subur.', 'hantu', '👺', 92],
            ['Kuyang', 'Suka terbang malam-malam nyari diskonan atau flash sale.', 'hantu', '🧛‍♀️', 75],
            ['Nyi Roro Kidul', 'Aura Ratu Pantai Selatan, pesonamu sedalam samudra.', 'hantu', '🧜‍♀️', 100],
            ['Jin Nasab', 'Khodam warisan leluhur yang siap jaga kamu tujuh turunan.', 'hantu', '🧞‍♂️', 85],
            ['Siluman Ular', 'Sangat memikat dan punya daya tarik mistis yang kuat.', 'hantu', '🐍', 82],
            
            // BENDA / LAINNYA
            ['Sapu Lidi', 'Bisa menyapu bersih semua rintangan di hidupmu.', 'benda', '🧹', 50],
            ['Wajan Gosong', 'Kebal terhadap hujatan netizen, mental sudah sehitam wajan.', 'benda', '🍳', 80],
            ['Kipas Angin Rusak', 'Suka muter-muter aja tapi nggak ada solusinya.', 'benda', '🌪️', 10],
            ['Pintu Indomaret', 'Selalu menyambut orang dengan "Selamat Datang".', 'benda', '🚪', 40],
            ['Tisu Magic', 'Punya kekuatan magis untuk membersihkan masalah dengan cepat.', 'benda', '🧻', 60],
        ];

        $data = [];
        foreach ($templates as $item) {
            $data[] = [
                'name' => $item[0],
                'description' => $item[1],
                'type' => $item[2],
                'emoji' => $item[3],
                'power_level' => $item[4],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        KhodamTemplate::insert($data);
    }
}
