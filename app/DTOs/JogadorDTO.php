<?php

namespace App\DTOs;

class JogadorDTO
{
    public function __construct(
        readonly public string $id,
        readonly public string $nome, 
        readonly public int $nivel, 
        readonly public bool $goleiro,
        readonly public bool $presenca,
    )
    {}
}