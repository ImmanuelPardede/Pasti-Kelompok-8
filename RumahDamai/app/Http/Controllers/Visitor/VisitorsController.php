<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Anak;
use App\Models\AnakDisabilitas;
use App\Models\AnakNonDisabilitas;
use App\Models\Berita;
use App\Models\CarouselItem;
use App\Models\DetailGaleri;
use App\Models\DetailProgram;
use App\Models\Fasilitas;
use App\Models\FoundationHistory;
use App\Models\Galeri;
use App\Models\KategoriBerita;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class VisitorsController extends Controller
{
    public function home()
    {
        $response = Http::get("http://localhost:9001/api/carousel");
        $carousel = $response->json();

        $response = Http::get('http://localhost:9002/api/history');
        $history = $response->json();

        $response = Http::get("http://localhost:9003/api/category");
        $category = $response->json();
        
        $response = Http::get("http://localhost:9004/api/news");
        $berita = $response->json();


        $totalProgram = DetailProgram::count();
        $kategori = KategoriBerita::all();
        $anaktepi = AnakDisabilitas::count();
        $anakdisabilitas = AnakNonDisabilitas::count();
        return view('visitor.home', compact('carousel','history','berita','totalProgram','category','anaktepi','anakdisabilitas'));

    }

    public function aboutUs()
    {
        $abouts = About::all();
        return view('visitor.about', compact('abouts'));
    }

    public function programrm()
    {
        $programs = Program::all();
        $detailPrograms = DetailProgram::all();
        $totalProgram = DetailProgram::count();
        return view('visitor.program', compact('programs','detailPrograms','totalProgram'));
    }

    public function fasilitasi()
    {
        $fasilitas = Fasilitas::all();
        $detailfasilitas = Fasilitas::all();
        return view('visitor.fasilitas',compact('fasilitas','detailfasilitas'));
    }

    public function news()
    {
        $response = Http::get("http://localhost:9003/api/category");
        $category = $response->json();

        $response = Http::get("http://localhost:9004/api/news");
        $berita = $response->json();

        return view('visitor.berita', compact('berita','category'));
    }

    public function show($id)
    {

        $response = Http::get("http://localhost:9003/api/category");
        $category = $response->json();

        $response = Http::get("http://localhost:9004/api/news/{$id}");
        $berita = $response->json();
        
        $response = Http::get("http://localhost:9004/api/news");
        $recentNews = $response->json();

        // Mengirim data berita dan recent news ke halaman detail berita
        return view('visitor.detailberita', compact('berita', 'recentNews','category'));
    }


    public function gallery()
    {
        $galeri = Galeri::all();
        $detailgaleriCounts = DetailGaleri::groupBy('galeri_id')->pluck(DB::raw('count(*) as total'), 'galeri_id');
        return view('visitor.galeri', compact('galeri','detailgaleriCounts'));
    }

    public function detailgallery($id)
    {
        $galeri = Galeri::find($id);
        $detailgaleriCounts = DetailGaleri::groupBy('galeri_id')->pluck(DB::raw('count(*) as total'), 'galeri_id');
        return view('visitor.detailgaleri', compact('galeri','detailgaleriCounts'));
    }




    public function contact()
    {
        return view('visitor.contact');
    }
}
