<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    public function index(): View
    {
        return view('suppliers.index', [
            'suppliers' => Supplier::withCount('products')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Supplier::create($this->validateSupplier($request));

        return redirect('/suppliers')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit(int $id): View
    {
        return view('suppliers.edit', [
            'supplier' => Supplier::findOrFail($id),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $supplier = Supplier::findOrFail($request->id);

        $supplier->update($this->validateSupplier($request, $supplier->id));

        return redirect('/suppliers')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect('/suppliers')->with('success', 'Fornecedor excluído com sucesso!');
    }

    /**
     * @return array{name: string, email: string, phone?: string|null, document?: string|null, city?: string|null}
     */
    private function validateSupplier(Request $request, ?int $supplierId = null): array
    {
        return $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:suppliers,email,'.$supplierId],
            'phone' => ['nullable', 'max:30'],
            'document' => ['nullable', 'max:30'],
            'city' => ['nullable', 'max:80'],
        ]);
    }
}
