<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Specialization;
use App\Service;
use App\Message;
use App\Review;
use App\Sponsorship;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class DocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $specArray = [
            'Agopuntore',
            'Allergologo',
            'Anatomopatologo',
            'Andrologo',
            'Anestesista',
            'Angiologo',
            'Audioprotesista',
            'Cardiochirurgo',
            'Cardiologo',
            'Chiropratico',
            'Chirurgo',
            // 'Chirurgo Estetico',
            // 'Chirurgo Generale',
            // 'Chirurgo Maxillo Facciale',
            // 'Chirurgo Pediatrico',
            // 'Chirurgo Plastico',
            // 'Chirurgo Toracico',
            // 'Chirurgo Vascolare',
            // 'Chirurgo Vertebrale',
            // 'Covidtest',
            // 'Dentista',
            // 'Dermatologo',
            // 'Diabetologo',
            // 'Dietista',
            // 'Dietologo',
            // 'Ematologo',
            // 'Endocrinologo',
            // 'Epatologo',
            // 'Epidemiologo',
            // 'Fisiatra',
            // 'Fisioterapista',
            // 'Gastroenterologo',
            // 'Geriatra',
            // 'Ginecologo',
            // 'Immunologo',
            // 'Infettivologo',
            // 'Internista',
            // 'Logopedista',
            // 'Massofisioterapista',
            // 'Medico Certificatore',
            // 'Medico Competente',
            // 'Medico Dello Sport',
            // 'Medico Di Base',
            // 'Medico Estetico',
            // 'Medico Genetista',
            // 'Medico Legale',
            // 'Medico Nucleare',
            // 'Nefrologo',
            // 'Neurochirurgo',
            // 'Neurologo',
            // 'Neuropsichiatra Infantile',
            // 'Nutrizionista',
            // 'Oculista',
            // 'Omeopata',
            // 'Oncologo',
            // 'Ortodontista',
            // 'Ortopedico',
            // 'Osteopata',
            // 'Ostetrica',
            // 'Otorino',
            // 'Pediatra',
            // 'Pneumologo',
            // 'Podologo',
            // 'Posturologo',
            // 'Proctologo',
            // 'Professional Counselor',
            // 'Psichiatra',
            // 'Psicologo',
            // 'Psicologo Clinico',
            // 'Psicoterapeuta',
            // 'Radiologo',
            // 'Radiologo Diagnostico',
            // 'Radioterapista',
            // 'Reumatologo',
            // 'Senologo',
            // 'Sessuologo',
            // 'Stomatologo',
            // 'Tecnico Sanitario',
            // 'Terapeuta',
            // 'Terapista Del Dolore',
            // 'Urologo',
            // 'Venereologo'
        ];

        $serArray = [
            [
                'service_type' => 'Service 1',
                'service_price' => 99.99,
                'service_address' => $faker->address(),
            ],
            [
                'service_type' => 'Service 2',
                'service_price' => 59.99,
                'service_address' => $faker->address(),
            ],
            [
                'service_type' => 'Service 3',
                'service_price' => 29.99,
                'service_address' => $faker->address(),
            ]
        ];

        $sponsArray = [
            [
                'sponsor_name' => 'Base',
                'sponsor_duration' => 24,
                'sponsor_price' => 2.99
            ],
            [
                'sponsor_name' => 'Intermedio',
                'sponsor_duration' => 72,
                'sponsor_price' => 5.99
            ],
            [
                'sponsor_name' => 'Premium',
                'sponsor_duration' => 144,
                'sponsor_price' => 9.99
            ]
        ];

        foreach ($specArray as $spec) {
            $newSpec = new Specialization();
            $newSpec->spec_name = $spec;
            $newSpec->save();
        }

        foreach ($sponsArray as $spons) {
            $newSponsor = new Sponsorship();
            $newSponsor->fill($spons);
            $newSponsor->save();
        }

        for ($i = 0; $i < rand(15, 25); $i++) {
            $newDoctor = new User();
            $newDoctor->name = $faker->firstname();
            $newDoctor->lastname = $faker->lastname();
            $newDoctor->email = $faker->email();
            $newDoctor->address = $faker->address();
            $newDoctor->password = Hash::make('paperino');
            $newDoctor->save();


            $randSpec = [];

            for ($x = 0; $x < rand(1, 2); $x++) {

                $docSpec = rand(1, count($specArray));
                if (!in_array($docSpec, $randSpec)) {
                    array_push($randSpec, $docSpec);
                }
            }

            foreach ($randSpec as $z) {
                $newDoctor->specializations()->attach($z);
            }

            for ($s = 0; $s < rand(1, count($serArray)); $s++) {
                $newService = new Service();
                $newService->fill($serArray[$s]);
                $newDoctor->services()->save($newService);
            }

            for ($m = 0; $m < rand(2, 5); $m++) {
                $newMessage = new Message();
                $newMessage->msg_name = $faker->firstname();
                $newMessage->msg_lastname = $faker->lastname();
                $newMessage->msg_email = $faker->email();
                $newMessage->msg_phone_number = '333333333';
                $newMessage->msg_content = $faker->text(144);
                $newDoctor->messages()->save($newMessage);
            }

            for ($r = 0; $r < rand(2, 5); $r++) {
                $newReview = new Review();
                $newReview->rv_vote = rand(1, 5);
                $newReview->rv_title = $faker->sentence(5);
                $newReview->rv_content = $faker->text(144);
                $newDoctor->reviews()->save($newReview);
            }

            for ($sp = 0; $sp < rand(1, 5); $sp++) {
                $newDoctor->sponsorships()->attach(rand(1, count($sponsArray)));
            }
        }
    }
}
