@props([
    'type' => 'success',
    'message' => ''
])

@php
$classes = [
    'success' => 'bg-green-100 text-green-800 border-green-300',
    'error' => 'bg-red-100 text-red-800 border-red-300',
    'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
][$type] 

?? 'bg-gray-100 text-gray-800 border-gray-300';

@endphp

@if ($message)
    <div
        class="border px-4 py-3 rounded shadow {{ $classes }}"
        x-data="{ show: true }"
        x-show="show">
        {{ $message }}
        <span class="float-end cursor-pointer" @click="show = false">&times;</span>
    </div>
@endif