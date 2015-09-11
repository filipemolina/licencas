<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$nomes = [ 'João', 'Carlos', 'Alberto', 'Leonardo', 'Donatelo', 'Miquelângelo', 'Rafael', 'Adriano', 'Otávio' ];

    	$i = 0;

    	foreach($nomes as $nome)
    	{
    		DB::table('users')->insert([

    			'name' = $nomes[$i],
    			'email' = str_random(10)."@gmail.com",
    			'password' = bcrypt('secret'),

        	]);

        	$i++;
    	}
    }
}
