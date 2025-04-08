<?php

namespace App\Http\Controllers;

use App\Models\apiLeitor;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class ApiLeitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = apiLeitor::All();
        $contador = $regBook->count();

        return Response()->json($regBook);
        
    }

    
    public function store(Request $request)
   {
    //validaçao dos dados recebidos

    $validator = Validator::make($request->all(), [
        'NomeLeitor' => 'required',
        'Idade' => 'required',
        'Email' => 'required'     
    ]);

    if ($validator->fails()) {
        return response()->json([
            'sucess' => false,
            'message' => 'Registros inválidos',
            'errors' => $validator->errors()
        ], 400);
    }

    $registros = apiLeitor::create($request->all());

    if ($registros) {
        return response()->json([
            'sucess' => true,
            'message' => 'Leitor cadastrado com sucesso!',
            'data' => $registros
        ], 201);

    } else {
        return response()->json([
            'sucess' => false,
            'message' => 'Erro ao cadastrar o Leitor'
        ], 500);
    }
}
   
    public function show(apiLeitor $id)
    {
        
        $regBook = apiLeitor::find($id);

        if($regBook){
            return 'Leitores Localizados: '.$regBook.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'Leitores não localizados. '.Response()->json([],Response::HTTP_NO_CONTENT);
    
            }
        }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'NomeLeitor' => 'required',
            'Idade' => 'required',
            'Email' => 'required'     
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
    }

        $regBookBanco = apiLeitor::find($id);

        if (!$regBookBanco) {
            return response()->json([
                'sucess' => false,
                'message' => 'Leitor não encontrado'
            ], 404);
        }

        $regBookBanco->NomeLeitor = $request->NomeLeitor;
        $regBookBanco->Idade = $request->Idade;
        $regBookBanco->Email = $request->Email;

        if ($regBookBanco->save()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Leitors atualizados com sucesso',
                'data' => $regBookBanco
            ], 200);
        } else{
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao atualizar os Leitores'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regBook = apiLeitor::find($id);

        if (!$regBook) {
            return response()->json([
            'sucess' => false,
            'message' => 'Leitor nao encontrado'
            ], 404);
        }

        if (!$regBook->delete()) {
            return response()->json([
            'sucess' => true,
            'message' => 'Leitor deletado com sucesso'
            ], 200);
        }

            return response()->json([
            'sucess' => true,
            'message' => 'Erro ao deletar livro'
            ], 500);
        }
    }
