<?php

namespace App\Http\Controllers;

use App\Models\Bloqueados;
use App\Models\Comic;
use App\Models\Serie;
use App\Models\TbComic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function alterEncryptPass()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->password = Hash::make($user->password);
            $user->save();
        }
    }

    public function alterSeries()
    {
        $hqs = TbComic::all();
        foreach ($hqs as $hq) {
            dd($hq);
        }
    }



}
