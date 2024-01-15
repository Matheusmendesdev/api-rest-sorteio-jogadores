<?php

namespace App\Http\Controllers;

use App\DTOs\JogadorDTO;
use App\Http\Requests\ValidaDadosJogador;
use App\Http\Resources\JogadorResource;
use App\Repository\JogadorRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JogadorController extends Controller
{
    public function __construct(protected JogadorRepository $jogadorRepository){}

    public function index(Request $request)
    {
        $jogador = $this->jogadorRepository->getAll(
            total_per_page: $request->total_per_page ?? 15,
            page: $request->page?? 1,
            filter: $request->get("filter", ""),
        );

        return response()->json(JogadorResource::collection($jogador), 200);
    }

    public function store(ValidaDadosJogador $request)
    {   
        return response()->json($this->jogadorRepository->create(new JogadorDTO(... $request->validated())), 201);  
    }

    public function show(string $id)
    {   
        if(!$jogador = $this->jogadorRepository->findById($id)){
            return response()->json(["message"=> "Jogador não encontrado"], Response::HTTP_NOT_FOUND);
        }
    
        return new JogadorResource($jogador);
    }

    public function update(ValidaDadosJogador $request, string $id)
    {
        $resposta = $this->jogadorRepository->update(new JogadorDTO(...[$id, ...$request->validated()]));
        if(!$resposta){
            return response()->json(["message"=> "Jogador não encontrado"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["message" => "Jogador atualizado com sucesso!"], Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        $resposta = $this->jogadorRepository->delete($id);

        if(!$resposta){
            return response()->json(["message"=> "Id do jogador não encontrado"], Response::HTTP_NOT_FOUND);
        }

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
