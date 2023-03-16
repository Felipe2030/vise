<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class status_usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_usuarios = [
            ["id" => 1,"nome" => "cadastrando"],
            ["id" => 2,"nome" => "cadastrando pessoa"],
            ["id" => 3,"nome" => "cadastrando pessoa tipo"],
            ["id" => 4,"nome" => "cadastro concluido"]
        ];

        foreach ($status_usuarios as $key => $data) {
            DB::table('status_usuarios')->insert($data);
        }
    }
}
