<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::parse('2024-09-10 03:44:55');

        // Seed country
        DB::table('country')->insert([
            ['id' => 1, 'name' => 'Argentina', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 2, 'name' => 'Brasil', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 3, 'name' => 'Colombia', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 4, 'name' => 'México', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 5, 'name' => 'España', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 6, 'name' => 'Francia', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 7, 'name' => 'Italia', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 8, 'name' => 'Australia', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 9, 'name' => 'Canadá', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 10, 'name' => 'Japón', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        // Seed Departament
        DB::table('departament')->insert([
            ['id' => 1, 'name' => 'Informatica', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 2, 'name' => 'Desarrollo', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 3, 'name' => 'Administracion', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 4, 'name' => 'Logistica', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 5, 'name' => 'Contabilidad', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 6, 'name' => 'Recursos Humanos', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        // Seed Cities
        $cities = [
            // Argentina (country_id = 1)
            ['id' => 1, 'name' => 'Buenos Aires', 'country_id' => 1],
            ['id' => 2, 'name' => 'Córdoba', 'country_id' => 1],
            ['id' => 3, 'name' => 'Rosario', 'country_id' => 1],
            ['id' => 4, 'name' => 'Mendoza', 'country_id' => 1],
            ['id' => 5, 'name' => 'La Plata', 'country_id' => 1],
            ['id' => 6, 'name' => 'Salta', 'country_id' => 1],
            ['id' => 7, 'name' => 'Santa Fe', 'country_id' => 1],
            ['id' => 8, 'name' => 'Mar del Plata', 'country_id' => 1],
            ['id' => 9, 'name' => 'San Juan', 'country_id' => 1],
            ['id' => 10, 'name' => 'Neuquén', 'country_id' => 1],
            ['id' => 11, 'name' => 'Tucumán', 'country_id' => 1],
            ['id' => 12, 'name' => 'San Miguel de Tucumán', 'country_id' => 1],
            ['id' => 13, 'name' => 'Bahía Blanca', 'country_id' => 1],
            ['id' => 14, 'name' => 'La Rioja', 'country_id' => 1],
            ['id' => 15, 'name' => 'Corrientes', 'country_id' => 1],
            ['id' => 16, 'name' => 'Posadas', 'country_id' => 1],
            ['id' => 17, 'name' => 'Jujuy', 'country_id' => 1],
            ['id' => 18, 'name' => 'Formosa', 'country_id' => 1],
            ['id' => 19, 'name' => 'San Luis', 'country_id' => 1],
            ['id' => 20, 'name' => 'Rawson', 'country_id' => 1],

            // Brasil (country_id = 2)
            ['id' => 21, 'name' => 'Río de Janeiro', 'country_id' => 2],
            ['id' => 22, 'name' => 'São Paulo', 'country_id' => 2],
            ['id' => 23, 'name' => 'Brasilia', 'country_id' => 2],
            ['id' => 24, 'name' => 'Salvador', 'country_id' => 2],
            ['id' => 25, 'name' => 'Fortaleza', 'country_id' => 2],
            ['id' => 26, 'name' => 'Belo Horizonte', 'country_id' => 2],
            ['id' => 27, 'name' => 'Manaos', 'country_id' => 2],
            ['id' => 28, 'name' => 'Curitiba', 'country_id' => 2],
            ['id' => 29, 'name' => 'Recife', 'country_id' => 2],
            ['id' => 30, 'name' => 'Porto Alegre', 'country_id' => 2],
            ['id' => 31, 'name' => 'Belém', 'country_id' => 2],
            ['id' => 32, 'name' => 'Goiânia', 'country_id' => 2],
            ['id' => 33, 'name' => 'Campinas', 'country_id' => 2],
            ['id' => 34, 'name' => 'São Luís', 'country_id' => 2],
            ['id' => 35, 'name' => 'Guarulhos', 'country_id' => 2],
            ['id' => 36, 'name' => 'São Gonçalo', 'country_id' => 2],
            ['id' => 37, 'name' => 'Maceió', 'country_id' => 2],
            ['id' => 38, 'name' => 'Campo Grande', 'country_id' => 2],
            ['id' => 39, 'name' => 'Natal', 'country_id' => 2],
            ['id' => 40, 'name' => 'Teresina', 'country_id' => 2],

            // Colombia (country_id = 3)
            ['id' => 41, 'name' => 'Bogotá', 'country_id' => 3],
            ['id' => 42, 'name' => 'Medellín', 'country_id' => 3],
            ['id' => 43, 'name' => 'Cali', 'country_id' => 3],
            ['id' => 44, 'name' => 'Barranquilla', 'country_id' => 3],
            ['id' => 45, 'name' => 'Cartagena', 'country_id' => 3],
            ['id' => 46, 'name' => 'Cúcuta', 'country_id' => 3],
            ['id' => 47, 'name' => 'Soledad', 'country_id' => 3],
            ['id' => 48, 'name' => 'Ibagué', 'country_id' => 3],
            ['id' => 49, 'name' => 'Bucaramanga', 'country_id' => 3],
            ['id' => 50, 'name' => 'Santa Marta', 'country_id' => 3],
            ['id' => 51, 'name' => 'Villavicencio', 'country_id' => 3],
            ['id' => 52, 'name' => 'Pasto', 'country_id' => 3],
            ['id' => 53, 'name' => 'Manizales', 'country_id' => 3],
            ['id' => 54, 'name' => 'Neiva', 'country_id' => 3],
            ['id' => 55, 'name' => 'Pereira', 'country_id' => 3],
            ['id' => 56, 'name' => 'Montería', 'country_id' => 3],
            ['id' => 57, 'name' => 'Popayán', 'country_id' => 3],
            ['id' => 58, 'name' => 'Valledupar', 'country_id' => 3],
            ['id' => 59, 'name' => 'Quibdó', 'country_id' => 3],
            ['id' => 60, 'name' => 'Armenia', 'country_id' => 3],

            // México (country_id = 4)
            ['id' => 61, 'name' => 'Ciudad de México', 'country_id' => 4],
            ['id' => 62, 'name' => 'Guadalajara', 'country_id' => 4],
            ['id' => 63, 'name' => 'Monterrey', 'country_id' => 4],
            ['id' => 64, 'name' => 'Puebla', 'country_id' => 4],
            ['id' => 65, 'name' => 'Tijuana', 'country_id' => 4],
            ['id' => 66, 'name' => 'León', 'country_id' => 4],
            ['id' => 67, 'name' => 'Juárez', 'country_id' => 4],
            ['id' => 68, 'name' => 'Zapopan', 'country_id' => 4],
            ['id' => 69, 'name' => 'Mérida', 'country_id' => 4],
            ['id' => 70, 'name' => 'Mexicali', 'country_id' => 4],
            ['id' => 71, 'name' => 'Acapulco', 'country_id' => 4],
            ['id' => 72, 'name' => 'Toluca', 'country_id' => 4],
            ['id' => 73, 'name' => 'Cancún', 'country_id' => 4],
            ['id' => 74, 'name' => 'Querétaro', 'country_id' => 4],
            ['id' => 75, 'name' => 'Morelia', 'country_id' => 4],
            ['id' => 76, 'name' => 'Culiacán', 'country_id' => 4],
            ['id' => 77, 'name' => 'Hermosillo', 'country_id' => 4],
            ['id' => 78, 'name' => 'Chihuahua', 'country_id' => 4],
            ['id' => 79, 'name' => 'Durango', 'country_id' => 4],
            ['id' => 80, 'name' => 'Saltillo', 'country_id' => 4],

            // España (country_id = 5)
            ['id' => 81, 'name' => 'Madrid', 'country_id' => 5],
            ['id' => 82, 'name' => 'Barcelona', 'country_id' => 5],
            ['id' => 83, 'name' => 'Valencia', 'country_id' => 5],
            ['id' => 84, 'name' => 'Sevilla', 'country_id' => 5],
            ['id' => 85, 'name' => 'Zaragoza', 'country_id' => 5],
            ['id' => 86, 'name' => 'Málaga', 'country_id' => 5],
            ['id' => 87, 'name' => 'Murcia', 'country_id' => 5],
            ['id' => 88, 'name' => 'Palma de Mallorca', 'country_id' => 5],
            ['id' => 89, 'name' => 'Bilbao', 'country_id' => 5],
            ['id' => 90, 'name' => 'Alicante', 'country_id' => 5],
            ['id' => 91, 'name' => 'Córdoba', 'country_id' => 5],
            ['id' => 92, 'name' => 'Valladolid', 'country_id' => 5],
            ['id' => 93, 'name' => 'Almería', 'country_id' => 5],
            ['id' => 94, 'name' => 'León', 'country_id' => 5],
            ['id' => 95, 'name' => 'Soria', 'country_id' => 5],
            ['id' => 96, 'name' => 'Oviedo', 'country_id' => 5],
            ['id' => 97, 'name' => 'La Coruña', 'country_id' => 5],
            ['id' => 98, 'name' => 'Gijón', 'country_id' => 5],
            ['id' => 99, 'name' => 'Logroño', 'country_id' => 5],
            ['id' => 100, 'name' => 'Pamplona', 'country_id' => 5],

            // Francia (country_id = 6)
            ['id' => 114, 'name' => 'Paris', 'country_id' => 6],
            ['id' => 115, 'name' => 'Marseille', 'country_id' => 6],
            ['id' => 116, 'name' => 'Lyon', 'country_id' => 6],
            ['id' => 117, 'name' => 'Toulouse', 'country_id' => 6],
            ['id' => 118, 'name' => 'Nice', 'country_id' => 6],
            ['id' => 119, 'name' => 'Nantes', 'country_id' => 6],
            ['id' => 120, 'name' => 'Strasbourg', 'country_id' => 6],
            ['id' => 121, 'name' => 'Montpellier', 'country_id' => 6],
            ['id' => 122, 'name' => 'Bordeaux', 'country_id' => 6],
            ['id' => 123, 'name' => 'Lille', 'country_id' => 6],
            ['id' => 124, 'name' => 'Rennes', 'country_id' => 6],
            ['id' => 125, 'name' => 'Le Havre', 'country_id' => 6],
            ['id' => 126, 'name' => 'Reims', 'country_id' => 6],
            ['id' => 127, 'name' => 'Le Mans', 'country_id' => 6],
            ['id' => 128, 'name' => 'Amiens', 'country_id' => 6],
            ['id' => 129, 'name' => 'Clermont-Ferrand', 'country_id' => 6],
            ['id' => 130, 'name' => 'Saint-Étienne', 'country_id' => 6],
            ['id' => 135, 'name' => 'Dijon', 'country_id' => 6],
            ['id' => 136, 'name' => 'Grenoble', 'country_id' => 6],
            ['id' => 164, 'name' => 'La Rochelle', 'country_id' => 6],
        ];

        foreach ($cities as $city) {
            DB::table('city')->insert([
                'id' => $city['id'],
                'name' => $city['name'],
                'country_id' => $city['country_id'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }

        // Seed Employees
        DB::table('employee')->insert([
            'id' => 1,
            'first_name' => 'Javier Andrés',
            'last_name' => 'Rojas Erazo',
            'document_number' => '1144192322',
            'phone_number' => '3173280247',
            'country_id' => 3,
            'city_id' => 58,
            'departament_id' => 2,
            'birthdate' => '2024-09-09',
            'address' => 'Cl. 46 #10-51',
            'email' => 'jare_123@hotmail.es',
            'is_active' => 1,
            'created_at' => Carbon::parse('2024-09-10 05:25:42'),
            'updated_at' => Carbon::parse('2024-09-11 08:32:36'),
        ]);

        // Seed Users
        DB::table('user')->insert([
            'id' => 1,
            'first_name' => 'Life File Admin',
            'last_name' => 'Admin',
            'document_number' => '12345678',
            'password' => Hash::make('0000'), // Contraseña: 0000
            'email' => 'prueba@lifefile.com',
            'is_active' => 1,
            'created_at' => Carbon::parse('2024-09-11 08:07:06'),
            'updated_at' => Carbon::parse('2024-09-11 08:07:06'),
        ]);

        $this->command->info('Database seeded successfully!');
    }
}
