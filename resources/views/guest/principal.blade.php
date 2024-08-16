@extends('layouts.app')

@section('titulo')
    😁 ¡Bienvenido! 😁
@endsection

@section('contenido')
    <div class="max-w-7xl mx-auto p-8 bg-blue-100 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">
            🎉 ¡Estamos emocionados de tenerte aquí! 🎉
        </h2>
        <p class="text-gray-700 mb-4">
            ¡Hola y bienvenido a nuestra aplicación! 🌟 Ya sea que seas un usuario nuevo que acaba de registrarse o un
            veterano que ha regresado, estamos encantados de tenerte con nosotros. Aquí podrás explorar y disfrutar de
            todas las funcionalidades que ofrecemos.
        </p>
        <p class="text-gray-700 mb-4">
            Para comenzar, te invitamos a <strong>leer las reseñas</strong> sobre nuestra aplicación. Aquí podrás encontrar
            comentarios y valoraciones que te ayudarán a sacar el máximo provecho de nuestra plataforma. 🚀
        </p>
        <p class="text-gray-700 mb-4">
            También te recomendamos visitar nuestra sección de noticias más recientes, donde encontrarás las últimas
            actualizaciones y mejoras que hemos implementado. 📰✨
        </p>
        <a href="{{ url('/home') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Ver Noticias Recientes
        </a>
    </div>
@endsection
