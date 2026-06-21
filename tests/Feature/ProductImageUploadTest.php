<?php

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function fakePng(string $name): UploadedFile
{
    $path = tempnam(sys_get_temp_dir(), 'product-image-');

    file_put_contents($path, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAFgwJ/luzsogAAAABJRU5ErkJggg=='));

    return new UploadedFile($path, $name, 'image/png', null, true);
}

it('stores an image when creating a product', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $type = Type::create([
        'name' => 'Eletrônicos',
    ]);
    $supplier = Supplier::factory()->create();
    $image = fakePng('produto.png');

    $this->actingAs($user)
        ->post('/products/new', [
            'name' => 'Notebook',
            'description' => 'Produto com imagem',
            'quantity' => 5,
            'price' => 2500,
            'type_id' => $type->id,
            'supplier_id' => $supplier->id,
            'image' => $image,
        ])
        ->assertRedirect('/products');

    $product = Product::where('name', 'Notebook')->firstOrFail();

    expect($product->image)->not->toBeNull();
    Storage::disk('public')->assertExists($product->image);
});

it('replaces the image when updating a product', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $type = Type::create([
        'name' => 'Roupas',
    ]);
    $supplier = Supplier::factory()->create();
    $oldImage = fakePng('antiga.png')->store('products', 'public');

    $product = Product::create([
        'name' => 'Camiseta',
        'description' => 'Produto antigo',
        'quantity' => 3,
        'price' => 59.90,
        'type_id' => $type->id,
        'supplier_id' => $supplier->id,
        'image' => $oldImage,
    ]);

    $this->actingAs($user)
        ->post('/products/update', [
            'id' => $product->id,
            'name' => 'Camiseta Atualizada',
            'description' => 'Produto atualizado',
            'quantity' => 4,
            'price' => 69.90,
            'type_id' => $type->id,
            'supplier_id' => $supplier->id,
            'image' => fakePng('nova.png'),
        ])
        ->assertRedirect('/products');

    $product->refresh();

    Storage::disk('public')->assertMissing($oldImage);
    Storage::disk('public')->assertExists($product->image);
});
