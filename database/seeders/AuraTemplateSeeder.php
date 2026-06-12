<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuraTemplate;

class AuraTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [];

        $sultanData = [
            ['👑 Aura Crazy Rich', 'Duitmu nggak habis-habis, bahkan dompetmu bisa bunyi kalau kesepian.', '#eab308', '💰'],
            ['💎 Aura Miliarder', 'Auramu memancarkan kemewahan, jalan kaki aja serasa di red carpet.', '#38bdf8', '💎'],
            ['💳 Aura Black Card', 'Ke mana-mana selalu dibayarin semesta, auramu sangat sultan!', '#000000', '💳'],
            ['🏰 Aura Ningrat', 'Kamu punya karisma bangsawan yang bikin orang auto sungkem.', '#f59e0b', '🏰'],
            ['💸 Aura ATM Berjalan', 'Uang selalu mendekatimu seperti magnet, jangan lupa traktir teman!', '#22c55e', '💸'],
            ['👑 Aura Investor', 'Apapun yang kamu pegang bisa jadi emas, insting bisnismu tajam!', '#fbbf24', '📈'],
            ['💎 Aura Pewaris', 'Aura kemewahan terpancar jelas, seperti pewaris tahta kerajaan bisnis.', '#eab308', '👑'],
            ['💳 Aura Sugar Daddy/Mommy', 'Aura dermawanmu sangat kuat, suka bagi-bagi rezeki tanpa pamrih!', '#ec4899', '✨'],
            ['🏰 Aura Jet Pribadi', 'Standarmu sangat tinggi, aura kelas atas yang nggak ada duanya.', '#94a3b8', '✈️'],
            ['💸 Aura Bos Besar', 'Auramu sangat berwibawa, cocok jadi bos besar di masa depan!', '#1e40af', '👔'],
            ['👑 Aura Berlian', 'Sangat berharga dan bersinar terang di mana pun kamu berada.', '#7dd3fc', '💎'],
            ['💎 Aura Uang Kaget', 'Sering dapat rezeki nomplok dari arah yang tidak disangka-sangka!', '#10b981', '🎁'],
            ['💳 Aura VIP', 'Aura eksklusif, selalu dapat perlakuan VIP di mana saja.', '#b45309', '⭐'],
            ['🏰 Aura Kolektor', 'Barang-barang mewah selalu berjodoh denganmu.', '#8b5cf6', '🛍️'],
            ['💸 Aura Cuan', 'Setiap helaan nafasmu mengandung cuan yang melimpah!', '#22c55e', '🤑'],
        ];

        $positifData = [
            ['✨ Aura Malaikat', 'Kamu sangat baik hati, selalu membawa kedamaian bagi orang sekitar.', '#fcd34d', '😇'],
            ['🌟 Aura Bintang', 'Kamu selalu bersinar dan memberi semangat ke semua orang!', '#fef08a', '🌟'],
            ['🌻 Aura Bunga Matahari', 'Senyummu sangat cerah, bikin hari orang lain jadi lebih indah.', '#eab308', '🌻'],
            ['🌈 Aura Pelangi', 'Kamu selalu membawa warna dan kebahagiaan setelah masa sulit.', '#fb7185', '🌈'],
            ['🦋 Aura Kupu-Kupu', 'Transformasi positif selalu terjadi di sekitarmu.', '#c084fc', '🦋'],
            ['🕊️ Aura Kedamaian', 'Aura yang sangat menenangkan, orang nyaman berada di dekatmu.', '#93c5fd', '🕊️'],
            ['☀️ Aura Pagi Hari', 'Membawa harapan baru dan kesegaran bagi siapa saja yang bertemu.', '#fde047', '☀️'],
            ['🍀 Aura Keberuntungan', 'Keberuntungan selalu menaungimu dan orang-orang di dekatmu.', '#22c55e', '🍀'],
            ['💖 Aura Kasih Sayang', 'Hati yang tulus membuatmu dicintai oleh banyak orang.', '#f472b6', '💖'],
            ['🎵 Aura Harmoni', 'Kamu selalu bisa mencairkan suasana dan membawa kerukunan.', '#a78bfa', '🎵'],
            ['🌱 Aura Pertumbuhan', 'Selalu membawa vibe positif yang membuat orang lain ikut berkembang.', '#4ade80', '🌱'],
            ['🎈 Aura Kebahagiaan', 'Kehadiranmu selalu ditunggu karena membawa tawa dan ceria.', '#f87171', '🎈'],
            ['🍯 Aura Madu', 'Sangat manis dan menyenangkan, auramu bikin orang betah lama-lama.', '#d97706', '🍯'],
            ['🌸 Aura Musim Semi', 'Membawa kehangatan dan keindahan di setiap langkahmu.', '#fbcfe8', '🌸'],
            ['🔮 Aura Healing', 'Kata-katamu selalu bisa menyembuhkan hati yang sedang terluka.', '#c084fc', '🔮'],
        ];

        $misteriusData = [
            ['🌙 Aura Bulan Purnama', 'Sangat misterius dan menarik, banyak rahasia di balik senyummu.', '#94a3b8', '🌙'],
            ['🦇 Aura Dark Mode', 'Kamu lebih suka mengamati dalam diam, tapi sangat mematikan.', '#334155', '🦇'],
            ['🕵️ Aura Detektif', 'Instingmu sangat tajam, kamu tahu hal yang orang lain coba sembunyikan.', '#475569', '🕵️'],
            ['🌌 Aura Galaksi', 'Pikiranmu sangat dalam, sulit ditebak bagai alam semesta.', '#1e1b4b', '🌌'],
            ['🦉 Aura Burung Hantu', 'Kamu sangat bijak dan selalu mengawasi dari kejauhan.', '#713f12', '🦉'],
            ['🔮 Aura Indigo', 'Punya intuisi kuat, sering merasa dejavu dan tahu masa depan.', '#4c1d95', '🔮'],
            ['🌫️ Aura Kabut', 'Sulit dipahami dan sangat elegan, membuat orang penasaran.', '#cbd5e1', '🌫️'],
            ['🎭 Aura Topeng', 'Bisa menyesuaikan diri di situasi apapun, chameleon sejati.', '#0f172a', '🎭'],
            ['🌑 Aura Gerhana', 'Misterius dan jarang muncul, tapi sekali muncul bikin geger.', '#1e293b', '🌑'],
            ['🕷️ Aura Jaring Laba-laba', 'Kamu pandai membaca situasi dan membuat strategi rahasia.', '#dc2626', '🕷️'],
            ['🖤 Aura Black Hole', 'Daya tarikmu sangat kuat, membuat siapa saja tersedot pesonamu.', '#000000', '🖤'],
            ['🌊 Aura Palung Laut', 'Sangat tenang di permukaan, tapi punya kedalaman tak terhingga.', '#0c4a6e', '🌊'],
            ['🕯️ Aura Lilin', 'Kamu menerangi dalam kegelapan, sangat mistis dan syahdu.', '#fcd34d', '🕯️'],
            ['🧊 Aura Es Abadi', 'Terlihat dingin di luar, tapi sangat hangat bagi yang mengerti.', '#bae6fd', '🧊'],
            ['🚪 Aura Pintu Rahasia', 'Orang butuh waktu lama untuk bisa benar-benar mengenalmu.', '#78350f', '🚪'],
        ];

        $animeData = [
            ['⚔️ Aura Main Character', 'Aura protagonis utama, plot armor-mu sangat tebal!', '#ef4444', '⚔️'],
            ['🌸 Aura Tsundere', 'Kelihatannya galak dan dingin, padahal aslinya peduli banget.', '#f472b6', '🌸'],
            ['⚡ Aura Super Saiyan', 'Energimu meledak-ledak kalau lagi semangat, over power!', '#eab308', '⚡'],
            ['🧠 Aura Villain Jenius', 'Aura antagonis elegan yang diam-diam merencanakan segalanya.', '#7e22ce', '🧠'],
            ['🐼 Aura Mascot', 'Sangat imut dan jadi pusat perhatian, semua orang ingin memelukmu.', '#f1f5f9', '🐼'],
            ['🥋 Aura Hokage', 'Punya jiwa kepemimpinan tinggi dan rela berkorban demi teman.', '#ea580c', '🥋'],
            ['👻 Aura Isekai', 'Seperti orang dari dunia lain, pemikiranmu out of the box!', '#3b82f6', '👻'],
            ['🍙 Aura Slice of Life', 'Hidupmu sangat santai, tenang, dan estetik ala anime sekolah.', '#a7f3d0', '🍙'],
            ['🔥 Aura Shounen', 'Semangat pantang menyerah, selalu teriak sebelum bertindak!', '#dc2626', '🔥'],
            ['✨ Aura Magical Girl', 'Penuh keajaiban, kamu bisa mengubah hari buruk jadi indah.', '#fbcfe8', '✨'],
            ['🎭 Aura Kuudere', 'Wajah selalu datar tanpa ekspresi, padahal hatinya sangat lembut.', '#93c5fd', '🎭'],
            ['🎮 Aura Solo Leveling', 'Diam-diam terus berkembang jadi yang terkuat tanpa pamer.', '#000000', '🎮'],
            ['🍜 Aura Ramen', 'Kehadiranmu selalu menghangatkan jiwa orang di sekitarmu.', '#f59e0b', '🍜'],
            ['⚔️ Aura Demon Lord', 'Ditakuti oleh lawan, tapi dihormati oleh semua bawahan.', '#7f1d1d', '⚔️'],
            ['🌸 Aura Senpai', 'Auramu sangat dewasa, selalu jadi tempat curhat dan bersandar.', '#a855f7', '🌸'],
        ];

        $gamerData = [
            ['🎮 Aura Pro Player', 'Insting mekanikmu sangat tinggi, kecepatan tangan di luar nalar.', '#3b82f6', '🎮'],
            ['🎒 Aura Carry', 'Sering gendong teman di game maupun di kehidupan nyata.', '#eab308', '🎒'],
            ['🛡️ Aura Tanker', 'Mental bajang, rela pasang badan demi melindungi teman.', '#10b981', '🛡️'],
            ['🏥 Aura Support/Healer', 'Selalu ada saat teman butuh bantuan, hatimu bagai malaikat.', '#f472b6', '🏥'],
            ['🎯 Aura Sniper', 'Fokusmu sangat tajam, satu tindakan langsung tepat sasaran.', '#ef4444', '🎯'],
            ['💨 Aura Speedrunner', 'Selalu ingin menyelesaikan tugas secepat kilat.', '#14b8a6', '💨'],
            ['🏆 Aura MVP', 'Selalu jadi yang terbaik dan paling menonjol di setiap situasi.', '#fbbf24', '🏆'],
            ['🤬 Aura Toxic', 'Sedikit gampang emosi kalau ada yang nggak beres, tapi aslinya baik.', '#dc2626', '🤬'],
            ['AFK Aura AFK', 'Sering ngelamun atau tiba-tiba ngilang tanpa kabar.', '#94a3b8', '💤'],
            ['💰 Aura Pay to Win', 'Percaya bahwa uang bisa menyelesaikan sebagian besar masalah.', '#22c55e', '💰'],
            ['🔍 Aura Explorer', 'Suka mencari hal baru dan mengeksplorasi tempat yang belum pernah dikunjungi.', '#8b5cf6', '🔍'],
            ['⚔️ Aura DPS', 'Memberikan impact yang besar dan cepat dalam setiap tindakan.', '#f97316', '⚔️'],
            ['🎪 Aura Troll', 'Suka iseng dan jahil, tapi selalu bikin suasana jadi ramai.', '#d946ef', '🎪'],
            ['🧠 Aura Strategist', 'Selalu punya rencana A, B, C sebelum melakukan sesuatu.', '#0ea5e9', '🧠'],
            ['👻 Aura Stealth', 'Datang tak diundang, pulang tak diantar, tiba-tiba kerjaan beres.', '#334155', '👻'],
        ];

        $ambisiusData = [
            ['🔥 Aura Si Paling Sibuk', 'Jadwalmu lebih padat dari presiden, auramu sangat membara!', '#ef4444', '🔥'],
            ['📈 Aura Hustler', 'Di pikiranmu cuma ada kerja, kerja, dan kerja. Jangan lupa istirahat!', '#3b82f6', '📈'],
            ['🦅 Aura Elang', 'Visimu sangat jauh ke depan, mengincar puncak tertinggi.', '#eab308', '🦅'],
            ['💪 Aura Alpha', 'Jiwa kepemimpinan yang mendominasi, selalu jadi pengambil keputusan.', '#0f172a', '💪'],
            ['🏆 Aura Pemenang', 'Tidak menerima kekalahan, kamu dilahirkan untuk menjadi nomor satu.', '#fbbf24', '🏆'],
            ['🎯 Aura Target Oriented', 'Fokus pada tujuan, halangan apapun akan diterjang.', '#dc2626', '🎯'],
            ['☕ Aura Kopi Hitam', 'Auramu kuat dan intens, bikin melek siapa saja yang berdebat denganmu.', '#451a03', '☕'],
            ['🦁 Aura Singa', 'Raja di wilayahmu, auramu mengintimidasi sekaligus disegani.', '#b45309', '🦁'],
            ['⚡ Aura Kilat', 'Kerjamu serba cepat, orang lain susah menyamai kecepatanmu.', '#fde047', '⚡'],
            ['🛠️ Aura Problem Solver', 'Semua masalah pasti ada jalan keluarnya jika ada kamu.', '#64748b', '🛠️'],
            ['📚 Aura Akademisi', 'Gila belajar dan haus akan ilmu pengetahuan baru.', '#0284c7', '📚'],
            ['🧗 Aura Pendaki', 'Semakin tinggi tantangannya, semakin kamu semangat!', '#166534', '🧗'],
            ['🚀 Aura Roket', 'Karir dan kehidupanmu siap melesat tak terhingga ke luar angkasa.', '#ec4899', '🚀'],
            ['🕰️ Aura Disiplin', 'Waktu adalah uang, kamu sangat menghargai setiap detik.', '#1e293b', '🕰️'],
            ['⚔️ Aura Gladiator', 'Siap bertarung menghadapi kerasnya dunia setiap hari.', '#7f1d1d', '⚔️'],
        ];

        $santaiData = [
            ['🦥 Aura Kungkang', 'Aura sangat selow, dunia mau kiamat kamu tetap ngopi.', '#a8a29e', '🦥'],
            ['🌴 Aura Anak Pantai', 'Vibe-mu selalu chill, masalah hidup cukup dijawab dengan "Yaudahlah".', '#38bdf8', '🌴'],
            ['🐱 Aura Kucing Oren', 'Santai tapi kadang barbar tanpa alasan yang jelas.', '#f97316', '🐱'],
            ['🍵 Aura Teh Hangat', 'Sangat menenangkan, auramu bikin orang yang stres jadi rileks.', '#84cc16', '🍵'],
            ['🎧 Aura Lofi', 'Menikmati kesendirian dan musik, hidup mengalir seperti air.', '#8b5cf6', '🎧'],
            ['🛌 Aura Kaum Rebahan', 'Kasur adalah magnet terbesarmu, energi berkumpul saat posisi horizontal.', '#cbd5e1', '🛌'],
            ['🐢 Aura Kura-Kura', 'Biar lambat asal selamat, nggak suka diburu-buru.', '#22c55e', '🐢'],
            ['☁️ Aura Awan', 'Suka berimajinasi dan melamun, terombang-ambing ditiup angin.', '#e0f2fe', '☁️'],
            ['🎐 Aura Angin Sepoi', 'Kehadiranmu sangat menyejukkan hati yang sedang panas.', '#a7f3d0', '🎐'],
            ['🧘 Aura Zen', 'Punya kedamaian batin tingkat dewa, sangat sabar menghadapi cobaan.', '#d946ef', '🧘'],
            ['🧸 Aura Boneka Beruang', 'Sangat nyaman dan empuk, asyik diajak malas-malasan.', '#b45309', '🧸'],
            ['🪴 Aura Tanaman Hias', 'Diam saja di pojokan tapi memberikan oksigen dan ketenangan.', '#15803d', '🪴'],
            ['📻 Aura Radio Klasik', 'Aura vintage yang tenang dan penuh nostalgia masa lalu.', '#713f12', '📻'],
            ['🛁 Aura Mandi Busa', 'Auramu memberikan kesegaran dan efek relaksasi yang maksimal.', '#fbcfe8', '🛁'],
            ['🍿 Aura Penonton', 'Suka menyimak drama orang lain sambil makan popcorn.', '#fcd34d', '🍿'],
        ];

        $allData = [
            'sultan' => $sultanData,
            'positif' => $positifData,
            'misterius' => $misteriusData,
            'anime' => $animeData,
            'gamer' => $gamerData,
            'ambisius' => $ambisiusData,
            'santai' => $santaiData,
        ];

        foreach ($allData as $type => $items) {
            foreach ($items as $item) {
                $templates[] = [
                    'aura_type' => $type,
                    'title' => $item[0],
                    'description' => $item[1],
                    'color' => $item[2],
                    'emoji' => $item[3],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        AuraTemplate::insert($templates);
    }
}
