<?php
namespace App\Managers;

use \App\Models\User as UserModel;
use Carbon\Carbon;

class User
{


    public function __construct(UserModel $user)
    {
        $this->user = $user;
        $this->profile = $this->setProfile();
    }

    public function getProfile()
    {

        return $this->profile;
    }

    private function setProfile()
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'nickname' => $this->user->nickname,
            'email' => $this->user->email,
            'days_left' => Carbon::now()->diffInDays(Carbon::parse($this->user->license_end)),
            'license_end' => Carbon::parse($this->user->license_end)->format('d/m/Y')
        ];
    }
}
