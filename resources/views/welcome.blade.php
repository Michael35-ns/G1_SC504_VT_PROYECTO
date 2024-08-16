@extends('layouts.app')

@section('titulo')
    😁 ¡Bienvenido, Tenemos noticias para ti! 😁
@endsection

@section('contenido')
    <div class="max-w-7xl mx-auto p-8">
        <!-- Noticia sobre el módulo de ingresos y gastos -->
        <div class="bg-green-200 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                🚀 ¡Nuevas Funcionalidades en Gestión Financiera! 🚀
            </h2>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">
                Módulo de Ingresos y Gastos Ahora Disponible
            </h3>
            <p class="text-gray-600 mb-4">
                <strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
            </p>
            <p class="text-gray-700 mb-4">
                Nos complace anunciar el lanzamiento de nuestro nuevo módulo de gestión de ingresos y gastos. Este módulo
                está diseñado para que puedas registrar y gestionar tus finanzas de manera efectiva y segura. Ahora podrás
                organizar tus gastos y controlar tus ingresos con herramientas avanzadas que incluyen:
            </p>
            <ul class="list-disc list-inside text-gray-700 mb-4">
                <li>Categorías personalizables para una gestión más organizada.</li>
                <li>Filtros avanzados para visualizar y analizar tus datos financieros.</li>
                <li>Opciones para agregar descripciones detalladas a tus transacciones.</li>
                <li>Capacidad para eliminar registros obsoletos o incorrectos.</li>
                <li>Encriptación de datos para una seguridad mejorada.</li>
            </ul>
            <p class="text-gray-700 mb-4">
                Este módulo no solo mejora la forma en que gestionas tus finanzas, sino que también asegura que tus datos
                estén protegidos con los más altos estándares de seguridad. Te invitamos a explorar estas nuevas
                funcionalidades y
                empezar a gestionar tus finanzas de manera más eficiente.
            </p>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Leer más
                </button>
                <div x-show="open" x-transition class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-300">
                    <p class="text-gray-700">
                        El nuevo módulo de ingresos y gastos está diseñado para ofrecerte una experiencia completa y
                        personalizada en la gestión de tus finanzas. Con esta actualización, tendrás acceso a herramientas
                        que
                        te permitirán ajustar y personalizar tu categorización, realizar un seguimiento detallado de tus
                        ingresos y gastos, y mantener tu información segura y privada.
                    </p>
                    <p class="text-gray-700 mt-2">
                        Apreciamos tu continuo apoyo y esperamos que encuentres útil esta nueva funcionalidad. Si tienes
                        alguna
                        pregunta o necesitas asistencia, nuestro equipo está aquí para ayudarte. ¡Explora, personaliza y
                        mejora tu gestión financiera hoy mismo!
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto p-8">
            <div class="bg-gray-200 rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    ¡Grandes Noticias!
                </h2>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                    Nuevo Módulo de Seguridad Implementado
                </h3>
                <p class="text-gray-600 mb-4">
                    <strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                </p>
                <p class="text-gray-700 mb-4">
                    Nos complace anunciar que hemos implementado un nuevo módulo de seguridad en nuestra plataforma. Ahora,
                    podrás disfrutar de nuevas funcionalidades como el inicio de sesión y registro en nuestro sistema. Esta
                    actualización no solo mejora la seguridad general, sino que también facilita el acceso a todos nuestros
                    usuarios, tanto nuevos como antiguos.
                </p>
                <p class="text-gray-700 mb-4">
                    Si eres un usuario antiguo, ¡te invitamos a explorar estas nuevas funciones y actualizar tu perfil! Para
                    los
                    nuevos usuarios, este es el momento perfecto para registrarte y comenzar a disfrutar de todas las
                    ventajas
                    que nuestra plataforma ofrece.
                </p>

                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Leer más
                    </button>
                    <div x-show="open" x-transition class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-300">
                        <p class="text-gray-700">
                            Hemos trabajado arduamente para asegurar que la transición sea lo más fluida posible. El nuevo
                            módulo está diseñado para ser intuitivo y fácil de usar. Además, hemos integrado funcionalidades
                            que
                            permiten una mayor personalización y control de tu cuenta. Si tienes alguna pregunta o necesitas
                            asistencia, nuestro equipo de soporte está aquí para ayudarte.
                        </p>
                        <p class="text-gray-700 mt-2">
                            Gracias por ser parte de nuestra comunidad. Estamos emocionados de compartir estas mejoras
                            contigo y
                            esperamos que disfrutes de una experiencia aún mejor con nuestro software. Mantente al tanto de
                            más
                            actualizaciones y novedades en el futuro.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
