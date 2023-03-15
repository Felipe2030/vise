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
            ["nome" => "cadastrando"],
            ["nome" => "cadastrando pessoa"],
            ["nome" => "cadastrando pessoa tipo"],
            ["nome" => "cadastro concluido"]
        ];

        foreach ($status_usuarios as $key => $data) {
            DB::table('status_usuarios')->insert($data);
        }
    }
}
