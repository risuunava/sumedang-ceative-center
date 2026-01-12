<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Sop;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed rooms
        $rooms = [
            [
                'name' => 'LOBI',
                'slug' => 'lobi',
                'description' => 'Ruang lobi yang luas untuk pertemuan informal dan penerimaan tamu',
                'capacity' => 50,
                'facilities' => 'AC, Sofa, Meja, WiFi, Proyektor',
                'price_per_hour' => 150000,
                'image' => 'lobi.jpg',
            ],
            [
                'name' => 'RUANGAN KELAS',
                'slug' => 'ruangan-kelas',
                'description' => 'Ruang kelas untuk workshop, pelatihan, dan pendidikan',
                'capacity' => 30,
                'facilities' => 'AC, Whiteboard, Proyektor, Meja & Kursi, WiFi',
                'price_per_hour' => 200000,
                'image' => 'kelas.jpg',
            ],
            [
                'name' => 'RUANGAN AUDITORIUM',
                'slug' => 'ruangan-auditorium',
                'description' => 'Auditorium dengan kapasitas besar untuk seminar dan presentasi',
                'capacity' => 200,
                'facilities' => 'AC, Panggung, Sound System, Proyektor, Lighting',
                'price_per_hour' => 500000,
                'image' => 'auditorium.jpg',
            ],
            [
                'name' => 'RUANGAN CO-WORKING SPACE',
                'slug' => 'ruangan-co-working-space',
                'description' => 'Ruang kerja bersama untuk freelancer dan startup',
                'capacity' => 40,
                'facilities' => 'AC, Meja Kerja, WiFi, Printer, Coffee Corner',
                'price_per_hour' => 100000,
                'image' => 'coworking.jpg',
            ],
            [
                'name' => 'RUANGAN STUDIO MUSIK',
                'slug' => 'ruangan-studio-musik',
                'description' => 'Studio musik lengkap dengan peralatan rekaman',
                'capacity' => 10,
                'facilities' => 'Instrumen Musik, Sound System, Mixer, Ruang Kedap Suara',
                'price_per_hour' => 300000,
                'image' => 'studio-musik.jpg',
            ],
            [
                'name' => 'RUANGAN TEATER',
                'slug' => 'ruangan-teater',
                'description' => 'Teater untuk pertunjukan seni dan drama',
                'capacity' => 150,
                'facilities' => 'Panggung, Lighting, Sound System, Gorden, Ruang Ganti',
                'price_per_hour' => 400000,
                'image' => 'teater.jpg',
            ],
            [
                'name' => 'RUANG EDITING',
                'slug' => 'ruang-editing',
                'description' => 'Ruang editing video dan audio dengan komputer spesifikasi tinggi',
                'capacity' => 8,
                'facilities' => 'PC Editing, Monitor 4K, Software Editing, Headphone',
                'price_per_hour' => 250000,
                'image' => 'editing.jpg',
            ],
            [
                'name' => 'RUANG SENI PERTUNJUKAN',
                'slug' => 'ruang-seni-pertunjukan',
                'description' => 'Ruang untuk latihan dan pertunjukan seni',
                'capacity' => 25,
                'facilities' => 'Cermin Besar, Barre, Sound System, AC',
                'price_per_hour' => 180000,
                'image' => 'seni-pertunjukan.jpg',
            ],
            [
                'name' => 'RUANG SENI RUPA',
                'slug' => 'ruang-seni-rupa',
                'description' => 'Studio untuk melukis dan seni rupa lainnya',
                'capacity' => 20,
                'facilities' => 'Easel, Pencahayaan Alami, Wastafel, Rak Penyimpanan',
                'price_per_hour' => 120000,
                'image' => 'seni-rupa.jpg',
            ],
            [
                'name' => 'RUANGAN FOTOGRAFI',
                'slug' => 'ruangan-fotografi',
                'description' => 'Studio fotografi dengan backdrop dan lighting profesional',
                'capacity' => 15,
                'facilities' => 'Lighting Kit, Backdrop, Kamera Stand, Changing Room',
                'price_per_hour' => 220000,
                'image' => 'fotografi.jpg',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        // Seed SOP
        $sops = [
            [
                'title' => 'Pendaftaran dan Persyaratan',
                'content' => '1. Pengguna harus terdaftar sebagai member Sumedang Creative Center
2. Menyiapkan KTP/Kartu Pelajar sebagai identitas
3. Mengisi formulir peminjaman secara lengkap
4. Menyertakan proposal kegiatan (untuk keperluan tertentu)',
                'order' => 1,
            ],
            [
                'title' => 'Proses Pemesanan',
                'content' => '1. Pilih ruangan yang tersedia pada jadwal yang diinginkan
2. Lakukan booking minimal 2 jam sebelum penggunaan
3. Booking dapat dilakukan maksimal 30 hari sebelumnya
4. Durasi minimal peminjaman adalah 2 jam
5. Konfirmasi booking akan diterima dalam 1x24 jam',
                'order' => 2,
            ],
            [
                'title' => 'Pembayaran',
                'content' => '1. Pembayaran dilakukan setelah booking disetujui
2. Metode pembayaran: Transfer Bank atau Tunai di lokasi
3. Batas waktu pembayaran: 24 jam setelah persetujuan
4. Pembatalan booking dikenakan biaya 20% dari total',
                'order' => 3,
            ],
            [
                'title' => 'Saat Penggunaan Ruangan',
                'content' => '1. Datang 15 menit sebelum waktu booking
2. Lapor ke resepsionis dengan menunjukkan bukti booking
3. Jaga kebersihan dan kerapihan ruangan
4. Laporkan kerusakan peralatan sebelum menggunakan
5. Tidak diperbolehkan merokok di dalam ruangan',
                'order' => 4,
            ],
            [
                'title' => 'Setelah Penggunaan',
                'content' => '1. Kembalikan ruangan dalam keadaan bersih
2. Matikan semua peralatan elektronik
3. Laporkan ke resepsionis untuk pengecekan
4. Isi form evaluasi penggunaan ruangan
5. Ambil barang bawaan pribadi',
                'order' => 5,
            ],
        ];

        foreach ($sops as $sop) {
            Sop::create($sop);
        }
    }
}