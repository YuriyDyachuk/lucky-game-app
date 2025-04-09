<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\RegisterUserAction;
use App\Http\Requests\RegisterRequest;
use App\DataTransferObjects\RegisterUserDTO;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request, RegisterUserAction $action): \Illuminate\Http\RedirectResponse
    {
        $dto = RegisterUserDTO::fromRequest($request);
        $link = $action->execute($dto);

        return redirect()->route('link.page', $link->token);
    }
}
