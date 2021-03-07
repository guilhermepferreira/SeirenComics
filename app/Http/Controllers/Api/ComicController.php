<?php


namespace App\Http\Controllers\Api;


use App\Models\Comic;
use App\Models\Serie;
use App\Models\ComentariosHq;
use App\Models\User;
use App\Models\ComicType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;
use function PHPUnit\Framework\isEmpty;

class ComicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function homePage()
    {
        $comics = Comic::with('type', 'traductions')->get()->sortBy('id');
        $comics = $this->getCapa($comics->sortBy('id')->take($comics->count()));
        $highlights = $comics->sortByDesc('rating')->take(10);
        $mostViews = $comics->sortByDesc('views')->take(10);
        $news = $comics->sortBy('cretead_at')->take(10);
        return response()->json([
            'novidades' => $news,
            'maisVistos' => $mostViews,
            'melhoresRankings' => $highlights,
            'todos' => $comics
        ]);
    }

    public function calendar()
    {
        $comics = Comic::where('status', 2)->get();
        $comics = $this->getCapa($comics->sortBy('id')->take($comics->count()));
        return response()->json(['calendario' => $comics]);
    }

    public function getAll()
    {
        $comics = QueryBuilder::for(Comic::class)
            ->allowedFilters([
                'id', 'old_id', 'title', 'subtitle', 'edition', 'arch', 'total_arch', 'rating',
                'type.name', 'type.short_name'
            ])
            ->allowedIncludes(['type'])
            ->paginate();

        return response()->json($comics);
    }

    public function get($id)
    {
        $comic = Comic::find($id);
        $path = $comic->path;

        $traductions = File::directories(storage_path('app/public/' . $path));

        $pages = [];
        foreach ($traductions as $traduction) {
            $pastas = explode("/", $traduction);
            $leanguage = end($pastas);
            $traduction_pages = [];
            $files = File::files(storage_path('app/public/' . $path . $leanguage));
            foreach ($files as $page) {
                $traduction_pages[] = asset(Storage::url($path . $leanguage . '/' . $page->getFilename()));
            }
            $pages[$leanguage] = $traduction_pages;
        }
        return response()->json(['comic' => $comic, 'pages' => $pages]);
    }

    public function createComic(Request $request)
    {
        $files = $request->file('files');
        $data = $request->all();
        if (count($files) < 1) {
            return response()->json(['status' => 'Error', 'message' => 'files não enviado']);
        }

        if (!isset($data['title'])) {
            return response()->json(['status' => 'Error', 'message' => 'title não enviado']);
        }

        if (!isset($data['edition'])) {
            return response()->json(['status' => 'Error', 'message' => 'edition não enviado']);
        }

        if (!isset($data['arch'])) {
            return response()->json(['status' => 'Error', 'message' => 'arch não enviado']);
        }

        if (!isset($data['total_arch'])) {
            return response()->json(['status' => 'Error', 'message' => 'total_arch não enviado']);
        }

        if (!isset($data['launch_date'])) {
            return response()->json(['status' => 'Error', 'message' => 'launch_date não enviado']);
        }

        if (!isset($data['language'])) {
            return response()->json(['status' => 'Error', 'message' => 'language não enviado']);
        }

        $comic = $this->saveComic($data);
        $path_name = $this->clean($comic->title);
        $path = 'comics/' . $path_name . '_' . $comic->edition . '_' . $comic->arch . '/';
        $comic->path = $path;
        $comic->save();

        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('public/' . $path . $data['language'] . '/', $name);
        }

        return response()->json(['status' => 'Success', 'message' => 'Comic adicionada com sucesso']);
    }


    private function getCapa($comics)
    {

        foreach ($comics as $comic) {

            if (!File::exists(storage_path('app/public/' . $comic->path . 'pt_br'))) {
                $comic->capa = null;
                continue;
            }
            $capa = File::files(storage_path('app/public/' . $comic->path . 'pt_br'));

            $comic->capa = asset(Storage::url($comic->path . 'pt_br/' . $capa[0]->getFilename()));
        }
        return $comics;
    }

    private function saveComic($data)
    {
        return Comic::create([
            'title' => $data['title'],
            'subtitle' => $data['subtitle'],
            'edition' => $data['edition'],
            'arch' => $data['arch'],
            'total_arch' => $data['total_arch'],
            'draftsman' => $data['draftsman'],
            'colorist' => $data['colorist'],
            'reviewer' => $data['reviewer'],
            'serie_id' => $data['serie_id'],
            'status' => $data['status'],
            'changer' => $data['changer'],
            'comments' => $data['comments'],
            'pages' => $data['pages'],
            'comic_type_id' => $data['comic_type_id'],
            'launch_date' => $data['launch_date'],
        ]);

    }

    public function addSerie()
    {

        $series = Serie::all();
        foreach ($series as $serie) {

            $comics = Comic::where('comments', 'like', '%' . $serie->name . '%')->get();

            if ($comics->isEmpty()) {
                continue;
            }
            foreach ($comics as $comic) {
                $comic->serie_id = $serie->id;
                $comic->save();
                $comic->fresh();
            }

        }

    }

    public function comentarios()
    {
        $comentarios = ComentariosHq::all();
        foreach ($comentarios as $comentario) {

            if (empty($comentario->id_historia) or $comentario->id_historia < 1) {
                continue;
            }

            $user = User::where('email', $comentario->email_comentarios)->first();
            echo 'User';
            echo '<br>';
            echo $user;
            echo '<br>';


            ComentariosHq::where('id', $comentario->id)->update([
                'comic_id' => $comentario->id_historia,
                'user_id' => $user == null ? null : $user->id
            ]);
        }
        return "acabou";
    }

    public function getTypes()
    {
        return ComicType::all();
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
