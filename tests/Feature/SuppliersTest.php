<?php

use App\Models\Supplier;
use App\Models\User;

it('lists suppliers for authenticated users', function () {
    $user = User::factory()->create();
    $supplier = Supplier::factory()->create([
        'name' => 'Fornecedor Aula',
    ]);

    $this->actingAs($user)
        ->get('/suppliers')
        ->assertSuccessful()
        ->assertSee($supplier->name);
});

it('creates a supplier', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/suppliers/new', [
            'name' => 'Tech Distribuidora',
            'email' => 'contato@tech.test',
            'phone' => '(11) 99999-9999',
            'document' => '12.345.678/0001-90',
            'city' => 'Sao Paulo',
        ])
        ->assertRedirect('/suppliers');

    $this->assertDatabaseHas('suppliers', [
        'name' => 'Tech Distribuidora',
        'email' => 'contato@tech.test',
        'city' => 'Sao Paulo',
    ]);
});

it('updates a supplier', function () {
    $user = User::factory()->create();
    $supplier = Supplier::factory()->create();

    $this->actingAs($user)
        ->post('/suppliers/update', [
            'id' => $supplier->id,
            'name' => 'Fornecedor Atualizado',
            'email' => 'novo@fornecedor.test',
            'phone' => '(21) 98888-7777',
            'document' => '98.765.432/0001-10',
            'city' => 'Rio de Janeiro',
        ])
        ->assertRedirect('/suppliers');

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'name' => 'Fornecedor Atualizado',
        'email' => 'novo@fornecedor.test',
    ]);
});

it('deletes a supplier', function () {
    $user = User::factory()->create();
    $supplier = Supplier::factory()->create();

    $this->actingAs($user)
        ->get('/suppliers/delete/'.$supplier->id)
        ->assertRedirect('/suppliers');

    $this->assertDatabaseMissing('suppliers', [
        'id' => $supplier->id,
    ]);
});

it('validates supplier required fields', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->from('/suppliers/new')
        ->post('/suppliers/new', [
            'name' => '',
            'email' => 'not-an-email',
        ])
        ->assertRedirect('/suppliers/new')
        ->assertSessionHasErrors(['name', 'email']);
});
