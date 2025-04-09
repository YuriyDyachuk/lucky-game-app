<?php
declare(strict_types=1);

namespace App\DataTransferObjects;

class RegisterUserDTO {
    public function __construct(
        public string $name,
        public string $phone_number
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            (string) $request->input('name'),
            (string) $request->input('phone_number')
        );
    }
}
