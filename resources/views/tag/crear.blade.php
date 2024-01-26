@extends('plantillas.principal')
@section('titulo')
    Films
@endsection
@section('cabecera')
    Editar Pelicula
@endsection
@section('contenido')
    <div class="mx-auto w-3/4 p-8">
        <div class="w-3/4 mx-auto p-6 rounded-xl shadow-xl bg-gray-400 dark:text-gray-200">
            <form method="POST" action="{{ route('tags.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                    <input type="text" id="nombre" value="{{ old('nombre') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nombre..." name="nombre">
                    @error('nombre')
                        <x-input-error>{{ $message }}</x-input-error>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="color"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descipcion</label>
                    <input type="color" id="color" name="color"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value = {{ old('color') }}>
                    @error('color')
                        <x-input-error>{{ $message }}</x-input-error>
                    @enderror
                </div>
                <div class="flex flex-row-reverse">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-save"></i> CREAR
                    </button>
                    <a href="{{ route('tags.index') }}"
                        class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-xmark"></i> CANCELAR</a>
                </div>
            </form>
        </div>
    </div>
@endsection
