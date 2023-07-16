<?php

use Illuminate\Database\Seeder;
use App\Model\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getEmployees() as $employee) {
            Employee::create($employee);
        };
    }


    /**
     * Gera um array de dados falsos da resource
     *
     * @return array
     */
    public function getEmployees()
    {
        // Função para gerar um nome falso
        function generateFakeName()
        {
            $names = [
                "Ana", "Pedro", "Marina", "Lucas", "Isabella", "Gabriel", "Manuela",
                "Matheus", "Sofia", "Miguel", "Laura", "Enzo", "Beatriz", "Alice",
                "Davi", "Giovanna", "João", "Maria", "Leonardo"
            ];
            $surnames = [
                "Silva", "Santos", "Oliveira", "Souza", "Rodrigues", "Ferreira", "Alves",
                "Pereira", "Gomes", "Lima", "Costa", "Ribeiro", "Martins", "Carvalho",
                "Rocha",  "Melo", "Cardoso", "Nascimento", "Cavalcanti", "Barbosa"
            ];
            
            return "{$names[array_rand($names)]} {$surnames[array_rand($surnames)]} {$surnames[array_rand($surnames)]}";
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
        

        // Gerar o array de functionários fictícios
        $employees = [];

        for ($i = 0; $i < 7; $i++) {
            $employee = [
                'name' => $name = generateFakeName(),
                'email' => generateFakeEmail($name),
                'phone' => generateFakePhone(),
                'address' => generateFakeAddress(),
                'rg' => str_pad(rand(1, 9999999), 7, "0", STR_PAD_LEFT),
                'salary' => rand(2800, 6500),
                'joining_date' => date('d/m/Y', strtotime('-' . rand(1, 1000) . ' days')),
            ];

            $employees[] = $employee;
        }

        return $employees;
    }
}
