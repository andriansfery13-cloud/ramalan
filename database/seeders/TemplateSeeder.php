<?php

namespace Database\Seeders;

use App\Models\NameMeaningTemplate;
use App\Models\RoastTemplate;
use App\Models\AuraTemplate;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedNameMeanings();
        $this->command->info('✓ Name meaning templates done');

        $this->seedRoasts();
        $this->command->info('✓ Roast templates done');

        $this->seedAuras();
        $this->command->info('✓ Aura templates done');
    }

    private function seedNameMeanings(): void
    {
        $meanings = [
            'A' => [
                ['meaning' => 'Ambisius', 'trait' => 'Penuh semangat dan tekad kuat untuk meraih tujuan', 'category' => 'personality'],
                ['meaning' => 'Aktif', 'trait' => 'Selalu bergerak dan tidak bisa diam', 'category' => 'personality'],
                ['meaning' => 'Artistik', 'trait' => 'Memiliki jiwa seni yang tinggi', 'category' => 'strength'],
                ['meaning' => 'Adventurous', 'trait' => 'Suka petualangan dan hal-hal baru', 'category' => 'personality'],
                ['meaning' => 'Amanah', 'trait' => 'Dapat dipercaya dan bertanggung jawab', 'category' => 'strength'],
                ['meaning' => 'Adaptif', 'trait' => 'Mudah menyesuaikan diri dengan lingkungan baru', 'category' => 'potential'],
                ['meaning' => 'Antusias', 'trait' => 'Selalu bersemangat dalam setiap hal', 'category' => 'personality'],
                ['meaning' => 'Asyik', 'trait' => 'Menyenangkan dan mudah berteman', 'category' => 'personality'],
                ['meaning' => 'Andal', 'trait' => 'Bisa diandalkan dalam situasi apapun', 'category' => 'strength'],
                ['meaning' => 'Anggun', 'trait' => 'Memiliki keanggunan dan karisma alami', 'category' => 'personality'],
            ],
            'B' => [
                ['meaning' => 'Berani', 'trait' => 'Tidak takut menghadapi tantangan', 'category' => 'personality'],
                ['meaning' => 'Bijaksana', 'trait' => 'Penuh pertimbangan dalam mengambil keputusan', 'category' => 'strength'],
                ['meaning' => 'Brilliant', 'trait' => 'Kecerdasan yang menonjol', 'category' => 'potential'],
                ['meaning' => 'Baik Hati', 'trait' => 'Selalu mementingkan kebaikan orang lain', 'category' => 'personality'],
                ['meaning' => 'Bersemangat', 'trait' => 'Energi positif yang menular', 'category' => 'personality'],
                ['meaning' => 'Berdedikasi', 'trait' => 'Totalitas dalam setiap usaha', 'category' => 'strength'],
                ['meaning' => 'Berwibawa', 'trait' => 'Memiliki aura kepemimpinan', 'category' => 'potential'],
                ['meaning' => 'Berbakat', 'trait' => 'Memiliki talenta tersembunyi', 'category' => 'potential'],
                ['meaning' => 'Bersahabat', 'trait' => 'Mudah akrab dengan siapa saja', 'category' => 'personality'],
                ['meaning' => 'Bersinar', 'trait' => 'Memancarkan aura positif', 'category' => 'personality'],
            ],
            'C' => [
                ['meaning' => 'Cerdas', 'trait' => 'Pikiran tajam dan analitis', 'category' => 'strength'],
                ['meaning' => 'Creative', 'trait' => 'Penuh ide-ide inovatif', 'category' => 'potential'],
                ['meaning' => 'Charming', 'trait' => 'Pesona yang memikat', 'category' => 'personality'],
                ['meaning' => 'Ceria', 'trait' => 'Selalu membawa keceriaan', 'category' => 'personality'],
                ['meaning' => 'Confident', 'trait' => 'Percaya diri yang kuat', 'category' => 'strength'],
                ['meaning' => 'Cool', 'trait' => 'Tenang dalam situasi apapun', 'category' => 'personality'],
                ['meaning' => 'Caring', 'trait' => 'Penuh perhatian dan kasih sayang', 'category' => 'personality'],
                ['meaning' => 'Committed', 'trait' => 'Berkomitmen tinggi', 'category' => 'strength'],
                ['meaning' => 'Charismatic', 'trait' => 'Karisma yang luar biasa', 'category' => 'potential'],
                ['meaning' => 'Cermat', 'trait' => 'Teliti dan detail oriented', 'category' => 'strength'],
            ],
            'D' => [
                ['meaning' => 'Dinamis', 'trait' => 'Energi yang berubah-ubah dan selalu fresh', 'category' => 'personality'],
                ['meaning' => 'Dermawan', 'trait' => 'Murah hati dan suka berbagi', 'category' => 'personality'],
                ['meaning' => 'Disiplin', 'trait' => 'Teratur dan konsisten', 'category' => 'strength'],
                ['meaning' => 'Determined', 'trait' => 'Tekad baja yang tak tergoyahkan', 'category' => 'strength'],
                ['meaning' => 'Dreamer', 'trait' => 'Pemimpi besar dengan visi jauh', 'category' => 'potential'],
                ['meaning' => 'Dashing', 'trait' => 'Penampilan menarik dan berkelas', 'category' => 'personality'],
                ['meaning' => 'Dependable', 'trait' => 'Selalu bisa diandalkan', 'category' => 'strength'],
                ['meaning' => 'Diplomatik', 'trait' => 'Pandai bernegosiasi', 'category' => 'potential'],
                ['meaning' => 'Dedikasi', 'trait' => 'Berkomitmen penuh pada tujuan', 'category' => 'strength'],
                ['meaning' => 'Dulce', 'trait' => 'Memiliki sisi manis dan lembut', 'category' => 'personality'],
            ],
            'E' => [
                ['meaning' => 'Energik', 'trait' => 'Penuh energi dan semangat membara', 'category' => 'personality'],
                ['meaning' => 'Elegan', 'trait' => 'Berkelas dan penuh gaya', 'category' => 'personality'],
                ['meaning' => 'Empati', 'trait' => 'Mampu merasakan perasaan orang lain', 'category' => 'strength'],
                ['meaning' => 'Enthusiastic', 'trait' => 'Antusias dalam segala hal', 'category' => 'personality'],
                ['meaning' => 'Efisien', 'trait' => 'Pandai menggunakan waktu dan sumber daya', 'category' => 'strength'],
                ['meaning' => 'Ekspresif', 'trait' => 'Pandai mengekspresikan diri', 'category' => 'potential'],
                ['meaning' => 'Eksploratif', 'trait' => 'Suka menjelajahi hal-hal baru', 'category' => 'potential'],
                ['meaning' => 'Enduring', 'trait' => 'Tahan banting dan kuat mental', 'category' => 'strength'],
                ['meaning' => 'Evolving', 'trait' => 'Selalu berkembang dan belajar', 'category' => 'potential'],
                ['meaning' => 'Extraordinary', 'trait' => 'Luar biasa dalam berbagai hal', 'category' => 'potential'],
            ],
            'F' => [
                ['meaning' => 'Friendly', 'trait' => 'Ramah dan mudah berteman', 'category' => 'personality'],
                ['meaning' => 'Fokus', 'trait' => 'Konsentrasi tinggi pada tujuan', 'category' => 'strength'],
                ['meaning' => 'Fearless', 'trait' => 'Berani tanpa rasa takut', 'category' => 'personality'],
                ['meaning' => 'Fun', 'trait' => 'Menyenangkan dan penuh humor', 'category' => 'personality'],
                ['meaning' => 'Faithful', 'trait' => 'Setia dan bisa dipercaya', 'category' => 'strength'],
                ['meaning' => 'Fleksibel', 'trait' => 'Mudah beradaptasi', 'category' => 'potential'],
                ['meaning' => 'Fantastis', 'trait' => 'Luar biasa dan menakjubkan', 'category' => 'potential'],
                ['meaning' => 'Fresh', 'trait' => 'Selalu punya perspektif baru', 'category' => 'personality'],
                ['meaning' => 'Fighter', 'trait' => 'Pejuang sejati yang pantang menyerah', 'category' => 'strength'],
                ['meaning' => 'Futuristik', 'trait' => 'Berpikiran maju dan visioner', 'category' => 'potential'],
            ],
            'G' => [
                ['meaning' => 'Genuine', 'trait' => 'Tulus dan apa adanya', 'category' => 'personality'],
                ['meaning' => 'Generous', 'trait' => 'Murah hati tanpa pamrih', 'category' => 'personality'],
                ['meaning' => 'Genius', 'trait' => 'Kecerdasan di atas rata-rata', 'category' => 'potential'],
                ['meaning' => 'Gigih', 'trait' => 'Tidak mudah menyerah', 'category' => 'strength'],
                ['meaning' => 'Glamor', 'trait' => 'Memiliki aura yang memukau', 'category' => 'personality'],
                ['meaning' => 'Grateful', 'trait' => 'Pandai bersyukur', 'category' => 'personality'],
                ['meaning' => 'Gentle', 'trait' => 'Lembut dan penuh kasih', 'category' => 'personality'],
                ['meaning' => 'Great', 'trait' => 'Berpotensi menjadi orang besar', 'category' => 'potential'],
                ['meaning' => 'Grounded', 'trait' => 'Membumi dan realistis', 'category' => 'strength'],
                ['meaning' => 'Gallant', 'trait' => 'Gagah berani dan terhormat', 'category' => 'personality'],
            ],
            'H' => [
                ['meaning' => 'Humble', 'trait' => 'Rendah hati dan tidak sombong', 'category' => 'personality'],
                ['meaning' => 'Harmonis', 'trait' => 'Membawa keseimbangan dan kedamaian', 'category' => 'personality'],
                ['meaning' => 'Heroik', 'trait' => 'Jiwa pahlawan yang kuat', 'category' => 'strength'],
                ['meaning' => 'Hangat', 'trait' => 'Memberikan kehangatan pada sekitar', 'category' => 'personality'],
                ['meaning' => 'Honest', 'trait' => 'Jujur dan transparan', 'category' => 'strength'],
                ['meaning' => 'Hopeful', 'trait' => 'Penuh harapan dan optimisme', 'category' => 'personality'],
                ['meaning' => 'Hardworking', 'trait' => 'Pekerja keras yang tekun', 'category' => 'strength'],
                ['meaning' => 'Happy', 'trait' => 'Selalu bahagia dan positif', 'category' => 'personality'],
                ['meaning' => 'Humoris', 'trait' => 'Penuh humor yang cerdas', 'category' => 'personality'],
                ['meaning' => 'Hebat', 'trait' => 'Kemampuan yang luar biasa', 'category' => 'potential'],
            ],
            'I' => [
                ['meaning' => 'Inovatif', 'trait' => 'Penuh inovasi dan ide kreatif', 'category' => 'potential'],
                ['meaning' => 'Inspiratif', 'trait' => 'Menginspirasi orang di sekitar', 'category' => 'strength'],
                ['meaning' => 'Intuitif', 'trait' => 'Insting yang tajam', 'category' => 'strength'],
                ['meaning' => 'Independen', 'trait' => 'Mandiri dan tidak bergantung pada orang lain', 'category' => 'personality'],
                ['meaning' => 'Intelligent', 'trait' => 'Kecerdasan yang mengesankan', 'category' => 'potential'],
                ['meaning' => 'Idealis', 'trait' => 'Memiliki standar tinggi', 'category' => 'personality'],
                ['meaning' => 'Imaginatif', 'trait' => 'Daya imajinasi yang luas', 'category' => 'potential'],
                ['meaning' => 'Integrity', 'trait' => 'Berpegang teguh pada prinsip', 'category' => 'strength'],
                ['meaning' => 'Impressive', 'trait' => 'Memberikan kesan yang mendalam', 'category' => 'personality'],
                ['meaning' => 'Iconic', 'trait' => 'Berpotensi menjadi ikon dan panutan', 'category' => 'potential'],
            ],
            'J' => [
                ['meaning' => 'Jujur', 'trait' => 'Selalu berkata benar', 'category' => 'strength'],
                ['meaning' => 'Jovial', 'trait' => 'Periang dan ceria', 'category' => 'personality'],
                ['meaning' => 'Jenius', 'trait' => 'Kecerdasan luar biasa', 'category' => 'potential'],
                ['meaning' => 'Jeli', 'trait' => 'Pengamatan yang tajam', 'category' => 'strength'],
                ['meaning' => 'Juara', 'trait' => 'Jiwa pemenang yang kuat', 'category' => 'potential'],
                ['meaning' => 'Joyful', 'trait' => 'Membawa kebahagiaan', 'category' => 'personality'],
                ['meaning' => 'Just', 'trait' => 'Adil dan tidak memihak', 'category' => 'strength'],
                ['meaning' => 'Jazzy', 'trait' => 'Penuh gaya dan pesona', 'category' => 'personality'],
                ['meaning' => 'Jinak', 'trait' => 'Tenang dan terkendali', 'category' => 'personality'],
                ['meaning' => 'Jagoan', 'trait' => 'Andalan yang selalu bisa diandalkan', 'category' => 'potential'],
            ],
            'K' => [
                ['meaning' => 'Kreatif', 'trait' => 'Daya cipta yang tinggi', 'category' => 'potential'],
                ['meaning' => 'Kind', 'trait' => 'Baik hati dan penuh kasih', 'category' => 'personality'],
                ['meaning' => 'Kuat', 'trait' => 'Mental dan fisik yang tangguh', 'category' => 'strength'],
                ['meaning' => 'Karismatik', 'trait' => 'Daya tarik yang kuat', 'category' => 'personality'],
                ['meaning' => 'Konsisten', 'trait' => 'Stabil dan bisa diandalkan', 'category' => 'strength'],
                ['meaning' => 'Kompeten', 'trait' => 'Mampu dan cakap', 'category' => 'potential'],
                ['meaning' => 'Kooperatif', 'trait' => 'Mudah bekerja sama', 'category' => 'personality'],
                ['meaning' => 'Kritis', 'trait' => 'Berpikir kritis dan analitis', 'category' => 'strength'],
                ['meaning' => 'Kece', 'trait' => 'Keren dan stylish', 'category' => 'personality'],
                ['meaning' => 'Kebal', 'trait' => 'Tahan terhadap tekanan', 'category' => 'strength'],
            ],
            'L' => [
                ['meaning' => 'Loyal', 'trait' => 'Setia kawan yang luar biasa', 'category' => 'strength'],
                ['meaning' => 'Leader', 'trait' => 'Jiwa pemimpin alami', 'category' => 'potential'],
                ['meaning' => 'Loving', 'trait' => 'Penuh cinta dan kasih sayang', 'category' => 'personality'],
                ['meaning' => 'Lincah', 'trait' => 'Gesit dan tangkas', 'category' => 'personality'],
                ['meaning' => 'Lucu', 'trait' => 'Selalu bisa membuat tertawa', 'category' => 'personality'],
                ['meaning' => 'Logis', 'trait' => 'Berpikir rasional dan logis', 'category' => 'strength'],
                ['meaning' => 'Luar Biasa', 'trait' => 'Kemampuan yang melampaui rata-rata', 'category' => 'potential'],
                ['meaning' => 'Lembut', 'trait' => 'Memiliki sisi kelembutan', 'category' => 'personality'],
                ['meaning' => 'Lucky', 'trait' => 'Beruntung dalam banyak hal', 'category' => 'potential'],
                ['meaning' => 'Luminous', 'trait' => 'Bersinar dan menarik perhatian', 'category' => 'personality'],
            ],
            'M' => [
                ['meaning' => 'Mandiri', 'trait' => 'Bisa berdiri sendiri', 'category' => 'strength'],
                ['meaning' => 'Motivator', 'trait' => 'Pandai memotivasi orang lain', 'category' => 'potential'],
                ['meaning' => 'Magnetic', 'trait' => 'Daya tarik yang sulit ditolak', 'category' => 'personality'],
                ['meaning' => 'Mature', 'trait' => 'Dewasa dalam berpikir dan bertindak', 'category' => 'strength'],
                ['meaning' => 'Majestic', 'trait' => 'Agung dan berwibawa', 'category' => 'personality'],
                ['meaning' => 'Mindful', 'trait' => 'Penuh kesadaran dan perhatian', 'category' => 'personality'],
                ['meaning' => 'Multitalenta', 'trait' => 'Berbakat di banyak bidang', 'category' => 'potential'],
                ['meaning' => 'Mulia', 'trait' => 'Berjiwa mulia dan terpuji', 'category' => 'personality'],
                ['meaning' => 'Misterius', 'trait' => 'Memiliki daya tarik misteri', 'category' => 'personality'],
                ['meaning' => 'Mighty', 'trait' => 'Kekuatan yang dahsyat', 'category' => 'strength'],
            ],
            'N' => [
                ['meaning' => 'Noble', 'trait' => 'Berjiwa mulia dan terhormat', 'category' => 'personality'],
                ['meaning' => 'Natural', 'trait' => 'Alami dan apa adanya', 'category' => 'personality'],
                ['meaning' => 'Nekat', 'trait' => 'Berani mengambil risiko', 'category' => 'strength'],
                ['meaning' => 'Nurturing', 'trait' => 'Pandai merawat dan menjaga', 'category' => 'personality'],
                ['meaning' => 'Niat', 'trait' => 'Penuh niat baik dalam setiap tindakan', 'category' => 'strength'],
                ['meaning' => 'Networking', 'trait' => 'Pandai membangun relasi', 'category' => 'potential'],
                ['meaning' => 'Nifty', 'trait' => 'Cekatan dan terampil', 'category' => 'strength'],
                ['meaning' => 'Nectar', 'trait' => 'Manis dan menyenangkan', 'category' => 'personality'],
                ['meaning' => 'Navigator', 'trait' => 'Pandai menunjukkan arah', 'category' => 'potential'],
                ['meaning' => 'Noteworthy', 'trait' => 'Layak untuk diperhatikan', 'category' => 'potential'],
            ],
            'O' => [
                ['meaning' => 'Optimis', 'trait' => 'Selalu melihat sisi positif', 'category' => 'personality'],
                ['meaning' => 'Original', 'trait' => 'Unik dan otentik', 'category' => 'personality'],
                ['meaning' => 'Outstanding', 'trait' => 'Menonjol dan luar biasa', 'category' => 'potential'],
                ['meaning' => 'Organized', 'trait' => 'Teratur dan rapi', 'category' => 'strength'],
                ['meaning' => 'Open-minded', 'trait' => 'Terbuka pada ide-ide baru', 'category' => 'personality'],
                ['meaning' => 'Observant', 'trait' => 'Pengamatan yang tajam', 'category' => 'strength'],
                ['meaning' => 'Overcomer', 'trait' => 'Mampu mengatasi semua tantangan', 'category' => 'strength'],
                ['meaning' => 'Oasis', 'trait' => 'Memberikan kesegaran pada sekitar', 'category' => 'personality'],
                ['meaning' => 'Omnipotent', 'trait' => 'Serba bisa dalam banyak hal', 'category' => 'potential'],
                ['meaning' => 'On Fire', 'trait' => 'Semangat yang membara', 'category' => 'personality'],
            ],
            'P' => [
                ['meaning' => 'Passionate', 'trait' => 'Penuh gairah dan semangat', 'category' => 'personality'],
                ['meaning' => 'Powerful', 'trait' => 'Kekuatan yang luar biasa', 'category' => 'strength'],
                ['meaning' => 'Patient', 'trait' => 'Sabar dan tenang', 'category' => 'strength'],
                ['meaning' => 'Positive', 'trait' => 'Selalu positif dalam berpikir', 'category' => 'personality'],
                ['meaning' => 'Progressive', 'trait' => 'Selalu maju ke depan', 'category' => 'potential'],
                ['meaning' => 'Protective', 'trait' => 'Melindungi orang-orang tersayang', 'category' => 'personality'],
                ['meaning' => 'Productive', 'trait' => 'Produktif dan efektif', 'category' => 'strength'],
                ['meaning' => 'Pioneer', 'trait' => 'Pelopor dan pembuka jalan', 'category' => 'potential'],
                ['meaning' => 'Persistent', 'trait' => 'Gigih dan tidak menyerah', 'category' => 'strength'],
                ['meaning' => 'Phenomenal', 'trait' => 'Fenomenal dan luar biasa', 'category' => 'potential'],
            ],
            'Q' => [
                ['meaning' => 'Quick', 'trait' => 'Cepat dalam bertindak dan berpikir', 'category' => 'strength'],
                ['meaning' => 'Quality', 'trait' => 'Selalu mengutamakan kualitas', 'category' => 'strength'],
                ['meaning' => 'Quiet', 'trait' => 'Tenang namun penuh kekuatan', 'category' => 'personality'],
                ['meaning' => 'Queen/King', 'trait' => 'Memiliki aura kerajaan', 'category' => 'potential'],
                ['meaning' => 'Quirky', 'trait' => 'Unik dengan cara tersendiri', 'category' => 'personality'],
                ['meaning' => 'Quintessential', 'trait' => 'Contoh sempurna dari kebaikan', 'category' => 'potential'],
                ['meaning' => 'Quantum', 'trait' => 'Potensi tak terbatas', 'category' => 'potential'],
                ['meaning' => 'Qualified', 'trait' => 'Memenuhi kualifikasi tertinggi', 'category' => 'strength'],
                ['meaning' => 'Quencher', 'trait' => 'Memuaskan dahaga pengetahuan', 'category' => 'personality'],
                ['meaning' => 'Quest', 'trait' => 'Selalu dalam pencarian kebenaran', 'category' => 'personality'],
            ],
            'R' => [
                ['meaning' => 'Rajin', 'trait' => 'Tekun dan tidak malas', 'category' => 'strength'],
                ['meaning' => 'Resilient', 'trait' => 'Tahan banting dan cepat pulih', 'category' => 'strength'],
                ['meaning' => 'Romantic', 'trait' => 'Penuh romansa dan perasaan', 'category' => 'personality'],
                ['meaning' => 'Respectful', 'trait' => 'Menghormati semua orang', 'category' => 'personality'],
                ['meaning' => 'Resourceful', 'trait' => 'Pandai mencari solusi', 'category' => 'potential'],
                ['meaning' => 'Reliable', 'trait' => 'Bisa diandalkan kapan saja', 'category' => 'strength'],
                ['meaning' => 'Revolutionary', 'trait' => 'Membawa perubahan besar', 'category' => 'potential'],
                ['meaning' => 'Radiant', 'trait' => 'Bersinar dan memancarkan kehangatan', 'category' => 'personality'],
                ['meaning' => 'Rational', 'trait' => 'Berpikir rasional dan logis', 'category' => 'strength'],
                ['meaning' => 'Remarkable', 'trait' => 'Luar biasa dan patut dikagumi', 'category' => 'potential'],
            ],
            'S' => [
                ['meaning' => 'Smart', 'trait' => 'Cerdas dan pintar', 'category' => 'potential'],
                ['meaning' => 'Strong', 'trait' => 'Kuat fisik dan mental', 'category' => 'strength'],
                ['meaning' => 'Sincere', 'trait' => 'Tulus dan jujur', 'category' => 'personality'],
                ['meaning' => 'Spiritual', 'trait' => 'Memiliki kedalaman spiritual', 'category' => 'personality'],
                ['meaning' => 'Supportive', 'trait' => 'Selalu mendukung orang lain', 'category' => 'personality'],
                ['meaning' => 'Stylish', 'trait' => 'Penuh gaya dan fashionable', 'category' => 'personality'],
                ['meaning' => 'Strategic', 'trait' => 'Berpikir strategis', 'category' => 'potential'],
                ['meaning' => 'Superstar', 'trait' => 'Berpotensi menjadi bintang', 'category' => 'potential'],
                ['meaning' => 'Sabar', 'trait' => 'Kesabaran yang luar biasa', 'category' => 'strength'],
                ['meaning' => 'Setia', 'trait' => 'Loyal dan setia pada komitmen', 'category' => 'strength'],
            ],
            'T' => [
                ['meaning' => 'Tangguh', 'trait' => 'Kuat menghadapi badai kehidupan', 'category' => 'strength'],
                ['meaning' => 'Talented', 'trait' => 'Berbakat luar biasa', 'category' => 'potential'],
                ['meaning' => 'Thoughtful', 'trait' => 'Penuh pertimbangan dan perhatian', 'category' => 'personality'],
                ['meaning' => 'Trustworthy', 'trait' => 'Layak dipercaya sepenuhnya', 'category' => 'strength'],
                ['meaning' => 'Trendsetter', 'trait' => 'Pembuat tren yang diikuti banyak orang', 'category' => 'potential'],
                ['meaning' => 'Tenacious', 'trait' => 'Ulet dan gigih', 'category' => 'strength'],
                ['meaning' => 'Thriving', 'trait' => 'Selalu berkembang dan bertumbuh', 'category' => 'potential'],
                ['meaning' => 'Toleran', 'trait' => 'Menghargai perbedaan', 'category' => 'personality'],
                ['meaning' => 'Top', 'trait' => 'Selalu di posisi teratas', 'category' => 'potential'],
                ['meaning' => 'Terpercaya', 'trait' => 'Amanah dan dapat diandalkan', 'category' => 'strength'],
            ],
            'U' => [
                ['meaning' => 'Unique', 'trait' => 'Satu-satunya dan tidak ada duanya', 'category' => 'personality'],
                ['meaning' => 'Unstoppable', 'trait' => 'Tidak ada yang bisa menghentikan', 'category' => 'strength'],
                ['meaning' => 'Understanding', 'trait' => 'Penuh pengertian', 'category' => 'personality'],
                ['meaning' => 'Uplifting', 'trait' => 'Mengangkat semangat orang lain', 'category' => 'personality'],
                ['meaning' => 'Ultimate', 'trait' => 'Yang terbaik dari yang terbaik', 'category' => 'potential'],
                ['meaning' => 'Ulet', 'trait' => 'Tekun dan tidak mudah menyerah', 'category' => 'strength'],
                ['meaning' => 'Unbeatable', 'trait' => 'Tak terkalahkan', 'category' => 'potential'],
                ['meaning' => 'United', 'trait' => 'Pandai menyatukan orang', 'category' => 'personality'],
                ['meaning' => 'Useful', 'trait' => 'Berguna bagi banyak orang', 'category' => 'strength'],
                ['meaning' => 'Ultra', 'trait' => 'Melampaui batas kemampuan biasa', 'category' => 'potential'],
            ],
            'V' => [
                ['meaning' => 'Visioner', 'trait' => 'Melihat jauh ke depan', 'category' => 'potential'],
                ['meaning' => 'Vibrant', 'trait' => 'Penuh semangat dan warna', 'category' => 'personality'],
                ['meaning' => 'Versatile', 'trait' => 'Serbaguna dan multitalenta', 'category' => 'potential'],
                ['meaning' => 'Valiant', 'trait' => 'Berani dan gagah', 'category' => 'strength'],
                ['meaning' => 'Victorious', 'trait' => 'Selalu meraih kemenangan', 'category' => 'potential'],
                ['meaning' => 'Vital', 'trait' => 'Penting dan tidak tergantikan', 'category' => 'strength'],
                ['meaning' => 'Vivid', 'trait' => 'Hidup dan penuh warna', 'category' => 'personality'],
                ['meaning' => 'Venturous', 'trait' => 'Berani mengambil peluang', 'category' => 'strength'],
                ['meaning' => 'Vigorous', 'trait' => 'Bertenaga dan berstamina tinggi', 'category' => 'strength'],
                ['meaning' => 'Valuable', 'trait' => 'Sangat berharga dan bernilai', 'category' => 'personality'],
            ],
            'W' => [
                ['meaning' => 'Wise', 'trait' => 'Bijaksana dan penuh hikmah', 'category' => 'strength'],
                ['meaning' => 'Warm', 'trait' => 'Hangat dan menyenangkan', 'category' => 'personality'],
                ['meaning' => 'Winner', 'trait' => 'Jiwa pemenang sejati', 'category' => 'potential'],
                ['meaning' => 'Warrior', 'trait' => 'Petarung yang tidak kenal lelah', 'category' => 'strength'],
                ['meaning' => 'Wonderful', 'trait' => 'Menakjubkan dan mengagumkan', 'category' => 'personality'],
                ['meaning' => 'Willpower', 'trait' => 'Kekuatan tekad yang besar', 'category' => 'strength'],
                ['meaning' => 'Witty', 'trait' => 'Cerdas dan jenaka', 'category' => 'personality'],
                ['meaning' => 'Wholesome', 'trait' => 'Baik dan positif secara keseluruhan', 'category' => 'personality'],
                ['meaning' => 'Wild', 'trait' => 'Bebas dan penuh semangat liar', 'category' => 'personality'],
                ['meaning' => 'Worthy', 'trait' => 'Layak mendapat yang terbaik', 'category' => 'potential'],
            ],
            'X' => [
                ['meaning' => 'X-Factor', 'trait' => 'Memiliki faktor X yang istimewa', 'category' => 'potential'],
                ['meaning' => 'Xenial', 'trait' => 'Ramah dan suka menolong', 'category' => 'personality'],
                ['meaning' => 'Xtra', 'trait' => 'Selalu memberikan lebih', 'category' => 'strength'],
                ['meaning' => 'Xplosive', 'trait' => 'Energi yang meledak-ledak', 'category' => 'personality'],
                ['meaning' => 'Xpert', 'trait' => 'Ahli dalam bidangnya', 'category' => 'potential'],
                ['meaning' => 'Xcellent', 'trait' => 'Luar biasa dan excellent', 'category' => 'potential'],
                ['meaning' => 'Xtraordinary', 'trait' => 'Sangat luar biasa', 'category' => 'potential'],
                ['meaning' => 'Xact', 'trait' => 'Tepat dan akurat', 'category' => 'strength'],
                ['meaning' => 'Xhilarating', 'trait' => 'Menggembirakan dan menyegarkan', 'category' => 'personality'],
                ['meaning' => 'Xenon', 'trait' => 'Bersinar terang seperti gas mulia', 'category' => 'personality'],
            ],
            'Y' => [
                ['meaning' => 'Young at Heart', 'trait' => 'Selalu muda dalam jiwa', 'category' => 'personality'],
                ['meaning' => 'Yearning', 'trait' => 'Penuh kerinduan akan kebaikan', 'category' => 'personality'],
                ['meaning' => 'Yielding', 'trait' => 'Menghasilkan buah yang baik', 'category' => 'potential'],
                ['meaning' => 'Youthful', 'trait' => 'Energi muda yang tak pernah padam', 'category' => 'personality'],
                ['meaning' => 'Yes-Can', 'trait' => 'Selalu bilang bisa dan optimis', 'category' => 'strength'],
                ['meaning' => 'Yakin', 'trait' => 'Penuh keyakinan dan percaya diri', 'category' => 'strength'],
                ['meaning' => 'Yummy', 'trait' => 'Menarik dan menawan', 'category' => 'personality'],
                ['meaning' => 'Yonder', 'trait' => 'Bermimpi melampaui batas', 'category' => 'potential'],
                ['meaning' => 'Yang Terbaik', 'trait' => 'Selalu berusaha jadi yang terbaik', 'category' => 'potential'],
                ['meaning' => 'Yeoman', 'trait' => 'Pekerja keras dan setia', 'category' => 'strength'],
            ],
            'Z' => [
                ['meaning' => 'Zealous', 'trait' => 'Penuh semangat dan dedikasi', 'category' => 'personality'],
                ['meaning' => 'Zen', 'trait' => 'Tenang dan damai', 'category' => 'personality'],
                ['meaning' => 'Zesty', 'trait' => 'Penuh energi dan antusiasme', 'category' => 'personality'],
                ['meaning' => 'Zero Fear', 'trait' => 'Tanpa rasa takut', 'category' => 'strength'],
                ['meaning' => 'Zodiak', 'trait' => 'Terhubung dengan energi bintang', 'category' => 'potential'],
                ['meaning' => 'Zoom', 'trait' => 'Bergerak cepat menuju sukses', 'category' => 'strength'],
                ['meaning' => 'Zenith', 'trait' => 'Mencapai puncak tertinggi', 'category' => 'potential'],
                ['meaning' => 'Zippy', 'trait' => 'Gesit dan energik', 'category' => 'personality'],
                ['meaning' => 'Zeus', 'trait' => 'Kekuatan bagai dewa', 'category' => 'potential'],
                ['meaning' => 'Zeal', 'trait' => 'Antusiasme yang menular', 'category' => 'personality'],
            ],
        ];

        $records = [];
        foreach ($meanings as $letter => $traits) {
            foreach ($traits as $trait) {
                $records[] = array_merge(['letter' => $letter], $trait, [
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        NameMeaningTemplate::insert($records);
    }

    private function seedRoasts(): void
    {
        $templates = [
            // Mild
            "Nama kamu tuh kayak password WiFi — panjang, susah diingat, tapi orang tetap mau coba.",
            "Dengan nama kayak gitu, kamu pasti sering jadi bahan auto-correct.",
            "Nama kamu kedengerannya kayak karakter game yang belum di-unlock.",
            "Kamu tuh kayak update software — nggak ada yang minta, tapi tetap datang.",
            "Nama kamu tuh kayak WiFi gratis — semua orang seneng denger, tapi nggak ada yang beneran paham.",
            "Kalau nama kamu jadi lagu, pasti genre-nya elevator music.",
            "Nama kamu kayak CAPTCHA — susah dibaca tapi harus dihadapi.",
            "Kamu tuh kayak notifikasi — muncul terus padahal nggak ada yang panggil.",
            "Nama kamu kedengarannya kayak NPC di game RPG yang nggak penting tapi selalu ada.",
            "Kalau nama kamu jadi film, ratingnya 5.5 di IMDB — nggak jelek, tapi juga nggak memorable.",
            "Nama kamu tuh kayak loading screen — lama diproses tapi worth the wait.",
            "Kamu kayak DLC game — nggak wajib ada, tapi bikin seru.",
            "Nama kamu kayak meme — lucu pertama kali denger, makin sering makin biasa.",
            "Kalau nama kamu jadi aplikasi, pasti sering crash tapi orang tetap install.",
            "Nama kamu kayak iklan YouTube — skip-able tapi kadang menarik.",
            "Kamu tuh kayak typo yang ternyata jadi kata baru yang keren.",
            "Nama kamu kayak background music — nggak sadar ada, tapi terasa kalau hilang.",
            "Kalau nama kamu jadi emoji, pasti yang 🤷 — ambigu tapi sering dipakai.",
            "Nama kamu kayak tutorial yang diskip — harusnya diperhatiin dari awal.",
            "Kamu tuh kayak season 2 — orang nggak expect, tapi ternyata lebih bagus.",
        ];

        $more_templates = [
            "Nama kamu kayak hashtag yang trending — rame tapi nggak ada yang ngerti kenapa.",
            "Kamu tuh kayak font Comic Sans — banyak yang protes, tapi secretly suka.",
            "Nama kamu kedengerannya kayak cheat code yang belum dicoba.",
            "Kalau nama kamu jadi drama Korea, pasti yang banyak plot twist.",
            "Nama kamu kayak spoiler — dateng duluan sebelum konteksnya jelas.",
            "Kamu tuh kayak grup chat yang isinya cuma sticker.",
            "Nama kamu kayak playlist 'Lagu Galau' — panjang dan emosional.",
            "Kalau nama kamu jadi makanan, pasti yang pedes level 0 tapi ngakunya level 10.",
            "Nama kamu kayak voucher diskon — exciting diawal tapi banyak syarat ketentuan.",
            "Kamu tuh kayak fitur beta — belum sempurna tapi orang penasaran.",
        ];

        $records = [];

        foreach ($templates as $t) {
            $records[] = [
                'content' => $t,
                'intensity' => 'mild',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($more_templates as $t) {
            $records[] = [
                'content' => $t,
                'intensity' => 'medium',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Generate more through patterns
        $patterns = [
            "Nama {name} tuh kayak {thing} — {description}.",
            "Kalau {name} jadi {thing}, pasti {description}.",
            "{name} tuh kayak {thing} — {description}.",
        ];

        $things = [
            'ringtone HP', 'wallpaper default', 'font bawaan', 'cookie browser',
            'tab Chrome ke-100', 'email spam yang menarik', 'pop-up iklan yang lucu',
            'file ZIP yang nggak bisa dibuka', 'screenshot blur', 'story Instagram expired',
            'voice note 5 menit', 'TikTok FYP jam 3 pagi', 'GIF loading', 'QR code yang expired',
        ];

        $descriptions = [
            'nggak ada yang minta tapi selalu ada', 'bikin penasaran tapi mengecewakan',
            'classic tapi underrated', 'lucu pertama kali, biasa aja selanjutnya',
            'nggak bisa dihapus dari memori', 'selalu muncul di saat yang nggak tepat',
            'worth it kalau diperhatiin lebih detail', 'unexpected tapi memorable',
            'aesthetic dari luar, chaotic di dalam', 'simple tapi complicated',
        ];

        $names = ['{name}'];

        foreach ($patterns as $pat) {
            foreach ($things as $thing) {
                foreach ($descriptions as $desc) {
                    $content = str_replace(
                        ['{name}', '{thing}', '{description}'],
                        ['kamu', $thing, $desc],
                        $pat
                    );
                    $records[] = [
                        'content' => $content,
                        'intensity' => ['mild', 'medium', 'spicy'][array_rand(['mild', 'medium', 'spicy'])],
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    if (count($records) >= 500) {
                        RoastTemplate::insert($records);
                        $records = [];
                    }
                }
            }
        }

        if (!empty($records)) {
            RoastTemplate::insert($records);
        }
    }

    private function seedAuras(): void
    {
        $auras = [
            'sultan' => [
                'color' => '#fbbf24', 'emoji' => '👑',
                'templates' => [
                    ['title' => 'Sultan Sejati', 'description' => 'Aura kekayaan dan kemewahan terpancar kuat dari namamu. Kamu memiliki jiwa dermawan dan selera tinggi.'],
                    ['title' => 'Raja Muda', 'description' => 'Jiwa sultan mengalir dalam darahmu. Kamu ditakdirkan untuk hidup berkecukupan dan membantu sesama.'],
                    ['title' => 'Diamond Mind', 'description' => 'Pikiranmu selalu fokus pada hal-hal besar. Kamu punya potensi untuk meraih kekayaan yang luar biasa.'],
                    ['title' => 'Golden Aura', 'description' => 'Aura emas mengelilingimu. Setiap langkahmu membawa keberuntungan dan kemakmuran.'],
                    ['title' => 'Royal Vibes', 'description' => 'Kamu memancarkan vibes kerajaan yang kuat. Orang-orang secara alami menghormatimu.'],
                    ['title' => 'Midas Touch', 'description' => 'Apapun yang kamu sentuh berpotensi menjadi emas. Instingmu dalam urusan finansial sangat tajam.'],
                    ['title' => 'Crown Energy', 'description' => 'Energi mahkota terpancar dari setiap tindakanmu. Kamu dilahirkan untuk memimpin.'],
                ],
            ],
            'positif' => [
                'color' => '#22c55e', 'emoji' => '✨',
                'templates' => [
                    ['title' => 'Sunshine Soul', 'description' => 'Jiwamu secerah matahari pagi. Kamu membawa energi positif kemanapun kamu pergi.'],
                    ['title' => 'Good Vibes Only', 'description' => 'Auramu penuh dengan vibes positif. Orang-orang merasa nyaman dan senang di dekatmu.'],
                    ['title' => 'Light Bearer', 'description' => 'Kamu adalah pembawa cahaya di kegelapan. Kehadiranmu mengangkat semangat orang-orang sekitar.'],
                    ['title' => 'Rainbow Energy', 'description' => 'Energimu berwarna-warni seperti pelangi. Kamu mampu membuat hari siapapun jadi lebih cerah.'],
                    ['title' => 'Positive Force', 'description' => 'Kamu adalah kekuatan positif yang menular. Senyummu bisa mengubah suasana dalam sekejap.'],
                    ['title' => 'Joy Magnet', 'description' => 'Kamu menarik kebahagiaan seperti magnet. Kegembiraan datang secara alami padamu.'],
                    ['title' => 'Aura Cerah', 'description' => 'Auramu memancarkan kecerahan yang luar biasa. Kamu adalah sumber inspirasi bagi banyak orang.'],
                ],
            ],
            'misterius' => [
                'color' => '#8b5cf6', 'emoji' => '🔮',
                'templates' => [
                    ['title' => 'Shadow Walker', 'description' => 'Kamu memiliki daya tarik misterius yang membuat orang penasaran. Ada kedalaman yang belum terungkap dari dirimu.'],
                    ['title' => 'Enigma', 'description' => 'Kamu adalah teka-teki yang menarik. Semakin orang mengenalmu, semakin banyak yang ingin mereka ketahui.'],
                    ['title' => 'Mystic Aura', 'description' => 'Aura mistis mengelilingimu. Kamu memiliki intuisi yang sangat kuat dan kedalaman jiwa yang luar biasa.'],
                    ['title' => 'Dark Horse', 'description' => 'Kamu adalah dark horse yang mengejutkan. Potensimu tersembunyi dan siap meledak kapan saja.'],
                    ['title' => 'Midnight Vibes', 'description' => 'Vibemu seredup dan seindah langit malam. Ada ketenangan dan misteri dalam setiap gerakmu.'],
                    ['title' => 'Crystal Gazer', 'description' => 'Matamu seolah bisa melihat hal yang tak terlihat. Intuisimu sering kali terbukti benar.'],
                    ['title' => 'Phantom Energy', 'description' => 'Energimu hadir tanpa terasa, tapi dampaknya sangat nyata. Kamu mempengaruhi tanpa disadari.'],
                ],
            ],
            'anime' => [
                'color' => '#ec4899', 'emoji' => '🎌',
                'templates' => [
                    ['title' => 'Protagonist Energy', 'description' => 'Kamu memancarkan aura protagonis anime! Hidupmu penuh plot twist yang epic.'],
                    ['title' => 'Shounen Spirit', 'description' => 'Semangat pantang menyerahmu mirip karakter shounen. "Aku tidak akan mundur!" adalah motto hidupmu.'],
                    ['title' => 'Kawaii Overload', 'description' => 'Auramu cute overload! Kamu punya sisi kawaii yang bikin orang gemas.'],
                    ['title' => 'Isekai Ready', 'description' => 'Kalau ada portal ke dunia lain, kamu pasti yang pertama masuk. Jiwa petualangmu tak terbendung.'],
                    ['title' => 'Senpai Notice Me', 'description' => 'Kamu punya aura senpai yang kuat. Orang-orang secara alami menghargai dan mengagumimu.'],
                    ['title' => 'Main Character', 'description' => 'Kamu adalah karakter utama dalam cerita hidupmu sendiri. Setiap episode semakin menarik.'],
                    ['title' => 'Otaku Power', 'description' => 'Passion dan dedikasimu terhadap hal yang kamu suka mirip otaku sejati. Kamu all-in!'],
                ],
            ],
            'gamer' => [
                'color' => '#06b6d4', 'emoji' => '🎮',
                'templates' => [
                    ['title' => 'Pro Player', 'description' => 'Auramu memancarkan energi pro player. Apapun yang kamu mainkan, kamu selalu ingin jadi yang terbaik.'],
                    ['title' => 'GG EZ', 'description' => 'Hidupmu kayak game — challenging tapi kamu selalu menang di akhir. GG!'],
                    ['title' => 'Level Up', 'description' => 'Kamu terus naik level dalam kehidupan. Setiap tantangan adalah quest yang harus diselesaikan.'],
                    ['title' => 'MVP Vibes', 'description' => 'Kamu adalah MVP dalam timmu. Orang-orang mengandalkanmu untuk clutch moment.'],
                    ['title' => 'Respawn King', 'description' => 'Setiap kali jatuh, kamu selalu bangkit lagi. Semangat respawn-mu tidak ada matinya.'],
                    ['title' => 'Achievement Unlocked', 'description' => 'Kamu terus membuka achievement baru dalam hidupmu. Setiap hari adalah progress.'],
                    ['title' => 'Boss Fight Ready', 'description' => 'Kamu siap menghadapi boss fight apapun. Mental warrior-mu tidak perlu diragukan.'],
                ],
            ],
            'ambisius' => [
                'color' => '#ef4444', 'emoji' => '🔥',
                'templates' => [
                    ['title' => 'Fire Starter', 'description' => 'Kamu memulai api semangat kemanapun kamu pergi. Ambisimu menular dan memotivasi.'],
                    ['title' => 'Dream Chaser', 'description' => 'Kamu adalah pengejar mimpi sejati. Tidak ada yang bisa menghentikan langkahmu.'],
                    ['title' => 'Go-Getter', 'description' => 'Kamu tidak menunggu kesempatan datang — kamu menciptakannya. Proaktif adalah nama tengahmu.'],
                    ['title' => 'Hustle Mode ON', 'description' => 'Mode hustle-mu selalu aktif. Kamu tahu apa yang kamu mau dan bekerja keras untuk mendapatkannya.'],
                    ['title' => 'Unstoppable Force', 'description' => 'Kamu adalah kekuatan yang tidak bisa dihentikan. Tekadmu bagai baja yang tidak bisa dipatahkan.'],
                    ['title' => 'Vision Board', 'description' => 'Visimu jelas dan terukur. Kamu tahu persis kemana tujuanmu dan bagaimana mencapainya.'],
                    ['title' => 'Empire Builder', 'description' => 'Kamu punya mental pembangun kerajaan. Setiap langkahmu adalah batu bata menuju sukses.'],
                ],
            ],
            'santai' => [
                'color' => '#60a5fa', 'emoji' => '😎',
                'templates' => [
                    ['title' => 'Chill Master', 'description' => 'Kamu adalah master ketenangan. Dalam situasi apapun, kamu tetap santai dan terkendali.'],
                    ['title' => 'Zen Mode', 'description' => 'Auramu setenang danau di pagi hari. Kehadiranmu membawa kedamaian pada orang sekitar.'],
                    ['title' => 'Easy Going', 'description' => 'Hidupmu mengalir seperti air. Kamu tidak memaksa dan membiarkan semua berjalan natural.'],
                    ['title' => 'No Drama', 'description' => 'Kamu anti drama dan negativitas. Hidupmu dipenuhi dengan ketenangan dan kedamaian.'],
                    ['title' => 'Vibes Kalem', 'description' => 'Vibemu kalem banget. Orang-orang merasa rileks dan nyaman di sekitarmu.'],
                    ['title' => 'Beach Energy', 'description' => 'Energimu se-relaxing pantai di sore hari. Kamu membawa suasana liburan kemanapun pergi.'],
                    ['title' => 'Peace Keeper', 'description' => 'Kamu adalah penjaga kedamaian. Konflik mereda saat kamu hadir dengan ketenangan jiwamu.'],
                ],
            ],
        ];

        $records = [];
        foreach ($auras as $type => $data) {
            foreach ($data['templates'] as $tmpl) {
                $records[] = [
                    'aura_type' => $type,
                    'title' => $tmpl['title'],
                    'description' => $tmpl['description'],
                    'color' => $data['color'],
                    'emoji' => $data['emoji'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        AuraTemplate::insert($records);
    }
}
