<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use \App\Managers\User as UserManager;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //TODO: DPS NOS FAZ
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email:rfc,dns|unique:users',
            'password' => 'required|min:6|max:12',
            'age_verification' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()], 422);
        }

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $token = Auth::login($user);
        $profile = new UserManager($user);

        return response()->json(['user' => $profile->getProfile(), 'access_token' => $token], 200);

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $profile = new UserManager(Auth::user());
        return response()->json(['user' => $profile->getProfile()], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);

        if (!empty($data['name']))
            $user->name = $data['name'];

        if (!empty($data['email']))
            $user->email = $data['email'];

        if (!empty($data['password']))
            $user->password = Hash::make($data['password']);

        if (!empty($data['nickname']))
            $user->nickname = $data['nickname'];

        $user->save();
        $user->fresh();

        $profile = new UserManager($user);

        return response()->json(['user' => $profile->getProfile()], 200);
    }

    public function getAll()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                'id', 'email', 'status', 'is_active', 'stripe_id', 'nickname', 'license_start', 'license_end',
                'type.type_name', 'type.short_name'
            ])
            ->allowedIncludes(['type'])
            ->paginate();

        return response()->json($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->is_active = 0;

        $user->save();

        $user->fresh();

        return response()->json(['message' => 'User has been disabled'], 200);
    }

    public function getAvatars()
    {
        $files = File::files(storage_path('app/public/avatars'));
        $avatars= [];
        foreach ($files as $avatar) {
            $avatars[] =  asset(Storage::url('app/public/avatars/' . $avatar->getFilename()));
        }
        return $avatars;
    }

    public function setAvatars(Request $request)
    {
        $data = $request->all();
        $user = User::find(Auth::id());
        $user->avatar_file = $data['avatar'];
        $user->save();

        return response()->json(['message' => 'Avatar adicionado com sucesso.'], 200);
    }
}
