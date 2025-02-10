<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $idUsuario = $request->idUsuario;
        $carros = Carro::where('idUsuario',$idUsuario)->get();
        return response()->json($carros,200);
    }
    public function store(Request $request)
    {
        if(Carro::where('idUsuario',$request->idUsuario)->where('idProducto',$request->idProducto)->count() == 0){
            $carro = new Carro();
            $nlinea = Carro::where('idUsuario',$request->idUsuario)->max('nlinea');
            $carro->nlinea = $nlinea + 1;
            $carro->idProducto = $request->idProducto;
            $carro->nombre = $request->nombre;
            $carro->foto = $request->foto;
            $carro->precio = $request->precio;
            $carro->cantidad = $request->cantidad;
            $carro->idUsuario = $request->idUsuario;
            $carro->save();
            return response()->json($carro,200);
        }else{
            $carro = Carro::where('idUsuario',$request->idUsuario)->where('idProducto',$request->idProducto)->first();
            $carro->cantidad += $request->cantidad;
            $carro->save();
            return response()->json($carro,201);
        }

    }
    public function show($id)
    {
        $carros = Carro::where('idUsuario',$id)->count();
        return response()->json($carros,200);
    }
    public function update(Request $request)
    {
        $carro = Carro::findOrFail($request->id);
        $carro->cantidad = $request->cantidad;
        $carro->save();
        return response()->json($carro,201);
    }
    public function destroy(Request $request)
    {
        $carro = Carro::where('idUsuario',$request->idUsuario)->where('idProducto',$request->idProducto)->first();
        $carro->delete();
        return response()->json(null,200);
    }
    public function destroyAll($id){
        $carros = Carro::where('idUsuario',$id)->get();
        foreach($carros as $carro){
            $carro->delete();
        }
        return response()->json(null,200);
    }
}
