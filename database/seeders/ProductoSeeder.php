<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $productos = [
            [
                'name' => 'Libro de Novela Histórica',
                'description' => 'Una novela ambientada en la independencia de Colombia.',
                'price' => 45000,
                'status' => 'Activo',
                'stock' => 120,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Revista Literaria Mensual',
                'description' => 'Revista con artículos y cuentos de autores emergentes.',
                'price' => 15000,
                'status' => 'Activo',
                'stock' => 300,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Ebook de Poesía Contemporánea',
                'description' => 'Colección digital de poemas modernos.',
                'price' => 20000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Audiolibro de Ciencia Ficción',
                'description' => 'Narración en audio de una saga futurista.',
                'price' => 35000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Manual de Escritura Creativa',
                'description' => 'Guía práctica para escritores principiantes.',
                'price' => 28000,
                'status' => 'Activo',
                'stock' => 80,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Colección de Cuentos Infantiles',
                'description' => 'Historias ilustradas para niños.',
                'price' => 32000,
                'status' => 'Activo',
                'stock' => 150,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Suscripción Digital a Revista Académica',
                'description' => 'Acceso mensual a artículos de investigación.',
                'price' => 25000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Guía de Estilo Editorial',
                'description' => 'Manual de normas para publicaciones.',
                'price' => 18000,
                'status' => 'Activo',
                'stock' => 60,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Curso Online de Redacción',
                'description' => 'Curso digital para mejorar la escritura.',
                'price' => 50000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Diccionario Literario',
                'description' => 'Compendio de términos literarios.',
                'price' => 40000,
                'status' => 'Activo',
                'stock' => 90,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Ebook de Ensayos Filosóficos',
                'description' => 'Selección de ensayos sobre filosofía contemporánea.',
                'price' => 22000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Audiolibro de Biografía',
                'description' => 'Narración en audio de la vida de un autor famoso.',
                'price' => 30000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Libro de Crítica Literaria',
                'description' => 'Análisis de obras clásicas y modernas.',
                'price' => 35000,
                'status' => 'Inactivo',
                'stock' => 70,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Revista de Arte y Cultura',
                'description' => 'Publicación mensual sobre arte y literatura.',
                'price' => 18000,
                'status' => 'Inactivo',
                'stock' => 200,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Suscripción Digital a Biblioteca Virtual',
                'description' => 'Acceso ilimitado a libros electrónicos.',
                'price' => 60000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Libro de Gramática Avanzada',
                'description' => 'Manual para perfeccionar el uso del idioma.',
                'price' => 27000,
                'status' => 'Activo',
                'stock' => 100,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Ebook de Narrativa Breve',
                'description' => 'Colección digital de cuentos cortos.',
                'price' => 15000,
                'status' => 'Inactivo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Audiolibro de Clásicos Universales',
                'description' => 'Narración en audio de obras clásicas.',
                'price' => 40000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
            [
                'name' => 'Libro de Historia Editorial',
                'description' => 'Recorrido por la evolución de las editoriales.',
                'price' => 38000,
                'status' => 'Activo',
                'stock' => 50,
                'category' => 'Producto físico',
            ],
            [
                'name' => 'Revista Digital de Innovación Literaria',
                'description' => 'Publicación digital sobre nuevas tendencias.',
                'price' => 20000,
                'status' => 'Activo',
                'stock' => 999,
                'category' => 'Producto digital',
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
