<?php
declare(strict_types=1);

namespace App\Actions;

use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Str;
use App\DataTransferObjects\RegisterUserDTO;

class RegisterUserAction
{
    public function execute(RegisterUserDTO $dto): Link
    {
        $user = User::create([
                'name'          => $dto->name,
                'phone_number'  => $dto->phone_number
            ]);

        return Link::create([
            'user_id'    => $user->id,
            'token'      => Str::uuid(),
            'expires_at' => now()->addDays(7),
        ]);
    }
}
