@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-white mb-6">Crear Nueva Reseña</h1>

            <form action="{{ route('resennas.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="detalle" class="block text-gray-300 text-sm font-medium">Detalle:</label>
                    <input type="text" id="detalle" name="detalle"
                        class="mt-1 block w-full px-4 py-2 border border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white"
                        required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-gray-300 text-sm font-medium">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        class="mt-1 block w-full px-4 py-2 border border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white"
                        required></textarea>
                </div>

                <div class="mb-4">
                    <label for="rating" class="block text-gray-300 text-sm font-medium">Rating:</label>
                    <div class="flex items-center">
                        <input type="hidden" id="rating" name="rating" required>
                        <div class="flex space-x-1">
                            <svg class="star w-8 h-8 text-gray-400 cursor-pointer" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.431L24 9.797l-6 5.847L19.335 24 12 19.799 4.665 24 6 15.644l-6-5.847 8.332-1.779z" />
                            </svg>
                            <svg class="star w-8 h-8 text-gray-400 cursor-pointer" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.431L24 9.797l-6 5.847L19.335 24 12 19.799 4.665 24 6 15.644l-6-5.847 8.332-1.779z" />
                            </svg>
                            <svg class="star w-8 h-8 text-gray-400 cursor-pointer" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.431L24 9.797l-6 5.847L19.335 24 12 19.799 4.665 24 6 15.644l-6-5.847 8.332-1.779z" />
                            </svg>
                            <svg class="star w-8 h-8 text-gray-400 cursor-pointer" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.431L24 9.797l-6 5.847L19.335 24 12 19.799 4.665 24 6 15.644l-6-5.847 8.332-1.779z" />
                            </svg>
                            <svg class="star w-8 h-8 text-gray-400 cursor-pointer" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.431L24 9.797l-6 5.847L19.335 24 12 19.799 4.665 24 6 15.644l-6-5.847 8.332-1.779z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" onclick="window.location='{{ route('resena') }}'"
                        class="bg-gradient-to-r from-gray-700 to-gray-800 text-white py-2 px-4 rounded-md inline-flex items-center justify-center hover:from-gray-600 hover:to-gray-700 transition-colors duration-300">
                        &larr; Regresar a Reseñas
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-gray-700 to-gray-800 text-white py-2 px-4 rounded-md inline-flex items-center justify-center hover:from-gray-600 hover:to-gray-700 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Crear Reseña
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');

        ratingInput.value = 0;

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                ratingInput.value = index + 1;
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('text-yellow-500');
                        s.classList.remove('text-gray-400');
                    } else {
                        s.classList.remove('text-yellow-500');
                        s.classList.add('text-gray-400');
                    }
                });
            });
        });
    </script>
@endsection
