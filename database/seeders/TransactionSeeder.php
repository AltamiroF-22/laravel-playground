<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seleciona todos os usuários e categorias para atribuição
        $users = User::all();
        $categories = Category::all();

        // Para cada usuário, cria 10 transações aleatórias
        foreach ($users as $user) {
            for ($i = 0; $i < 50; $i++) {
                Transaction::create([
                    // 'user_id'     => $user->id,
                    'user_id'     => 1,
                    'category_id' => $categories->random()->id,
                    'amount'      => $faker->randomFloat(2, 10, 1000),
                    'date'        => Carbon::now()->subDays(rand(0, 365)),
                    'description' => $faker->sentence,
                ]);
            }
        }
    }
}