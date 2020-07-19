<?php

use Illuminate\Database\Seeder;

class DefaultIcons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('icons')
            ->insert([
                [
                    "name"=>"No Icon",
                    "class"=>"fas fa-anchor"
                ],
                [
                    "name"=>"Ice-cream",
                    "class"=>"fas fa-ice-cream"
                ],
                [
                    "name"=>"Gas-Pump",
                    "class"=>"fas fa-gas-pump"
                ],
                [
                    "name"=>"Tools",
                    "class"=>"fas fa-tools"
                ],
                [
                    "name"=>"Book",
                    "class"=>"fas fa-book"
                ],
                [
                    "name"=>"Bus",
                    "class"=>"fas fa-bus-alt"
                ],
                [
                    "name"=>"Swimmer",
                    "class"=>"fas fa-swimmer"
                ],
                [
                    "name"=>"Umbrella Beach",
                    "class"=>"fas fa-umbrella-beach"
                ],
                [
                    "name"=>"Dumbbell",
                    "class"=>"fas fa-dumbbell"
                ],
            ]);
    }
}
