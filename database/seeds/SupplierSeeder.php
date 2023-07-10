<?php

use Illuminate\Database\Seeder;
use App\Model\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getSuppliers() as $supplier) {
            Supplier::create($supplier);
        };
    }

    
    /**
     * Gera um array de dados falsos da resource
     *
     * @return array
     */
    public function getSuppliers()
    {
        // Função para gerar um nome falso
        function generateFakeName()
        {
            $names = ['AutoPartex', 'CarTech Solutions', 'MotorMasters', 'SpeedyParts', 'ProAuto Supplies', 'GearTech Automotive', 'DriveLine Parts', 'AutoTech Direct', 'TurboForce Motors', 'Precision Auto Components'];
            return $names[array_rand($names)];
        }

        // Função para gerar um email falso
        function generateFakeEmail($name)
        {
            $domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'];
            $username = strtolower(str_replace(' ', '', $name));
            $domain = $domains[array_rand($domains)];
            return $username . '@' . $domain;
        }

        // Função para gerar um número de telefone falso (Brasil)
        function generateFakePhone()
        {
            $prefixes = ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];
            $number = '';
            for ($i = 0; $i < 8; $i++) {
                $number .= mt_rand(0, 9);
            }
            $prefix = $prefixes[array_rand($prefixes)];
            return '(' . $prefix . ') ' . substr($number, 0, 4) . '-' . substr($number, 4);
        }

        // Função para gerar um endereço falso
        function generateFakeAddress()
        {
            $streets = ['Rua A', 'Avenida B', 'Travessa C', 'Alameda D', 'Estrada E'];
            $neighborhoods = ['Centro', 'Jardim', 'Vila', 'Bairro Novo', 'Liberdade'];
            $cities = ['São Paulo', 'Rio de Janeiro', 'Belo Horizonte', 'Curitiba', 'Salvador'];
            $states = ['SP', 'RJ', 'MG', 'PR', 'BA'];

            $street = $streets[array_rand($streets)];
            $number = mt_rand(1, 100);
            $neighborhood = $neighborhoods[array_rand($neighborhoods)];
            $city = $cities[array_rand($cities)];
            $state = $states[array_rand($states)];

            return "{$street}, {$number}. {$neighborhood} - {$city}, {$state}.";
        }

        // Gerar o array de fornecedores fictícios
        $suppliers = [];

        for ($i = 0; $i < 20; $i++) {
            $name = generateFakeName();
            $email = generateFakeEmail($name);
            $phone = generateFakePhone();
            $address = generateFakeAddress();

            $supplier = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            ];

            $suppliers[] = $supplier;
        }

        return $suppliers;
    }
}
