<?php


namespace App\Http\Controllers\Api;


use App\Models\Comic;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ComicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function homePage()
    {
        $comics = Comic::with('type', 'traductions')->get();
        $highlights = $comics->sortByDesc('rating')->take(10);
        $mostViews = $comics->sortByDesc('views')->take(10);
        $news = $comics->sortBy('cretead_at')->take(10);
        return response()->json([
            'novidades' => $news,
            'maisVistos' => $mostViews,
            'melhoresRankings' => $highlights
        ]);
    }

    public function get($id)
    {
        $comic = Comic::find($id);
        $path = $comic->path;

        $traductions = $comic->traductions;
        $pages = [];
        foreach ($traductions as $traduction) {
            $traduction_pages = [];
            $files = File::files(public_path(Storage::url($path . '/' . $traduction->language)));
            foreach ($files as $page) {
                $traduction_pages[] = $page->getFilename();
            }
            $pages[$traduction->language] = $traduction_pages;
        }
        return response()->json(['comic' => $comic, 'pages' => $pages]);
    }

    private function getCapa($comics)
    {
        foreach ($comics as $comic) {
            $capa = File::files(storage_path('app/public/'.$comic->path.'pt_br'));

            dd($capa);

        }
    }

    private function clean($string)
    {

        $sub = ["!", "'", "@", "#", "$", "%", "¨", "&", "*", "(", ")", "-", "_", "=", "+", ".", ",", "?", "/", " "];
        $string = str_replace($sub, "", $string);

        $map = array(
            'á' => 'a',
            'à' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'é' => 'e',
            'ê' => 'e',
            'í' => 'i',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ú' => 'u',
            'ü' => 'u',
            'ç' => 'c',
            'Á' => 'A',
            'À' => 'A',
            'Ã' => 'A',
            'Â' => 'A',
            'É' => 'E',
            'Ê' => 'E',
            'Í' => 'I',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ú' => 'U',
            'Ü' => 'U',
            'Ç' => 'C'
        );

        return strtr($string, $map); // funciona corretamente
    }
}
