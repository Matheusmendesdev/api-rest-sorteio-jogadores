<?php

namespace App\DTOs;

class JogadorCreateDTO
{
    public function __construct(
        readonly public string $nome,
        readonly public int $nivel,
        readonly public bool $goleiro,
        readonly public bool $presenca,
    ) {
    }
}