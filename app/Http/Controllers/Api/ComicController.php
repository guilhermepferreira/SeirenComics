<?php


namespace App\Http\Controllers\Api;


use App\Models\Comic;
use Illuminate\Routing\Controller as BaseController;

class ComicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function homePage()
    {
        $comics = Comic::with('type')->get();
        $highlights = $comics->sortByDesc('rating')->take(10);
        return response()->json($highlights);
    }
}
