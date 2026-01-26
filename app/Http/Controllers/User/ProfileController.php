<?php

namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;

class ProfileController
{
    public function showProfile()
    {
        $musics = json_decode(
            file_get_contents(resource_path('data/musics.json')),
            true
        );

        return view('user/profile', compact('musics'));

    }

}
