<?php

namespace App\Services\Api;

use App\Enums\UserRoleEnum;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\BaseService;
use App\Utils\Helper;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    public function __construct(private User $user)
    {
    }

    public function register(array $data): array
    {
        try {
            $data['password'] = bcrypt($data['password']);
            $data['role'] = UserRoleEnum::USER->value;

            $user = $this->user->create($data);

            // * if you need to login the user immediately after registration
            //  $user->token = $user->createToken($user->id);

            return $this->success('Registration successful', $user);

        } catch (\Exception $th) {
            Helper::errorLogger($th);
            return $this->error('An error occured, please try again', 500); //* You have control over the error message here
        }
    }

    public function login(array $data): array
    {
        $user = $this->user->where('email', $data['email'])->first();

        if (! $user) {
            return $this->error('Invalid login credential', [], 401);
        }

        if (! Hash::check($data['password'], $user->password)) {
            return $this->error('Invalid login credential', [], 401);
        }

        $user->token = $user->createToken($user->email)->plainTextToken;

        return $this->success('Your are logged in', new UserResource($user));
    }
}
