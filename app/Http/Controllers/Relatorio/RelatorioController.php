<?php

namespace App\Http\Controllers\Relatorio;

use App\Enums\CodeStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Auth;
use App\Models\Venda;
use App\Models\Cliente;
use App\Repositories\Contracts\Relatorio\RelatorioRepositoryInterface;

class RelatorioController extends Controller
{
    private $relatorioRepository;

    public function __construct(RelatorioRepositoryInterface $relatorioRepository)
    {
        $this->relatorioRepository = $relatorioRepository;
    }

    public function vendas()
    {
        try {

            $res = $this->relatorioRepository->vendas();

            if (isset($res->code) && $res->code == CodeStatusEnum::ERROR_SERVER) {
                return response()->json(['message' => $res->message], $res->code);
            }

            return response()->json(['response' => $res], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Erro de servidor'], 500);
        }
    }

    public function clientes()
    {
        try {

            $res = $this->relatorioRepository->clientes();

            if (isset($res->code) && $res->code == CodeStatusEnum::ERROR_SERVER) {
                return response()->json(['message' => $res->message], $res->code);
            }

            return response()->json(['response' => $res], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Erro de servidor'], 500);
        }
    }

    public function estoque()
    {
        try {

            $res = $this->relatorioRepository->estoque();

            if (isset($res->code) && $res->code == CodeStatusEnum::ERROR_SERVER) {
                return response()->json(['message' => $res->message], $res->code);
            }

            return response()->json(['response' => $res], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Erro de servidor'], 500);
        }
    }

    public function vendidos()
    {
        try {

            $res = $this->relatorioRepository->vendidos();

            if (isset($res->code) && $res->code == CodeStatusEnum::ERROR_SERVER) {
                return response()->json(['message' => $res->message], $res->code);
            }

            return response()->json(['response' => $res], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Erro de servidor'], 500);
        }
    }
}
