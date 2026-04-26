<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Soal;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing soals
        Soal::query()->delete();
        
        // Bank soal CPNS
        $bank_soal = [
            // TWK Questions (10 soal)
            [
                'pertanyaan' => 'Pancasila sebagai dasar negara Indonesia tercantum dalam pembukaan UUD 1945 alinea ke-...',
                'opsi_a' => 'Pertama',
                'opsi_b' => 'Kedua',
                'opsi_c' => 'Ketiga',
                'opsi_d' => 'Keempat',
                'jawaban_benar' => 'D',
                'pembahasan' => 'Pancasila tercantum dalam alinea keempat pembukaan UUD 1945 sebagai dasar negara Indonesia.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Sila pertama Pancasila berbunyi "Ketuhanan Yang Maha Esa" memiliki makna bahwa negara Indonesia...',
                'opsi_a' => 'Negara agama',
                'opsi_b' => 'Negara sekuler',
                'opsi_c' => 'Negara yang berdasarkan ketuhanan tetapi bukan negara agama',
                'opsi_d' => 'Negara atheis',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Sila pertama Pancasila menegaskan bahwa Indonesia berdasarkan ketuhanan namun bukan negara agama, melindungi kebebasan beragama.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Proklamasi Kemerdekaan Indonesia dibacakan pada tanggal...',
                'opsi_a' => '16 Agustus 1945',
                'opsi_b' => '17 Agustus 1945',
                'opsi_c' => '18 Agustus 1945',
                'opsi_d' => '19 Agustus 1945',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Proklamasi Kemerdekaan Indonesia dibacakan oleh Ir. Soekarno pada tanggal 17 Agustus 1945 di Jalan Pegangsaan Timur 56, Jakarta.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'BPUPKI dibentuk oleh pemerintah Jepang pada tanggal...',
                'opsi_a' => '1 Maret 1945',
                'opsi_b' => '29 April 1945',
                'opsi_c' => '1 Juni 1945',
                'opsi_d' => '7 Agustus 1945',
                'jawaban_benar' => 'A',
                'pembahasan' => 'BPUPKI (Badan Penyelidik Usaha-Usaha Persiapan Kemerdekaan Indonesia) dibentuk pada 1 Maret 1945 oleh pemerintah Jepang.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Lambang negara Indonesia adalah Garuda Pancasila yang diatur dalam UU Nomor...',
                'opsi_a' => 'UU No. 12 Tahun 2011',
                'opsi_b' => 'UU No. 24 Tahun 2009',
                'opsi_c' => 'UU No. 39 Tahun 1999',
                'opsi_d' => 'UU No. 32 Tahun 2004',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Lambang negara Garuda Pancasila diatur dalam UU No. 24 Tahun 2009 tentang Bendera, Bahasa, Lambang Negara, dan Lagu Kebangsaan.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Semboyan Bhinneka Tunggal Ika diambil dari kitab...',
                'opsi_a' => 'Bharatayudha',
                'opsi_b' => 'Sutasoma',
                'opsi_c' => 'Arjuna Wiwaha',
                'opsi_d' => 'Ramayana',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Semboyan Bhinneka Tunggal Ika diambil dari kitab Sutasoma karya Mpu Tantular yang berarti "Berbeda-beda tetapi tetap satu jua".',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Negara Kesatuan Republik Indonesia (NKRI) terdiri dari...',
                'opsi_a' => '34 provinsi',
                'opsi_b' => '33 provinsi',
                'opsi_c' => '35 provinsi',
                'opsi_d' => '32 provinsi',
                'jawaban_benar' => 'A',
                'pembahasan' => 'NKRI terdiri dari 34 provinsi yang tersebar dari Sabang sampai Merauke.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'UUD 1945 diamandemen sebanyak...',
                'opsi_a' => '3 kali',
                'opsi_b' => '4 kali',
                'opsi_c' => '5 kali',
                'opsi_d' => '6 kali',
                'jawaban_benar' => 'B',
                'pembahasan' => 'UUD 1945 diamandemen sebanyak 4 kali, yaitu pada tahun 1999, 2000, 2001, dan 2002.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Pahlawan nasional yang dikenal sebagai "Bapak Pendidikan Nasional" adalah...',
                'opsi_a' => 'Ki Hajar Dewantara',
                'opsi_b' => 'Raden Adjeng Kartini',
                'opsi_c' => 'Dewi Sartika',
                'opsi_d' => 'Raden Saleh',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Ki Hajar Dewantara dijuluki sebagai "Bapak Pendidikan Nasional" karena jasanya dalam mendirikan Taman Siswa dan memperjuangkan pendidikan bagi rakyat Indonesia.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Konsep Wawasan Nusantara pertama kali dikemukakan oleh...',
                'opsi_a' => 'Ir. Soekarno',
                'opsi_b' => 'Mohammad Hatta',
                'opsi_c' => 'Dr. Soepomo',
                'opsi_d' => 'A.H. Nasution',
                'jawaban_benar' => 'D',
                'pembahasan' => 'Konsep Wawasan Nusantara pertama kali dikemukakan oleh A.H. Nasution dalam bukunya "Wawasan Nusantara".',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sulit'
            ],

            // TIU Questions (10 soal)
            [
                'pertanyaan' => 'Deret angka: 2, 5, 11, 23, 47, ... Angka berikutnya adalah...',
                'opsi_a' => '93',
                'opsi_b' => '94',
                'opsi_c' => '95',
                'opsi_d' => '96',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Pola deret: ×2 + 1. 2×2+1=5, 5×2+1=11, 11×2+1=23, 23×2+1=47, 47×2+1=95.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Jika semua dokter adalah orang yang pintar dan beberapa orang yang pintar adalah kaya, maka...',
                'opsi_a' => 'Semua dokter adalah kaya',
                'opsi_b' => 'Sebagian dokter adalah kaya',
                'opsi_c' => 'Tidak dapat ditarik kesimpulan',
                'opsi_d' => 'Semua orang kaya adalah dokter',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Dari premis yang diberikan, tidak dapat ditarik kesimpulan yang pasti tentang hubungan antara dokter dan kekayaan.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Sinonim dari kata "Konsisten" adalah...',
                'opsi_a' => 'Berubah-ubah',
                'opsi_b' => 'Tetap',
                'opsi_c' => 'Acak',
                'opsi_d' => 'Sementara',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Konsisten berarti tetap, tidak berubah-ubah, atau konsisten dalam tindakan dan pendirian.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Antonim dari kata "Optimis" adalah...',
                'opsi_a' => 'Percaya diri',
                'opsi_b' => 'Positif',
                'opsi_c' => 'Pesimis',
                'opsi_d' => 'Harapan',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Optimis berarti berpikir positif dan percaya diri, sedangkan antonimnya adalah pesimis yang berarti berpikir negatif.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Sebuah persegi memiliki keliling 48 cm. Luas persegi tersebut adalah...',
                'opsi_a' => '121 cm²',
                'opsi_b' => '144 cm²',
                'opsi_c' => '169 cm²',
                'opsi_d' => '196 cm²',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Keliling = 4 × sisi, maka sisi = 48 ÷ 4 = 12 cm. Luas = sisi² = 12² = 144 cm².',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Jika A = 3, B = 6, C = 12, maka D =...',
                'opsi_a' => '18',
                'opsi_b' => '24',
                'opsi_c' => '30',
                'opsi_d' => '36',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pola: A×2=B, B×2=C, C×2=D. Maka 12×2=24.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Manakah yang merupakan bilangan komposit?',
                'opsi_a' => '2',
                'opsi_b' => '3',
                'opsi_c' => '5',
                'opsi_d' => '9',
                'jawaban_benar' => 'D',
                'pembahasan' => 'Bilangan komposit adalah bilangan yang memiliki lebih dari dua faktor. 9 memiliki faktor 1, 3, dan 9.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Deret huruf: A, C, F, J, O, ... Huruf berikutnya adalah...',
                'opsi_a' => 'S',
                'opsi_b' => 'T',
                'opsi_c' => 'U',
                'opsi_d' => 'V',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Pola: +2, +3, +4, +5, +6. A(1)+2=C(3), C(3)+3=F(6), F(6)+4=J(10), J(10)+5=O(15), O(15)+6=U(21).',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Jika 25% dari sebuah bilangan adalah 30, maka bilangan tersebut adalah...',
                'opsi_a' => '100',
                'opsi_b' => '110',
                'opsi_c' => '120',
                'opsi_d' => '130',
                'jawaban_benar' => 'C',
                'pembahasan' => '25% × bilangan = 30, maka bilangan = 30 ÷ 0.25 = 120.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Silogisme: Semua manusia fana. Socrates adalah manusia. Kesimpulan...',
                'opsi_a' => 'Socrates abadi',
                'opsi_b' => 'Socrates fana',
                'opsi_c' => 'Tidak dapat ditarik kesimpulan',
                'opsi_d' => 'Socrates bukan manusia',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Dari premis "Semua manusia fana" dan "Socrates adalah manusia", dapat disimpulkan "Socrates fana". Ini adalah silogisme valid.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],

            // TKP Questions (10 soal)
            [
                'pertanyaan' => 'Saat Anda melayani warga yang sedang marah, sikap yang paling tepat adalah...',
                'opsi_a' => 'Membela diri dan membalas kemarahan',
                'opsi_b' => 'Mendengarkan dengan sabar dan mencari solusi',
                'opsi_c' => 'Mengabaikan keluhan warga tersebut',
                'opsi_d' => 'Menyuruh warga pergi jika tidak puas',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Dalam pelayanan publik, mendengarkan dengan sabar dan mencari solusi adalah sikap profesional yang menunjukkan empati dan kepedulian.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anda mengetahui ada rekan kerja yang melakukan korupsi. Tindakan yang paling tepat adalah...',
                'opsi_a' => 'Ikut serta dalam korupsi tersebut',
                'opsi_b' => 'Melaporkan ke atasan atau instansi berwenang',
                'opsi_c' => 'Diam saja karena tidak ingin terlibat',
                'opsi_d' => 'Menyebarkan kabar tersebut ke rekan lain',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Melaporkan tindakan korupsi adalah bentuk integritas dan tanggung jawab sebagai pegawai negara.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Saat bekerja di tim yang beragam latar belakang, sikap yang sebaiknya adalah...',
                'opsi_a' => 'Mengisolasi diri dari perbedaan',
                'opsi_b' => 'Menghargai perbedaan dan membangun kerja sama',
                'opsi_c' => 'Memaksakan pendapat sendiri kepada tim',
                'opsi_d' => 'Mencari alasan untuk tidak berpartisipasi',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menghargai perbedaan dan membangun kerja sama adalah sikap adaptasi yang baik dalam lingkungan kerja yang beragam.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anda diminta untuk menyelesaikan tugas dengan deadline yang sangat ketat. Respon yang tepat adalah...',
                'opsi_a' => 'Menolak tugas tersebut',
                'opsi_b' => 'Mengeluh kepada rekan kerja',
                'opsi_c' => 'Mengatur prioritas dan bekerja secara efisien',
                'opsi_d' => 'Mengerjakan dengan asal-asalan agar selesai cepat',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Mengatur prioritas dan bekerja secara efisien menunjukkan profesionalisme dan kemampuan manajemen waktu yang baik.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat atasan memberikan tugas baru saat Anda sudah sibuk, sikap yang profesional adalah...',
                'opsi_a' => 'Menolak secara kasar',
                'opsi_b' => 'Menerima dan mengkomunikasikan kapasitas kerja',
                'opsi_c' => 'Mengabaikan tugas baru',
                'opsi_d' => 'Mengerjakan dengan kualitas rendah',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menerima tugas sambil mengkomunikasikan kapasitas kerja menunjukkan sikap profesional dan tanggung jawab.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anda menemukan kesalahan dalam keputusan atasan. Tindakan yang paling tepat adalah...',
                'opsi_a' => 'Menyebarluaskan kesalahan tersebut',
                'opsi_b' => 'Mengkomunikasikan secara pribadi dan sopan',
                'opsi_c' => 'Mengabaikan kesalahan tersebut',
                'opsi_d' => 'Mencela atasan di depan rekan kerja',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Mengkomunikasikan kesalahan secara pribadi dan sopan menunjukkan integritas dan profesionalisme.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Saat menghadapi perubahan organisasi, sikap yang sebaiknya adalah...',
                'opsi_a' => 'Menghalangi perubahan',
                'opsi_b' => 'Menerima dan beradaptasi dengan positif',
                'opsi_c' => 'Mencari alasan untuk menolak',
                'opsi_d' => 'Menunggu orang lain beradaptasi',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menerima dan beradaptasi dengan positif menunjukkan kemampuan adaptasi yang baik terhadap perubahan.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anda diminta untuk mengambil keputusan sulit dengan informasi terbatas. Tindakan yang tepat adalah...',
                'opsi_a' => 'Menghindari pengambilan keputusan',
                'opsi_b' => 'Mengambil keputusan berdasarkan analisis yang ada',
                'opsi_c' => 'Menunggu sampai informasi lengkap',
                'opsi_d' => 'Mendelegasikan ke orang lain',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Mengambil keputusan berdasarkan analisis yang ada menunjukkan kemampuan pengambilan keputusan yang bertanggung jawab.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Saat ada konflik antara pekerjaan dan keluarga, sikap yang seimbang adalah...',
                'opsi_a' => 'Mengorbankan keluarga demi pekerjaan',
                'opsi_b' => 'Mengabaikan pekerjaan demi keluarga',
                'opsi_c' => 'Mencari keseimbangan dan komunikasi yang baik',
                'opsi_d' => 'Memilih salah satu secara ekstrem',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Mencari keseimbangan dan komunikasi yang baik menunjukkan kemampuan manajemen work-life balance.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anda mendapat kritik dari atasan yang merendahkan. Respon yang paling profesional adalah...',
                'opsi_a' => 'Balas merendahkan atasan',
                'opsi_b' => 'Menerima dengan tenang dan menjunjung etika',
                'opsi_c' => 'Mengeluh ke rekan kerja',
                'opsi_d' => 'Mengundurkan diri secara emosional',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menerima kritik dengan tenang dan menjunjung etika menunjukkan kedewasaan dan profesionalisme tinggi.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],

            // Additional TWK Questions (10 soal) - Sejarah Kemerdekaan, Tokoh Nasional, Tata Negara
            [
                'pertanyaan' => 'Pertempuran Ambarawa terjadi pada tanggal...',
                'opsi_a' => '20 Mei 1908',
                'opsi_b' => '28 Oktober 1928',
                'opsi_c' => '20 Oktober 1945',
                'opsi_d' => '17 Agustus 1945',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Pertempuran Ambarawa terjadi pada 20 Oktober 1945 antara pasukan Indonesia dan Inggris.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Gubernur Jenderal pertama di Hindia Belanda adalah...',
                'opsi_a' => 'Jan Pieterszoon Coen',
                'opsi_b' => 'Herman Willem Daendels',
                'opsi_c' => 'Cornelis de Houtman',
                'opsi_d' => 'Johan van Oldenbarnevelt',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Jan Pieterszoon Coen adalah Gubernur Jenderal pertama VOC di Hindia Belanda (1619-1623).',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Tokoh yang dikenal sebagai "Bapak Koperasi Indonesia" adalah...',
                'opsi_a' => 'Mohammad Hatta',
                'opsi_b' => 'Raden Adjeng Kartini',
                'opsi_c' => 'H. Agus Salim',
                'opsi_d' => 'Ki Hajar Dewantara',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Mohammad Hatta dikenal sebagai "Bapak Koperasi Indonesia" karena jasanya dalam memperjuangkan gerakan koperasi.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'UU No. 39 Tahun 1999 mengatur tentang...',
                'opsi_a' => 'Hak Asasi Manusia',
                'opsi_b' => 'Pemerintahan Daerah',
                'opsi_c' => 'Otonomi Daerah',
                'opsi_d' => 'Keuangan Negara',
                'jawaban_benar' => 'A',
                'pembahasan' => 'UU No. 39 Tahun 1999 adalah Undang-Undang tentang Hak Asasi Manusia.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Perjanjian Renville ditandatangani pada tanggal...',
                'opsi_a' => '17 Januari 1948',
                'opsi_b' => '17 Agustus 1945',
                'opsi_c' => '27 Desember 1949',
                'opsi_d' => '18 Agustus 1945',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Perjanjian Renville ditandatangani pada 17 Januari 1948 antara Indonesia dan Belanda di atas kapal USS Renville.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'DPRD sebagai lembaga perwakilan rakyat di tingkat daerah memiliki fungsi...',
                'opsi_a' => 'Legislatif, eksekutif, dan yudikatif',
                'opsi_b' => 'Legislatif, budgeting, dan pengawasan',
                'opsi_c' => 'Eksekutif dan legislatif saja',
                'opsi_d' => 'Pengawasan dan yudikatif',
                'jawaban_benar' => 'B',
                'pembahasan' => 'DPRD memiliki tiga fungsi utama: legislatif, budgeting, dan pengawasan sesuai UU No. 23 Tahun 2014.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Pahlawan nasional yang dikenal sebagai "Pahlawan Revolusi" adalah...',
                'opsi_a' => 'Diponegoro',
                'opsi_b' => 'Ahmad Yani',
                'opsi_c' => 'Sutan Sjahrir',
                'opsi_d' => 'Bung Tomo',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Jenderal Ahmad Yani dikenal sebagai "Pahlawan Revolusi" karena gugur dalam peristiwa G30S/PKI.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Konsep negara hukum (Rechtsstaat) di Indonesia diadopsi dari...',
                'opsi_a' => 'Inggris',
                'opsi_b' => 'Belanda',
                'opsi_c' => 'Jerman',
                'opsi_d' => 'Amerika Serikat',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Konsep negara hukum Indonesia mengadopsi konsep Rechtsstaat dari Jerman, bukan Rule of Law dari Inggris.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Komisi Pemilihan Umum (KPU) adalah lembaga...',
                'opsi_a' => 'Eksekutif',
                'opsi_b' => 'Legislatif',
                'opsi_c' => 'Yudikatif',
                'opsi_d' => 'Kependudukan',
                'jawaban_benar' => 'C',
                'pembahasan' => 'KPU adalah lembaga yudikatif negara yang bertugas menyelenggarakan pemilihan umum.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Tokoh nasional yang dikenal sebagai "Bapak Pers Nasional" adalah...',
                'opsi_a' => 'R.M. Tirto Adhi Soerjo',
                'opsi_b' => 'Djamaluddin Adinegoro',
                'opsi_c' => 'S.M. Kartodikromo',
                'opsi_d' => 'Ernest Douwes Dekker',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Djamaluddin Adinegoro dikenal sebagai "Bapak Pers Nasional" karena jasanya dalam dunia jurnalistik.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],

            // Additional TIU Questions (10 soal) - Perbandingan Kuantitatif, Deret Angka Lanjut, Penalaran Logis
            [
                'pertanyaan' => 'Jika A : B = 3 : 4 dan B : C = 6 : 5, maka A : C =...',
                'opsi_a' => '9 : 10',
                'opsi_b' => '18 : 20',
                'opsi_c' => '9 : 5',
                'opsi_d' => '3 : 5',
                'jawaban_benar' => 'A',
                'pembahasan' => 'A:B = 3:4, B:C = 6:5. Samakan B: A:B = 9:12, B:C = 12:10. Maka A:C = 9:10.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Deret angka: 3, 7, 15, 31, 63, ... Angka berikutnya adalah...',
                'opsi_a' => '125',
                'opsi_b' => '126',
                'opsi_c' => '127',
                'opsi_d' => '128',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Pola: ×2 + 1. 3×2+1=7, 7×2+1=15, 15×2+1=31, 31×2+1=63, 63×2+1=127.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Semua kucing adalah mamalia. Sebagian mamalia adalah hewan peliharaan. Kesimpulan yang valid adalah...',
                'opsi_a' => 'Semua kucing adalah hewan peliharaan',
                'opsi_b' => 'Sebagian kucing adalah hewan peliharaan',
                'opsi_c' => 'Tidak dapat ditarik kesimpulan',
                'opsi_d' => 'Semua hewan peliharaan adalah kucing',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Dari premis yang diberikan, tidak dapat ditarik kesimpulan yang pasti tentang hubungan antara kucing dan hewan peliharaan.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Jika x : y = 4 : 5 dan y : z = 10 : 3, maka x : z =...',
                'opsi_a' => '8 : 3',
                'opsi_b' => '40 : 15',
                'opsi_c' => '4 : 3',
                'opsi_d' => '40 : 3',
                'jawaban_benar' => 'A',
                'pembahasan' => 'x:y = 4:5, y:z = 10:3. Samakan y: x:y = 8:10, y:z = 10:3. Maka x:z = 8:3.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Deret angka: 1, 4, 9, 16, 25, 36, ... Angka berikutnya adalah...',
                'opsi_a' => '45',
                'opsi_b' => '49',
                'opsi_c' => '50',
                'opsi_d' => '64',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pola: kuadrat bilangan asli. 1²=1, 2²=4, 3²=9, 4²=16, 5²=25, 6²=36, 7²=49.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Jika semua siswa yang rajin pasti lulus ujian, dan Andi lulus ujian, maka...',
                'opsi_a' => 'Andi pasti rajin',
                'opsi_b' => 'Andi mungkin rajin atau tidak',
                'opsi_c' => 'Andi pasti tidak rajin',
                'opsi_d' => 'Tidak dapat ditarik kesimpulan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Ini adalah kesalahan logika. "Jika P maka Q" tidak berarti "Jika Q maka P". Andi lulus tidak menjamin dia rajin.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Perbandingan uang A dan B adalah 2 : 3. Jika uang A Rp 40.000, maka uang B adalah...',
                'opsi_a' => 'Rp 50.000',
                'opsi_b' => 'Rp 60.000',
                'opsi_c' => 'Rp 70.000',
                'opsi_d' => 'Rp 80.000',
                'jawaban_benar' => 'B',
                'pembahasan' => '2 : 3 = 40.000 : x. 2x = 120.000, x = 60.000.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Deret angka: 2, 6, 18, 54, 162, ... Angka berikutnya adalah...',
                'opsi_a' => '324',
                'opsi_b' => '432',
                'opsi_c' => '486',
                'opsi_d' => '648',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Pola: ×3. 2×3=6, 6×3=18, 18×3=54, 54×3=162, 162×3=486.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Semua dokter adalah sarjana. Sebagian sarjana adalah pengusaha. Kesimpulan yang benar adalah...',
                'opsi_a' => 'Semua dokter adalah pengusaha',
                'opsi_b' => 'Sebagian dokter adalah pengusaha',
                'opsi_c' => 'Tidak ada dokter yang pengusaha',
                'opsi_d' => 'Tidak dapat ditarik kesimpulan yang pasti',
                'jawaban_benar' => 'D',
                'pembahasan' => 'Dari premis yang diberikan, tidak dapat ditarik kesimpulan yang pasti tentang hubungan antara dokter dan pengusaha.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Jika perbandingan panjang dan lebar persegi panjang adalah 3 : 2 dan kelilingnya 40 cm, maka luasnya adalah...',
                'opsi_a' => '64 cm²',
                'opsi_b' => '72 cm²',
                'opsi_c' => '80 cm²',
                'opsi_d' => '96 cm²',
                'jawaban_benar' => 'D',
                'pembahasan' => '3x + 2x + 3x + 2x = 40, 10x = 40, x = 4. Panjang = 12 cm, lebar = 8 cm. Luas = 12 × 8 = 96 cm².',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],

            // Additional TKP Questions (10 soal) - Kerjasama Tim, Pemecahan Masalah Kantor, Teknologi Informasi, Jejaring Kerja
            [
                'pertanyaan' => 'Dalam proyek tim, Anda menemukan rekan kerja tidak menyelesaikan bagiannya tepat waktu. Sikap yang paling tepat adalah...',
                'opsi_a' => 'Melaporkan langsung ke atasan tanpa bicara dulu',
                'opsi_b' => 'Mendekati secara pribadi dan menawarkan bantuan',
                'opsi_c' => 'Mengerjakan bagian rekan tersebut diam-diam',
                'opsi_d' => 'Mengabaikan dan fokus pada bagian sendiri',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Mendekati secara pribadi dan menawarkan bantuan menunjukkan sikap kolaboratif dan empati dalam kerjasama tim.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat sistem komputer kantor mengalami gangguan, tindakan pertama yang sebaiknya dilakukan adalah...',
                'opsi_a' => 'Panik dan mengeluh kepada rekan',
                'opsi_b' => 'Mencoba memperbaiki sendiri tanpa pengetahuan',
                'opsi_c' => 'Melaporkan ke IT support dan mencari cara alternatif',
                'opsi_d' => 'Menunggu sampai sistem normal kembali',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Melaporkan ke IT support dan mencari cara alternatif menunjukkan kemampuan adaptasi dan pemecahan masalah yang baik.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anda diminta untuk mempresentasikan hasil kerja tim kepada klien. Sikap yang profesional adalah...',
                'opsi_a' => 'Mengklaim semua hasil kerja sebagai milik pribadi',
                'opsi_b' => 'Menyebutkan kontribusi setiap anggota tim',
                'opsi_c' => 'Hanya menyebutkan kontribusi atasan saja',
                'opsi_d' => 'Menghindari menyebut kontribusi siapa pun',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menyebutkan kontribusi setiap anggota tim menunjukkan integritas dan penghargaan terhadap kerjasama tim.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat menghadapi konflik antar departemen, sikap mediator yang baik adalah...',
                'opsi_a' => 'Memihak departemen yang lebih kuat',
                'opsi_b' => 'Mendengarkan kedua belah pihak dan mencari solusi win-win',
                'opsi_c' => 'Mengabaikan konflik agar tidak terlibat',
                'opsi_d' => 'Menyerahkan masalah ke atasan tanpa usaha',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Mendengarkan kedua belah pihak dan mencari solusi win-win menunjukkan kemampuan mediasi dan pemecahan masalah.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Anda diminta untuk belajar sistem informasi baru untuk meningkatkan efisiensi kantor. Sikap yang tepat adalah...',
                'opsi_a' => 'Menolak karena sudah nyaman dengan sistem lama',
                'opsi_b' => 'Menerima dengan antusias dan berkomitmen belajar',
                'opsi_c' => 'Mendelegasikan pembelajaran ke rekan lain',
                'opsi_d' => 'Menunda pembelajaran sampai dipaksa',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menerima dengan antusias dan berkomitmen belajar menunjukkan sikap adaptif terhadap teknologi dan inovasi.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Dalam jejaring kerja profesional, sikap yang baik saat menghadiri acara networking adalah...',
                'opsi_a' => 'Fokus hanya pada orang yang bisa memberi keuntungan',
                'opsi_b' => 'Membangun hubungan yang saling menguntungkan',
                'opsi_c' => 'Menghindari berbicara dengan orang baru',
                'opsi_d' => 'Hanya berbicara dengan teman yang sudah dikenal',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Membangun hubungan yang saling menguntungkan menunjukkan kemampuan networking yang profesional dan etis.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat rekan kerja mengalami masalah keluarga yang mempengaruhi kinerja, sikap yang tepat adalah...',
                'opsi_a' => 'Mengeluh kepada atasan tentang kinerja rekan',
                'opsi_b' => 'Menawarkan dukungan dan membantu beban kerja',
                'opsi_c' => 'Mengabaikan dan fokus pada pekerjaan sendiri',
                'opsi_d' => 'Mencatat kelemahan rekan untuk evaluasi',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menawarkan dukungan dan membantu beban kerja menunjukkan empati dan solidaritas dalam kerjasama tim.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anda diminta untuk mengelola proyek dengan teknologi yang belum pernah digunakan tim. Respon yang tepat adalah...',
                'opsi_a' => 'Menolak proyek karena ketidakpastian',
                'opsi_b' => 'Menyusun rencana pembelajaran dan implementasi bertahap',
                'opsi_c' => 'Mendelegasikan sepenuhnya ke ahli teknologi',
                'opsi_d' => 'Menggunakan teknologi lama saja',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menyusun rencana pembelajaran dan implementasi bertahap menunjukkan kemampuan manajemen risiko dan inovasi.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Saat ada kesempatan kolaborasi dengan departemen lain, sikap yang sebaiknya adalah...',
                'opsi_a' => 'Menolak untuk menjaga independensi tim',
                'opsi_b' => 'Menerima dengan antusias dan membangun sinergi',
                'opsi_c' => 'Menerima tapi pasif dalam kontribusi',
                'opsi_d' => 'Menunda hingga dipaksa atasan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menerima dengan antusias dan membangun sinergi menunjukkan kemampuan kolaborasi lintas departemen.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Dalam menggunakan media sosial untuk keperluan kerja, sikap yang profesional adalah...',
                'opsi_a' => 'Menggunakan untuk keluhan pribadi tentang pekerjaan',
                'opsi_b' => 'Memisahkan penggunaan pribadi dan profesional',
                'opsi_c' => 'Menghindari sama sekali penggunaan media sosial',
                'opsi_d' => 'Menggunakan untuk promosi diri berlebihan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Memisahkan penggunaan pribadi dan profesional menunjukkan etika penggunaan teknologi informasi yang baik.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],

            // Additional TWK Questions (20 soal) - Integritas, Bela Negara, Nasionalisme, Pilar Negara
            [
                'pertanyaan' => 'Integritas sebagai nilai dasar ASN berarti...',
                'opsi_a' => 'Mengutamakan kepentingan pribadi',
                'opsi_b' => 'Konsisten dalam bertindak dan berbicara',
                'opsi_c' => 'Mengikuti aturan hanya jika diawasi',
                'opsi_d' => 'Mencari keuntungan dari jabatan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Integritas adalah kesatuan antara pikiran, kata, dan perbuatan yang konsisten dan jujur dalam menjalankan tugas.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Bela negara dalam konteks modern dapat diwujudkan melalui...',
                'opsi_a' => 'Ikut berperang melawan negara lain',
                'opsi_b' => 'Menjaga kedaulatan siber dan digital',
                'opsi_c' => 'Menolak membayar pajak',
                'opsi_d' => 'Mengabaikan aturan negara',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Bela negara modern mencakup menjaga kedaulatan digital, siber, ekonomi, dan budaya, bukan hanya militer.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Nasionalisme yang sehat ditunjukkan dengan...',
                'opsi_a' => 'Menghina bangsa lain',
                'opsi_b' => 'Mencintai produk dalam negeri',
                'opsi_c' => 'Menganggap bangsa sendiri paling superior',
                'opsi_d' => 'Menolak kerjasama internasional',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Nasionalisme sehat adalah mencintai bangsa sendiri sambil menghargai bangsa lain dan terbuka terhadap kerjasama internasional.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Pilar negara Indonesia yang pertama adalah...',
                'opsi_a' => 'Peraturan Perundang-undangan',
                'opsi_b' => 'Gotong Royong',
                'opsi_c' => 'Tata Kelola',
                'opsi_d' => 'Budaya',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Pilar negara Indonesia: Pertama - Peraturan Perundang-undangan, Kedua - Tata Kelola, Ketiga - Gotong Royong, Keempat - Budaya.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Upaya pencegahan radikalisme di kalangan ASN dilakukan dengan...',
                'opsi_a' => 'Membatasi akses informasi',
                'opsi_b' => 'Penguatan moderasi beragama',
                'opsi_c' => 'Pemecatan ASN yang berbeda pandangan',
                'opsi_d' => 'Pembatasan kebebasan berekspresi',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pencegahan radikalisme dilakukan melalui penguatan moderasi beragama, pendidikan kebangsaan, dan dialog terbuka.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'NKRI sebagai negara kesatuan memiliki prinsip...',
                'opsi_a' => 'Federalisme',
                'opsi_b' => 'Unitarisme',
                'opsi_c' => 'Konfederasi',
                'opsi_d' => 'Otonomi penuh daerah',
                'jawaban_benar' => 'B',
                'pembahasan' => 'NKRI menganut sistem unitarisme di mana kedaulatan berada di tangan pusat, bukan federalisme.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Sila ketiga Pancasila "Persatuan Indonesia" mengandung nilai...',
                'opsi_a' => 'Keadilan sosial',
                'opsi_b' => 'Persatuan dan kesatuan',
                'opsi_c' => 'Ketuhanan',
                'opsi_d' => 'Demokrasi',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Sila ketiga menekankan nilai persatuan dan kesatuan bangsa Indonesia yang beragam.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Undang-Undang Dasar 1945 sebagai konstitusi negara berfungsi sebagai...',
                'opsi_a' => 'Dokumen sejarah semata',
                'opsi_b' => 'Sumber hukum tertinggi',
                'opsi_c' => 'Dokumen administrasi',
                'opsi_d' => 'Peraturan biasa',
                'jawaban_benar' => 'B',
                'pembahasan' => 'UUD 1945 adalah sumber hukum tertinggi dan dasar dari seluruh peraturan perundang-undangan di Indonesia.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'MPR sebagai lembaga negara memiliki fungsi...',
                'opsi_a' => 'Eksekutif',
                'opsi_b' => 'Legislatif dan Yudikatif',
                'opsi_c' => 'Perubahan UUD dan pengangkatan Presiden',
                'opsi_d' => 'Pengadilan',
                'jawaban_benar' => 'C',
                'pembahasan' => 'MPR berfungsi mengubah dan menetapkan UUD, melantik Presiden/Wapres, dan memberikan saran kepada Presiden.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Pilar negara "Tata Kelola" mencakup aspek...',
                'opsi_a' => 'Seni dan budaya',
                'opsi_b' => 'Birokrasi dan pemerintahan',
                'opsi_c' => 'Kerjasama komunitas',
                'opsi_d' => 'Tradisi lokal',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pilar Tata Kelola mencakup sistem birokrasi, pemerintahan yang bersih, dan pelayanan publik yang efektif.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anti radikalisme penting bagi ASN karena...',
                'opsi_a' => 'ASN tidak boleh berpendapat',
                'opsi_b' => 'Menjaga netralitas dan stabilitas negara',
                'opsi_c' => 'Semua agama berbahaya',
                'opsi_d' => 'ASN harus loyal pada partai politik',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Anti radikalisme penting untuk menjaga netralitas ASN, stabilitas nasional, dan pelayanan publik yang adil.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Gotong royong sebagai pilar negara tercermin dalam...',
                'opsi_a' => 'Sistem pemerintahan sentralis',
                'opsi_b' => 'Kerjasama antara pemerintah dan masyarakat',
                'opsi_c' => 'Kompetisi individual',
                'opsi_d' => 'Liberalisme ekonomi',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Gotong royong tercermin dalam kolaborasi antara pemerintah, swasta, dan masyarakat dalam pembangunan.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Dalam konteks bela negara, generasi muda berperan dengan...',
                'opsi_a' => 'Menjadi aparat militer saja',
                'opsi_b' => 'Mengembangkan potensi dan kreativitas',
                'opsi_c' => 'Mengabaikan pendidikan',
                'opsi_d' => 'Hanya konsumsi budaya asing',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Generasi muda berperan dalam bela negara melalui pengembangan potensi, kreativitas, dan kontribusi positif.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Nilai-nilai kebangsaan yang perlu dijaga antara lain...',
                'opsi_a' => 'Individualisme ekstrem',
                'opsi_b' => 'Bhineka Tunggal Ika',
                'opsi_c' => 'Egoseentrisme',
                'opsi_d' => 'Elitisme sosial',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Bhineka Tunggal Ika adalah nilai kebangsaan yang menegaskan persatuan dalam keberagaman.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Pilar negara "Budaya" mencakup...',
                'opsi_a' => 'Hukum formal',
                'opsi_b' => 'Karakter dan etika bangsa',
                'opsi_c' => 'Sistem ekonomi',
                'opsi_d' => 'Struktur politik',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pilar Budaya mencakup karakter bangsa, etika, dan nilai-nilai luhur yang menjadi jati diri bangsa.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Integritas ASN dalam pelayanan publik berarti...',
                'opsi_a' => 'Menerima suap untuk mempercepat pelayanan',
                'opsi_b' => 'Melayani tanpa diskriminasi',
                'opsi_c' => 'Mengutamakan keluarga',
                'opsi_d' => 'Meminta imbalan tambahan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Integritas dalam pelayanan publik berarti melayani semua warga secara adil tanpa diskriminasi atau pungutan liar.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Ancaman disintegrasi bangsa dapat berupa...',
                'opsi_a' => 'Persatuan nasional',
                'opsi_b' => 'Radikalisme dan separatisme',
                'opsi_c' => 'Gotong royong',
                'opsi_d' => 'Moderasi beragama',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Ancaman disintegrasi antara lain radikalisme, separatisme, dan konflik SARA yang dapat memecah belah bangsa.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Moderasi beragama berarti...',
                'opsi_a' => 'Menghapus semua agama',
                'opsi_b' => 'Menghargai perbedaan dan mengutamakan harmoni',
                'opsi_c' => 'Memaksakan agama mayoritas',
                'opsi_d' => 'Menghina agama minoritas',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Moderasi beragama adalah sikap menghargai perbedaan, toleransi, dan mengutamakan harmoni antar umat beragama.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'DPR sebagai lembaga legislatif memiliki fungsi utama...',
                'opsi_a' => 'Menjalankan pemerintahan',
                'opsi_b' => 'Membuat undang-undang dan pengawasan',
                'opsi_c' => 'Mengadili perkara',
                'opsi_d' => 'Menjaga keamanan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'DPR berfungsi legislasi, anggaran, dan pengawasan terhadap pemerintah.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Bela negara di era digital dapat dilakukan dengan...',
                'opsi_a' => 'Menyebarkan hoaks',
                'opsi_b' => 'Menangkal konten negatif dan hoaks',
                'opsi_c' => 'Menghapus semua akun media sosial',
                'opsi_d' => 'Membatasi akses internet',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Bela negara di era digital dilakukan dengan menangkal hoaks, konten negatif, dan menyebarkan konten positif.',
                'kategori' => 'TWK',
                'tingkat_kesulitan' => 'sedang'
            ],

            // Additional TIU Questions (20 soal) - Penalaran Analitis, Figural, Soal Cerita Matematika
            [
                'pertanyaan' => 'Sebuah bak penampungan air berbentuk kubus dengan rusuk 2 meter. Volume bak tersebut adalah...',
                'opsi_a' => '4 m³',
                'opsi_b' => '6 m³',
                'opsi_c' => '8 m³',
                'opsi_d' => '10 m³',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Volume kubus = sisi³ = 2³ = 8 m³.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Jika x + y = 15 dan x - y = 5, maka nilai x adalah...',
                'opsi_a' => '5',
                'opsi_b' => '10',
                'opsi_c' => '15',
                'opsi_d' => '20',
                'jawaban_benar' => 'B',
                'pembahasan' => 'x + y = 15 dan x - y = 5. Jumlahkan: 2x = 20, maka x = 10.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Deret angka: 10, 8, 6, 4, 2, ... Angka berikutnya adalah...',
                'opsi_a' => '0',
                'opsi_b' => '-2',
                'opsi_c' => '1',
                'opsi_d' => '-1',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Pola: -2. 10-2=8, 8-2=6, 6-2=4, 4-2=2, 2-2=0.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Sinonim dari kata "Akurat" adalah...',
                'opsi_a' => 'Salah',
                'opsi_b' => 'Tepat',
                'opsi_c' => 'Kabur',
                'opsi_d' => 'Samar',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Akurat berarti tepat, benar, atau tidak meleset.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Antonim dari kata "Cepat" adalah...',
                'opsi_a' => 'Kilat',
                'opsi_b' => 'Lambat',
                'opsi_c' => 'Segera',
                'opsi_d' => 'Tangkas',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Cepat berlawanan dengan lambat.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Sebuah toko memberikan diskon 20% untuk barang seharga Rp 500.000. Harga setelah diskon adalah...',
                'opsi_a' => 'Rp 300.000',
                'opsi_b' => 'Rp 400.000',
                'opsi_c' => 'Rp 450.000',
                'opsi_d' => 'Rp 480.000',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Diskon = 20% × 500.000 = 100.000. Harga setelah diskon = 500.000 - 100.000 = 400.000.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Jika √x = 5, maka nilai x adalah...',
                'opsi_a' => '10',
                'opsi_b' => '15',
                'opsi_c' => '20',
                'opsi_d' => '25',
                'jawaban_benar' => 'D',
                'pembahasan' => '√x = 5, maka x = 5² = 25.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Sebuah truk berjalan dengan kecepatan 60 km/jam selama 2,5 jam. Jarak yang ditempuh adalah...',
                'opsi_a' => '120 km',
                'opsi_b' => '140 km',
                'opsi_c' => '150 km',
                'opsi_d' => '160 km',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Jarak = kecepatan × waktu = 60 × 2,5 = 150 km.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Deret angka: 1, 4, 9, 16, 25, ... Angka berikutnya adalah...',
                'opsi_a' => '30',
                'opsi_b' => '35',
                'opsi_c' => '36',
                'opsi_d' => '49',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Pola: kuadrat bilangan asli. 1²=1, 2²=4, 3²=9, 4²=16, 5²=25, 6²=36.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Silogisme: Semua kucing memiliki ekor. Miko adalah kucing. Kesimpulan...',
                'opsi_a' => 'Miko tidak memiliki ekor',
                'opsi_b' => 'Miko memiliki ekor',
                'opsi_c' => 'Tidak dapat ditarik kesimpulan',
                'opsi_d' => 'Miko bukan kucing',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Dari premis "Semua kucing memiliki ekor" dan "Miko adalah kucing", dapat disimpulkan "Miko memiliki ekor".',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Jika 3x + 7 = 22, maka nilai x adalah...',
                'opsi_a' => '3',
                'opsi_b' => '4',
                'opsi_c' => '5',
                'opsi_d' => '6',
                'jawaban_benar' => 'C',
                'pembahasan' => '3x + 7 = 22, maka 3x = 15, x = 5.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Sebuah segitiga memiliki alas 12 cm dan tinggi 8 cm. Luas segitiga tersebut adalah...',
                'opsi_a' => '40 cm²',
                'opsi_b' => '48 cm²',
                'opsi_c' => '50 cm²',
                'opsi_d' => '96 cm²',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Luas segitiga = ½ × alas × tinggi = ½ × 12 × 8 = 48 cm².',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Deret angka: 2, 6, 18, 54, ... Angka berikutnya adalah...',
                'opsi_a' => '108',
                'opsi_b' => '150',
                'opsi_c' => '162',
                'opsi_d' => '216',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Pola: ×3. 2×3=6, 6×3=18, 18×3=54, 54×3=162.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Jika perbandingan A:B = 2:3 dan B:C = 6:5, maka A:C adalah...',
                'opsi_a' => '2:5',
                'opsi_b' => '4:5',
                'opsi_c' => '6:5',
                'opsi_d' => '12:5',
                'jawaban_benar' => 'B',
                'pembahasan' => 'A:B = 2:3 = 4:6, B:C = 6:5. Maka A:C = 4:5.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Sebuah lingkaran memiliki jari-jari 7 cm. Keliling lingkaran tersebut adalah...',
                'opsi_a' => '22 cm',
                'opsi_b' => '44 cm',
                'opsi_c' => '154 cm',
                'opsi_d' => '308 cm',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Keliling = 2πr = 2 × 22/7 × 7 = 44 cm.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Sinonim dari kata "Abstrak" adalah...',
                'opsi_a' => 'Konkret',
                'opsi_b' => 'Nyata',
                'opsi_c' => 'Tidak berwujud',
                'opsi_d' => 'Fisik',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Abstrak berarti tidak berwujud atau bersifat konsep, lawan dari konkret atau nyata.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Jika 15% dari suatu bilangan adalah 45, maka bilangan tersebut adalah...',
                'opsi_a' => '200',
                'opsi_b' => '250',
                'opsi_c' => '300',
                'opsi_d' => '450',
                'jawaban_benar' => 'C',
                'pembahasan' => '15% × bilangan = 45, maka bilangan = 45 ÷ 0.15 = 300.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Deret angka: 100, 95, 85, 70, 50, ... Angka berikutnya adalah...',
                'opsi_a' => '25',
                'opsi_b' => '30',
                'opsi_c' => '35',
                'opsi_d' => '40',
                'jawaban_benar' => 'A',
                'pembahasan' => 'Pola pengurangan: -5, -10, -15, -20, -25. 50-25=25.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Sebuah balok memiliki panjang 10 cm, lebar 5 cm, dan tinggi 4 cm. Volume balok tersebut adalah...',
                'opsi_a' => '100 cm³',
                'opsi_b' => '150 cm³',
                'opsi_c' => '200 cm³',
                'opsi_d' => '250 cm³',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Volume balok = p × l × t = 10 × 5 × 4 = 200 cm³.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Silogisme: Sebagian mahasiswa bekerja. Semua yang bekerja mendapat gaji. Kesimpulan...',
                'opsi_a' => 'Semua mahasiswa mendapat gaji',
                'opsi_b' => 'Sebagian mahasiswa mendapat gaji',
                'opsi_c' => 'Tidak ada mahasiswa yang mendapat gaji',
                'opsi_d' => 'Tidak dapat ditarik kesimpulan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Dari premis, dapat disimpulkan sebagian mahasiswa mendapat gaji karena sebagian mahasiswa bekerja dan semua yang bekerja mendapat gaji.',
                'kategori' => 'TIU',
                'tingkat_kesulitan' => 'sulit'
            ],

            // Additional TKP Questions (20 soal) - Anti Radikalisme, Pelayanan Publik, Profesionalisme
            [
                'pertanyaan' => 'Saat menerima informasi yang berpotensi menghasut, tindakan yang tepat adalah...',
                'opsi_a' => 'Menyebarkan informasi tersebut',
                'opsi_b' => 'Memverifikasi kebenaran informasi',
                'opsi_c' => 'Mengamuk dan marah',
                'opsi_d' => 'Menghapus semua media sosial',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Memverifikasi kebenaran informasi sebelum menyebarkan adalah sikap anti radikalisme dan cerdas bermedia.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Dalam pelayanan publik, prinsip non-diskriminasi berarti...',
                'opsi_a' => 'Melayani sesuai suku dan agama',
                'opsi_b' => 'Melayani semua warga secara setara',
                'opsi_c' => 'Melayani yang punya uang lebih dulu',
                'opsi_d' => 'Melayani kenalan lebih dulu',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Prinsip non-diskriminasi dalam pelayanan publik berarti melayani semua warga secara setara tanpa membedakan SARA.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Profesionalisme ASN ditunjukkan dengan...',
                'opsi_a' => 'Datang terlambat ke kantor',
                'opsi_b' => 'Menyelesaikan tugas dengan tepat waktu',
                'opsi_c' => 'Menggunakan fasilitas kantor untuk pribadi',
                'opsi_d' => 'Mengeluh tentang pekerjaan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Profesionalisme ditunjukkan dengan menyelesaikan tugas dengan tepat waktu, berkualitas, dan bertanggung jawab.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Saat menemukan rekan kerja yang terpapar paham radikal, sikap yang tepat adalah...',
                'opsi_a' => 'Mengucilkan rekan tersebut',
                'opsi_b' => 'Melaporkan dan memberikan pendampingan',
                'opsi_c' => 'Ikut bergabung dengan paham tersebut',
                'opsi_d' => 'Menyebar kabar buruk tentang rekan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Melaporkan dan memberikan pendampingan adalah sikap yang tepat untuk deradikalisasi dengan pendekatan humanis.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Pelayanan publik yang prima ditandai dengan...',
                'opsi_a' => 'Proses yang lambat dan berbelit',
                'opsi_b' => 'Proses yang cepat, mudah, dan transparan',
                'opsi_c' => 'Syarat yang rumit dan tidak jelas',
                'opsi_d' => 'Biaya tambahan yang tidak jelas',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pelayanan publik prima ditandai dengan proses cepat, mudah, transparan, dan biaya yang jelas.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Integritas profesional berarti...',
                'opsi_a' => 'Menerima suap',
                'opsi_b' => 'Menolak gratifikasi dan korupsi',
                'opsi_c' => 'Menggunakan jabatan untuk keuntungan pribadi',
                'opsi_d' => 'Mengabaikan aturan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Integritas profesional berarti menolak gratifikasi, korupsi, dan menjunjung tinggi etika kerja.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat menghadapi warga yang mengeluh pelayanan, sikap ASN yang benar adalah...',
                'opsi_a' => 'Membela diri dan menyalahkan warga',
                'opsi_b' => 'Mendengarkan dan mencari solusi',
                'opsi_c' => 'Mengabaikan keluhan',
                'opsi_d' => 'Memarahi warga',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Mendengarkan keluhan dengan empati dan mencari solusi adalah sikap pelayanan publik yang baik.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Anti radikalisme dalam lingkungan kerja dapat dilakukan dengan...',
                'opsi_a' => 'Membatasi kebebasan berpendapat',
                'opsi_b' => 'Penguatan pemahaman kebangsaan',
                'opsi_c' => 'Menghapus semua kegiatan keagamaan',
                'opsi_d' => 'Memata-matai rekan kerja',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Anti radikalisme dilakukan dengan penguatan pemahaman kebangsaan, moderasi beragama, dan dialog terbuka.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Kompetensi teknis ASN penting untuk...',
                'opsi_a' => 'Menunjukkan kehebatan',
                'opsi_b' => 'Memberikan pelayanan berkualitas',
                'opsi_c' => 'Mendapatkan promosi saja',
                'opsi_d' => 'Menghambat rekan kerja',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Kompetensi teknis penting untuk memberikan pelayanan berkualitas kepada masyarakat.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'mudah'
            ],
            [
                'pertanyaan' => 'Saat ada perbedaan pendapat dalam tim, sikap profesional adalah...',
                'opsi_a' => 'Meninggalkan tim',
                'opsi_b' => 'Diskusi terbuka dan menghargai perbedaan',
                'opsi_c' => 'Memaksakan pendapat sendiri',
                'opsi_d' => 'Menyerang pribadi rekan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Diskusi terbuka dan menghargai perbedaan pendapat adalah sikap profesional dalam kerja tim.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Pencegahan korupsi dapat dilakukan dengan...',
                'opsi_a' => 'Menerima gratifikasi kecil',
                'opsi_b' => 'Menolak semua bentuk gratifikasi',
                'opsi_c' => 'Menyembunyikan tindakan korupsi',
                'opsi_d' => 'Menganggap korupsi hal yang biasa',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pencegahan korupsi dilakukan dengan menolak semua bentuk gratifikasi dan menjunjung integritas.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Pelayanan publik berbasis teknologi bertujuan untuk...',
                'opsi_a' => 'Mempermudah korupsi',
                'opsi_b' => 'Meningkatkan efisiensi dan transparansi',
                'opsi_c' => 'Memperumit proses',
                'opsi_d' => 'Mengurangi interaksi manusia',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pelayanan publik berbasis teknologi bertujuan meningkatkan efisiensi, transparansi, dan kemudahan akses.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat mendapat tugas di luar kompetensi, sikap profesional adalah...',
                'opsi_a' => 'Menolak tanpa alasan',
                'opsi_b' => 'Belajar dan meminta bimbingan',
                'opsi_c' => 'Mengerjakan asal-asalan',
                'opsi_d' => 'Mendelegasikan tanpa tanggung jawab',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Belajar dan meminta bimbingan adalah sikap profesional untuk mengembangkan kompetensi.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Moderasi dalam pelayanan publik berarti...',
                'opsi_a' => 'Memaksakan agama tertentu',
                'opsi_b' => 'Menghormati keberagaman warga',
                'opsi_c' => 'Mengabaikan kebutuhan warga',
                'opsi_d' => 'Diskriminatif dalam pelayanan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Moderasi dalam pelayanan publik berarti menghormati keberagaman warga dan melayani tanpa diskriminasi.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Etika profesional ASN melarang...',
                'opsi_a' => 'Kerja keras',
                'opsi_b' => 'Abuse of power',
                'opsi_c' => 'Inovasi',
                'opsi_d' => 'Kolaborasi',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Etika profesional melarang penyalahgunaan kekuasaan (abuse of power) untuk kepentingan pribadi.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat warga meminta bantuan di luar kewenangan, sikap yang tepat adalah...',
                'opsi_a' => 'Mengabaikan permintaan',
                'opsi_b' => 'Menjelaskan kewenangan dan mengarahkan ke instansi yang tepat',
                'opsi_c' => 'Mengiyakan tanpa kemampuan',
                'opsi_d' => 'Meminta uang untuk bantuan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menjelaskan kewenangan dan mengarahkan ke instansi yang tepat adalah sikap profesional dan transparan.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Pengembangan kompetensi ASN penting untuk...',
                'opsi_a' => 'Hanya formalitas',
                'opsi_b' => 'Meningkatkan kualitas pelayanan',
                'opsi_c' => 'Menghabiskan anggaran',
                'opsi_d' => 'Mencari kesibukan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Pengembangan kompetensi penting untuk meningkatkan kualitas pelayanan publik.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat ada tekanan untuk melakukan korupsi, sikap yang benar adalah...',
                'opsi_a' => 'Mengikuti tekanan',
                'opsi_b' => 'Menolak dan melaporkan',
                'opsi_c' => 'Diam saja',
                'opsi_d' => 'Menyembunyikan tindakan',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Menolak dan melaporkan tekanan korupsi adalah sikap integritas dan profesional.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Inovasi dalam pelayanan publik bertujuan untuk...',
                'opsi_a' => 'Membuat proses lebih rumit',
                'opsi_b' => 'Mempermudah dan meningkatkan kualitas',
                'opsi_c' => 'Mengurangi kualitas',
                'opsi_d' => 'Menghabiskan anggaran',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Inovasi dalam pelayanan publik bertujuan mempermudah proses dan meningkatkan kualitas pelayanan.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ],
            [
                'pertanyaan' => 'Saat rekan kerja melakukan pelanggaran etika, sikap yang tepat adalah...',
                'opsi_a' => 'Ikut serta dalam pelanggaran',
                'opsi_b' => 'Mengingatkan dan melaporkan jika perlu',
                'opsi_c' => 'Diam dan membiarkan',
                'opsi_d' => 'Menyebar gosip',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Mengingatkan dan melaporkan pelanggaran etika adalah sikap profesional dan menjunjung integritas.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sulit'
            ],
            [
                'pertanyaan' => 'Komitmen terhadap pelayanan publik ditunjukkan dengan...',
                'opsi_a' => 'Mengeluh tentang warga',
                'opsi_b' => 'Melayani dengan hati dan tanggung jawab',
                'opsi_c' => 'Menyelesaikan tugas asal-asalan',
                'opsi_d' => 'Menghindari interaksi dengan warga',
                'jawaban_benar' => 'B',
                'pembahasan' => 'Komitmen pelayanan publik ditunjukkan dengan melayani dengan hati, tanggung jawab, dan profesional.',
                'kategori' => 'TKP',
                'tingkat_kesulitan' => 'sedang'
            ]
        ];

        // Insert soals ke database
        foreach ($bank_soal as $soal) {
            $tingkat = $soal['tingkat_kesulitan'];
            
            // Konversi tingkat kesulitan ke difficulty
            $difficulty = 1; // mudah
            if ($tingkat === 'sedang') $difficulty = 2;
            if ($tingkat === 'sulit') $difficulty = 3;
            
            Soal::create([
                'pertanyaan' => $soal['pertanyaan'],
                'opsi_a' => $soal['opsi_a'],
                'opsi_b' => $soal['opsi_b'],
                'opsi_c' => $soal['opsi_c'],
                'opsi_d' => $soal['opsi_d'],
                'jawaban_benar' => $soal['jawaban_benar'],
                'pembahasan' => $soal['pembahasan'],
                'kategori' => $soal['kategori'],
                'difficulty_level' => $tingkat,
                'difficulty' => $difficulty,
                'discrimination_index' => rand(1, 8) / 10,
                'difficulty_index' => rand(1, 8) / 10,
                'attempts_count' => 0,
                'correct_count' => 0,
                'last_attempted_at' => null,
                'performance_history' => json_encode([]),
            ]);
        }

        $this->command->info('Bank soal CPNS berhasil dibuat!');
        $this->command->info('Total: ' . count($bank_soal) . ' soal');
    }
}
