<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'slug' => 'admin',
                'en' => 'Administrator',
                'ru' => 'Администратор'
            ],
            [
                'slug' => 'admin',
                'en' => 'Manager',
                'ru' => 'Менеджер'
            ],
            [
                'slug' => 'editor',
                'en' => 'Editor',
                'ru' => 'Редактор'
            ],
            [
                'slug' => 'subscriber',
                'ru' => 'Подписчик',
                'en' => 'Subscriber',
            ],
            [
                'slug' => 'driver',
                'ru' => 'Перевозчик',
                'en' => 'Driver',
            ],
            [
                'slug' => 'customer',
                'ru' => 'Заказчик',
                'en' => 'Customer',
            ],
        ]);
    }
}
