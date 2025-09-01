<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\ImagemImovel;
use Illuminate\Support\Facades\Storage;

class ImovelController extends Controller
{
    public function index()
    {
        $imoveis = Imovel::with('imagens')->paginate(15);
        return view('admin.imoveis.index', compact('imoveis'));
    }

    public function create()
    {
        return view('admin.imoveis.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'referencia' => 'nullable|string|max:100',
            'tipo_negocio' => 'required|string',
            'tipo_imovel' => 'required|string',
            'valor' => 'required|numeric',
            'cidade' => 'required|string',
            'bairro' => 'nullable|string',
            'status' => 'required|string',
            'destaque' => 'boolean',
            'imagens.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imovel = Imovel::create($data);

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $i => $imagem) {
                $path = $imagem->store('imoveis', 'public');
                ImagemImovel::create([
                    'imovel_id' => $imovel->id,
                    'caminho_imagem' => $path,
                    'ordem' => $i
                ]);
            }
        }

        return redirect()->route('admin.imoveis.index')->with('success', 'Imóvel cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $imovel = Imovel::with('imagens')->findOrFail($id);
        return view('admin.imoveis.edit', compact('imovel'));
    }

    public function update(Request $request, $id)
    {
        $imovel = Imovel::findOrFail($id);

        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'referencia' => 'nullable|string|max:100',
            'tipo_negocio' => 'required|string',
            'tipo_imovel' => 'required|string',
            'valor' => 'required|numeric',
            'cidade' => 'required|string',
            'bairro' => 'nullable|string',
            'status' => 'required|string',
            'destaque' => 'boolean',
            'imagens.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imovel->update($data);

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $i => $imagem) {
                $path = $imagem->store('imoveis', 'public');
                ImagemImovel::create([
                    'imovel_id' => $imovel->id,
                    'caminho_imagem' => $path,
                    'ordem' => $i
                ]);
            }
        }

        return redirect()->route('admin.imoveis.index')->with('success', 'Imóvel atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $imovel = Imovel::with('imagens')->findOrFail($id);

        foreach ($imovel->imagens as $img) {
            Storage::disk('public')->delete($img->caminho_imagem);
            $img->delete();
        }

        $imovel->delete();

        return redirect()->route('admin.imoveis.index')->with('success', 'Imóvel excluído com sucesso!');
    }
}
