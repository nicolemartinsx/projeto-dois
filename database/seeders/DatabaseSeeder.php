<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'role' => 'admin'
        ]);

        Professor::factory()->createMany([
            ['name' => 'Adriana Aparecida Guimaraes', 'email' => 'adriana@utfpr.edu.br'],
            ['name' => 'Ana Maria Bueno', 'email' => 'anam@utfpr.edu.br'],
            ['name' => 'Ana Paula Milanez', 'email' => 'apmilanez@utfpr.edu.br'],
            ['name' => 'Antonio Augusto De Paula Xavier', 'email' => 'augustox@utfpr.edu.br'],
            ['name' => 'Ariel Orlei Michaloski', 'email' => 'ariel@utfpr.edu.br'],
            ['name' => 'Augusto Foronda', 'email' => 'foronda@utfpr.edu.br'],
            ['name' => 'Carla Cristiane Sokulski', 'email' => 'carlac@utfpr.edu.br'],
            ['name' => 'Cristiane Galvao Fidelis', 'email' => 'fidelis@utfpr.edu.br'],
            ['name' => 'Cristiane Toniolo Dias', 'email' => 'cristianetdias@utfpr.edu.br'],
            ['name' => 'Daniel Poletto Tesser', 'email' => 'danieltesser@utfpr.edu.br'],
            ['name' => 'David Alexander Chipana Mollinedo', 'email' => 'davida@utfpr.edu.br'],
            ['name' => 'Diego Roberto Antunes', 'email' => 'drantunes@utfpr.edu.br'],
            ['name' => 'Edilson Giffhorn', 'email' => 'edilsongiffhorn@utfpr.edu.br'],
            ['name' => 'Ednei Felix Reis', 'email' => 'edneif@utfpr.edu.br'],
            ['name' => 'Edson Jacinski', 'email' => 'ejacinski@utfpr.edu.br'],
            ['name' => 'Eliana Claudia Mayumi Ishikawa', 'email' => 'eishikawa@utfpr.edu.br'],
            ['name' => 'Eloiza Aparecida Silva Avila De Matos', 'email' => 'elomatos@utfpr.edu.br'],
            ['name' => 'Everton Luiz De Melo', 'email' => 'evertonmelo@utfpr.edu.br'],
            ['name' => 'Fabio Jose Ceron Branco', 'email' => 'fbranco@utfpr.edu.br'],
            ['name' => 'Fabio Neves Puglieri', 'email' => 'puglieri@utfpr.edu.br'],
            ['name' => 'Fernanda Tavares Treinta', 'email' => 'fernandatreinta@utfpr.edu.br'],
            ['name' => 'Flavio Madalosso Vieira', 'email' => 'flaviovieira@utfpr.edu.br'],
            ['name' => 'Geraldo Ranthum', 'email' => 'granthum@utfpr.edu.br'],
            ['name' => 'Helyane Bronoski Borges', 'email' => 'helyane@utfpr.edu.br'],
            ['name' => 'Hercules Alves De Oliveira Junior', 'email' => 'hercules@utfpr.edu.br'],
            ['name' => 'Iara Da Cunha Ribeiro Da Silva', 'email' => 'iarasilva@utfpr.edu.br'],
            ['name' => 'Jose Alves De Faria Filho', 'email' => 'faria@utfpr.edu.br'],
            ['name' => 'Joseane Pontes', 'email' => 'joseane@utfpr.edu.br'],
            ['name' => 'Juan Carlos Claros Garcia', 'email' => 'jcgarcia@utfpr.edu.br'],
            ['name' => 'Katya Cristina De Lima Picanco', 'email' => 'katyapicanco@utfpr.edu.br'],
            ['name' => 'Lourival Aparecido De Gois', 'email' => 'gois@utfpr.edu.br'],
            ['name' => 'Luiz Andre Brito Coelho', 'email' => 'lacoelho@utfpr.edu.br'],
            ['name' => 'Luiz Rafael Schmitke', 'email' => 'luizr@utfpr.edu.br'],
            ['name' => 'Marcia De Andrade Pereira Bernardinis', 'email' => 'marciabernardinis@utfpr.edu.br'],
            ['name' => 'Marcos Cesar Verges', 'email' => 'mcverges@utfpr.edu.br'],
            ['name' => 'Marcos Tadeu Andrade Cordeiro', 'email' => 'marcoscordeiro@utfpr.edu.br'],
            ['name' => 'Maria Claudia Aguitoni', 'email' => 'mcaguitoni@utfpr.edu.br'],
            ['name' => 'Nelson Ari Canabarro De Oliveira', 'email' => 'canabarro@utfpr.edu.br'],
            ['name' => 'Nilceia Aparecida Maciel Pinheiro', 'email' => 'nilceia@utfpr.edu.br'],
            ['name' => 'Rafael Ribaski Borges', 'email' => 'rafaelrborges@utfpr.edu.br'],
            ['name' => 'Regina Negri Pagani', 'email' => 'reginapagani@utfpr.edu.br'],
            ['name' => 'Reginaldo De Oliveira', 'email' => 'reoliveira@utfpr.edu.br'],
            ['name' => 'Richard Duarte Ribeiro', 'email' => 'richardribeiro@utfpr.edu.br'],
            ['name' => 'Rogerio Ranthum', 'email' => 'ranthum@utfpr.edu.br'],
            ['name' => 'Rui Tadashi Yoshino', 'email' => 'ruiyoshino@utfpr.edu.br'],
            ['name' => 'Sani De Carvalho Rutz Da Silva', 'email' => 'sani@utfpr.edu.br']
        ]);
    }
}
