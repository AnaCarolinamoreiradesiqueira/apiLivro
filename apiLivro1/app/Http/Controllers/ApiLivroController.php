<?php

namespace App\Http\Controllers;

use App\Models\apiLivro;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class ApiLivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = apiLivro::All();
        $contador = $regBook->count();

        return Response()->json($regBook);
        
    }

    
    public function store(Request $request)
   {
    //validaçao dos dados recebidos

    $validator = Validator::make($request->all(), [
        'NomeLivro' => 'required',
        'NomeAutor' => 'required',
        'Editora' => 'required'     
    ]);

    if ($validator->fails()) {
        return response()->json([
            'sucess' => false,
            'message' => 'Registros inválidos',
            'errors' => $validator->errors()
        ], 400);
    }

    $registros = apiLivro::create($request->all());

    if ($registros) {
        return response()->json([
            'sucess' => true,
            'message' => 'Livro cadastrado com sucesso!',
            'data' => $registros
        ], 201);

    } else {
        return response()->json([
            'sucess' => false,
            'message' => 'Erro ao cadastrar o Livro'
        ], 500);
    }
}
   
    public function show(apiLivro $id)
    {
        
        $regBook = apiLivro::find($id);

        if($regBook){
            return 'Livros Localizados: '.$regBook.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'Livros não localizados. '.Response()->json([],Response::HTTP_NO_CONTENT);
    
            }
        }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'NomeLivro' => 'required',
            'NomeAutor' => 'required',
            'Editora' => 'required'     
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
    }

        $regBookBanco = apiLivro::find($id);

        if (!$regBookBanco) {
            return response()->json([
                'sucess' => false,
                'message' => 'Livro não encontrado'
            ], 404);
        }

        $regBookBanco->NomeLivro = $request->NomeLivro;
        $regBookBanco->NomeAutor = $request->NomeAutor;
        $regBookBanco->Editora = $request->Editora;

        if ($regBookBanco->save()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Livros atualizados com sucesso',
                'data' => $regBookBanco
            ], 200);
        } else{
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao atualizar os livros'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regBook = apiLivro::find($id);

        if (!$regBook) {
            return response()->json([
            'sucess' => false,
            'message' => 'Livro nao encontrado'
            ], 404);
        }

        if (!$regBook->delete()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Erro ao deletar livro'
              ], 500);

              
            return response()->json([
            'sucess' => true,
            'message' => 'Livro deletado com sucesso'
            ], 200);
        }

            
        }
    }
