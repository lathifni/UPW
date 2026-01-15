<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    private function getEducationData()
    {
        return [
            [
                'slug' => 'cara-wakaf-uang',
                'title' => 'Tata Cara Berwakaf Uang',
                'image' => 'edu-5.jpg',
                'date' => '1 Januari 2026',
                'excerpt' => 'Panduan praktis langkah demi langkah melakukan wakaf uang...',
                'sumber' => '',
                'penulis' => '',
                'view_file' => 'public.education.contents.cara-wakaf-uang'
            ],
            [
                'slug' => 'kisah-abu-thalhah',
                'title' => 'Kisah Inspirasi Wakaf Abu Thalhah Wakaf Kebun Bairahu Abu',
                'image' => 'edu-3.jpg',
                'date' => '22 November 2021',
                'excerpt' => 'Kisah sahabat Nabi yang mewakafkan kebun kurma kesayangannya...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/kisah-inspirasi-abu-thalhah-wakaf-kebun-bairahu-abu/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.kisah-abu-thalhah'
            ],
            [
                'slug' => 'pengertian-wakaf',
                'title' => 'Pengertian Wakaf',
                'image' => 'edu-1.jpg', // Pastikan gambar ada di public/img/edu/
                'date' => '16 Juni 2021',
                'excerpt' => 'Kata “Wakaf” atau”Wact” berasal dari bahasa Arab “Waqafa”...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/pengertian-wakaf/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.pengertian-wakaf' 
            ],
            [
                'slug' => 'perbedaan-wakaf-uang-wakaf-melalui-uang',
                'title' => 'Perbedaan Wakaf Uang Wakaf Melalui Uang',
                'image' => 'edu-1.jpg', // Pastikan gambar ada di public/img/edu/
                'date' => '16 Juni 2021',
                'excerpt' => 'Wakaf uang adalah perbuatan hukum wakif untuk memisahkan dan/atau...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/perbedaan-wakaf-uang-dan-wakaf-melalui-uang/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.perbedaan-wakaf-uang-wakaf-melalui-uang' 
            ],
            [
                'slug' => 'perbedaan',
                'title' => 'Perbedaan Wakaf Zakat Infak dan Sedekah',
                'image' => 'edu-1.jpg', // Pastikan gambar ada di public/img/edu/
                'date' => '16 Juni 2021',
                'excerpt' => 'Wakaf uang adalah perbuatan hukum wakif untuk memisahkan dan/atau...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/perbedaan-wakaf-zakat-infak-dan-sedekah/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.perbedaan' 
            ],
            [
                'slug' => 'perkembangan-wakaf',
                'title' => 'Perkembangan Wakaf',
                'image' => 'edu-1.jpg', // Pastikan gambar ada di public/img/edu/
                'date' => '16 Juni 2021',
                'excerpt' => 'Wakaf uang adalah perbuatan hukum wakif untuk memisahkan dan/atau...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/sejarah-perkembangan-wakaf/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.perkembangan-wakaf' 
            ],
            [
                'slug' => 'sejarah-awal-mula-wakaf',
                'title' => 'Sejarah Awal Mula Wakaf',
                'image' => 'edu-2.jpg',
                'date' => '16 Juni 2021',
                'excerpt' => 'Dalam sejarah Islam, wakaf dikenal sejak masa Rasulullah SAW karena wakaf disyariatkan...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/sejarah-awal-mula-wakaf/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.sejarah-awal-mula-wakaf'
            ],
            [
                'slug' => 'wakaf-produktif',
                'title' => 'Wakaf Produktif di Zaman Rasulullah SAW dan Para Sahabat',
                'image' => 'edu-2.jpg',
                'date' => '16 Juni 2021',
                'excerpt' => 'Dalam sejarah Islam, wakaf dikenal sejak masa Rasulullah SAW karena wakaf disyariatkan...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/wakaf-produktif-di-zaman-rasulullah-saw-para-sahabat/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.wakaf-produktif'
            ],
            [
                'slug' => 'wakaf-sumur',
                'title' => 'Wakaf Sumur Sahabat Utsman bin Affan',
                'image' => 'edu-2.jpg',
                'date' => '16 Juni 2021',
                'excerpt' => 'Dalam sejarah Islam, wakaf dikenal sejak masa Rasulullah SAW karena wakaf disyariatkan...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/wakaf-sumur-sahabat-utsman-bin-affan/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.wakaf-sumur'
            ],
            [                
                'slug' => 'wakaf-uang-di-indonesia',
                'title' => 'Wakaf Uang di Indonesia',
                'image' => 'edu-2.jpg',
                'date' => '16 Juni 2021',
                'excerpt' => 'Dalam sejarah Islam, wakaf dikenal sejak masa Rasulullah SAW karena wakaf disyariatkan...',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/wakaf-uang-di-indonesia/?seq_no=2',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.wakaf-uang-di-indonesia'
            ],
            [
                'slug' => 'wakaf-uang',
                'title' => 'Apa Itu Wakaf Uang',
                'image' => 'edu-4.jpg',
                'date' => '25 Juni 2019',
                'excerpt' => 'Apa itu wakaf uang dan bagaimana hukumnya dalam Islam?',
                'sumber' => 'https://www.bwi.go.id/literasiwakaf/apa-itu-wakaf-uang/',
                'penulis' => 'BWI',
                'view_file' => 'public.education.contents.wakaf-uang'
            ],
        ];
    }

    // Halaman Index (Daftar Semua Artikel)
    public function index()
    {
        // Mengubah array menjadi Collection agar mudah diolah di Blade
        $posts = collect($this->getEducationData())->map(function($item) {
            return (object) $item;
        });
        
        // Saya lihat kamu punya file 'edukasi-wakaf.blade.php', kita pakai itu sebagai index
        return view('public.edukasi-wakaf', compact('posts')); 
    }

    // Halaman Detail (Baca Satu Artikel)
    public function show($slug)
    {
        $post = collect($this->getEducationData())->firstWhere('slug', $slug);

        if (!$post) {
            abort(404);
        }

        $post = (object) $post;
        
        // Kita butuh file baru namanya 'show.blade.php' atau 'detail.blade.php'
        return view('public.education.show', compact('post'));
    }
}
