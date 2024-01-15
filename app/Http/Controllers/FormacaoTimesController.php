<?php

namespace App\Http\Controllers;

use App\Models\Jogadores;
use Illuminate\Http\Request;

class FormacaoTimesController extends Controller
{
    public function formarTimes()
    {
        $jogadoresConfirmados = Jogadores::where('presenca', true)->get();

        $jogadoresPorTime = 5;

        if (count($jogadoresConfirmados) < $jogadoresPorTime * 2) {
            return response()->json(['message' => 'Não há jogadores suficientes para formar times.'], 400);
        }

        $jogadoresEmbaralhados = $jogadoresConfirmados->shuffle();

        $times = $this->dividirJogadoresEmTimes($jogadoresEmbaralhados, $jogadoresPorTime);

        return response()->json(['times' => $times], 200);
    }

    private function dividirJogadoresEmTimes($jogadores, $jogadoresPorTime)
    {
        $times = [];
        $indiceTime = 0;

        foreach ($jogadores as $jogador) {
            if (!isset($times[$indiceTime])) {
                $times[$indiceTime] = [];
            }

            $timeAtual = &$times[$indiceTime];
            if (count($timeAtual) < $jogadoresPorTime) {
                if (!$this->timeTemGoleiro($timeAtual, $jogador->goleiro)) {
                    $timeAtual[] = $jogador;
                }
            }

            if (count($timeAtual) >= $jogadoresPorTime) {
                $indiceTime++;
            }
        }

        return $times;
    }

    private function timeTemGoleiro($time, $novoJogadorGoleiro)
    {
        $goleirosTime = array_column($time, 'goleiro');

        return $novoJogadorGoleiro && in_array(true, $goleirosTime);
    }
}
