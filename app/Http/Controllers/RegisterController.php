<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    private array $users = [
        [
            'id' => 1,
            'name' => 'gmail1',
            'email' => 'gmail@gmail.com',
            'password' => '112112121'
        ],
        [
            'id' => 2,
            'name' => 'gmail2',
            'email' => 'gmail@gmail.com',
            'password' => '112112121'
        ],
        [
            'id' => 3,
            'name' => 'gmail3',
            'email' => 'gmail@gmail.com',
            'password' => '112112121'
        ],
        [
            'id' => 4,
            'name' => 'gmail4',
            'email' => 'gmail@gmail.com',
            'password' => '112112121'
        ]

    ];
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        if($this->checkUserEmail($data['email'])) {
            return response()->json(['status' => 'error', 'message' => 'User already exist']);
        }

        $data['id'] = $this->users[count($this->users) - 1]['id'] + 1;

        $data['pass'] = bcrypt($data['pass']);

        $this->users[] = $data;

        return response()->json(['status' => 'success', 'message' => 'Registration success', 'users' => $data]);
    }

    public function checkUserEmail($email) {
        foreach ($this->users as $user) {
            if($user['email'] === $email)  {
                Log::alert('User already exist - '. $email);
                return true;
            }
        }
        return false;
    }


}
