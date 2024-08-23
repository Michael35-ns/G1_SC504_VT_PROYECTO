@extends('layouts.app')

@section('titulo')
    🎉 ¡Proyecto Completado, Descubre lo Nuevo! 🎉
@endsection

@section('contenido')
    <div class="max-w-7xl mx-auto p-8">
        <!-- Noticia sobre el estado final del proyecto -->
        <div class="bg-green-200 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                🚀 ¡Lanzamiento de la Versión Final del Proyecto! 🚀
            </h2>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">
                Módulos de Gastos, Ingresos, Reseñas y Objetivos Económicos Implementados
            </h3>
            <p class="text-gray-600 mb-4">
                <strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
            </p>
            <p class="text-gray-700 mb-4">
                Nos complace anunciar que hemos alcanzado la versión final de nuestro proyecto. Ahora contamos con
                un conjunto completo de módulos que te permitirán gestionar tus finanzas de manera integral. Con la
                implementación de los módulos de Gastos, Ingresos, Reseñas y Objetivos Económicos, estarás preparado
                para tener un control total sobre tu economía personal.
            </p>
            <ul class="list-disc list-inside text-gray-700 mb-4">
                <li>Gestión avanzada de gastos y seguimiento detallado de tus finanzas.</li>
                <li>Registro y análisis de ingresos con opciones personalizables.</li>
                <li>Reseñas para compartir y recibir opiniones sobre servicios.</li>
                <li>Establecimiento y seguimiento de objetivos económicos a corto y largo plazo.</li>
            </ul>
            <p class="text-gray-700 mb-4">
                Este conjunto de herramientas te brinda todo lo necesario para mantener tus finanzas organizadas y
                alcanzar tus metas financieras. Explora estas funcionalidades y maximiza el potencial de tu gestión
                económica.
            </p>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Leer más
                </button>
                <div x-show="open" x-transition class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-300">
                    <p class="text-gray-700">
                        Con esta versión final, nos hemos asegurado de que cada módulo funcione de manera integrada
                        y eficiente, ofreciéndote una experiencia de usuario completa y satisfactoria. Desde la gestión
                        de tus gastos e ingresos hasta la planificación de tus objetivos económicos, nuestra plataforma
                        está diseñada para ayudarte a tomar decisiones financieras informadas y estratégicas.
                    </p>
                    <p class="text-gray-700 mt-2">
                        Agradecemos tu confianza en nuestro proyecto y esperamos que disfrutes de todas las mejoras
                        y funcionalidades que hemos implementado. Si tienes alguna pregunta o sugerencia, nuestro equipo
                        está siempre disponible para asistirte. ¡Es el momento de tomar el control total de tus finanzas!
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto p-8">
            <div class="bg-gray-200 rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    ¡Actualización Final!
                </h2>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                    Proyecto Completado con Éxito
                </h3>
                <p class="text-gray-600 mb-4">
                    <strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                </p>
                <p class="text-gray-700 mb-4">
                    Nos enorgullece compartir que hemos finalizado la implementación del proyecto, incluyendo
                    todos los módulos clave: Gastos, Ingresos, Reseñas y Objetivos Económicos. Ahora, podrás
                    gestionar y controlar tus finanzas con una plataforma robusta y segura.
                </p>
                <p class="text-gray-700 mb-4">
                    Este logro es solo el comienzo de una experiencia financiera más organizada y eficiente.
                    ¡Explora estas nuevas funcionalidades y comienza a mejorar tu economía personal hoy mismo!
                </p>

                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Leer más
                    </button>
                    <div x-show="open" x-transition class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-300">
                        <p class="text-gray-700">
                            Con la finalización de estos módulos, hemos puesto a tu disposición un conjunto de
                            herramientas que transformarán la forma en que gestionas tu dinero. Desde la planificación
                            de tus objetivos hasta la ejecución diaria de tus finanzas, nuestra plataforma está diseñada
                            para brindarte un soporte completo y continuo.
                        </p>
                        <p class="text-gray-700 mt-2">
                            Gracias por ser parte de esta emocionante jornada. Estamos seguros de que estas
                            funcionalidades te ayudarán a alcanzar nuevas alturas en tu gestión financiera.
                            ¡Disfruta de la versión final de nuestro proyecto!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
