<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    //
    public function create()
    {
        return view('products.create', ['types' => Type::all()]);
    }

    //função chamada no submit do form..
    //será um POST com os dados
    public function store(Request $request)
    {
        //alimenta a var $errors na view
        $request->validate([
            'name' => 'required|min:2|max:50',
            'quantity' => 'required|gt:0',
            'price' => 'required|gt:0',
            'image' => 'nullable|image|max:2048',
        ]);

        //faz o upload da imagem caso seja enviada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        //não esquecer import do Product model.
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'type_id' => $request->type_id,
            'image' => $imagePath,
        ]);

        //usaremos flash session messages
        return redirect('/products')->with('success', 'Produto cadastrado!');
    }

    //função que irá mostrar a view de listagem
    //passando como parâmetro a consulta no banco com ::all()
    public function index()
    {
        return view('products.index', [
            'products' => Product::all()
        ]);
    }

    public function edit($id)
    {
        //find é o método que faz select * from products where id= ?
        $product = Product::find($id);

        //retornamos a view passando a TUPLA de produto consultado
        return view('products.edit', ['product' => $product, 'types' => Type::all()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'quantity' => 'required|gt:0',
            'price' => 'required|gt:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::find($request->id);

        //mantém a imagem anterior caso nenhuma nova seja enviada
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            //remove a imagem antiga do storage antes de salvar a nova
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        //método update faz um update product set name = ? etc...
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'type_id' => $request->type_id,
            'image' => $imagePath,
        ]);

        return redirect('/products')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        try {
            //select * from product where id = ?
            $product = Product::find($id);

            //remove a imagem do storage ao excluir o produto
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            //deleta o produto no banco
            $product->delete();

            return redirect('/products')->with('success', 'Produto excluído com sucesso!');
        } catch (\Exception $e) {
            //registra o erro no log para análise
            Log::error('Erro ao excluir produto: ' . $e->getMessage());
            return redirect('/products')->with('error', 'Não foi possível excluir o produto. Tente novamente.');
        }
    }
}
