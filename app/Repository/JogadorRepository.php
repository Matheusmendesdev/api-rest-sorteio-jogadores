<?php

namespace App\Repository;
use App\DTOs\JogadorDTO;
use App\Models\Jogadores;
use Illuminate\Pagination\LengthAwarePaginator;

class JogadorRepository
{
    public function __construct(protected Jogadores $jogadores){}

    public function getAll(int $total_per_page = 15, int $page = 1, string $filter = ""): LengthAwarePaginator
    {
        return $this->jogadores->where(function ($query) use ($filter){
            if($filter != ""){
                $query->where('nome', 'LIKE', "%{$filter}%");
            }
        })->paginate($total_per_page, ['*'], 'page', $page);
    }


    public function create(JogadorDTO $jogadorDTO): Jogadores
    {
        return Jogadores::create((array) $jogadorDTO);
    }

    public function findById(string $id)
    {
        return Jogadores::find($id);
    }

    public function update(JogadorDTO $jogadorDTO): bool
    {
        if (!$user = $this->findById($jogadorDTO->id)) {
            return false;
        }
        
        $data = (array) $jogadorDTO;
        return $user->update($data);
    }

    public function delete(string $id): bool 
    {
        if (!$user = $this->findById($id)) {
            return false;
        }
        
        return $user->delete($id);
    }

}