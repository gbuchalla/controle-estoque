<?php

use Illuminate\Database\Seeder;
use App\Model\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getCustomers() as $customer) {
            Customer::create($customer);
        };
    }


    /**
     * Gera um array de dados falsos da resource
     *
     * @return array
     */
    public function getCustomers()
    {
        $name = array(
            "João Pedro",
            "Isabella",
            "Felipe",
            "Renata",
            "Matheus",
            "Thiago",
            "Bruna",
            "João Paulo",
            "Maria Fernanda",
            "Antonio"
        );

        $email = array(
            "joepedro@hotmail.com",
            "isabella@gmail.com",
            "felipe@hotmail.com",
            "renata@gmail.com",
            "matheus@hotmail.com",
            "thiago@hotmail.com",
            "bruna@gmail.com",
            "joao@gmail.com",
            "maria@hotmail.com",
            "antonio@hotmail.com"
        );

        $phone = array(
            "12345678",
            "987654321",
            "111234567",
            "222345678",
            "333456789",
            "444567890",
            "555678901",
            "666789012",
            "777890123",
            "919191919"
        );

        $address = array(
            "Rua São José, 123. Bairro São João - Rio de Janeiro, RJ - CEP 22250-000",
            "Rua Conselheiro Rodrigues, 156. Bairro Bonsucesso - Rio de Janeiro, RJ - CEP 22251-000",
            "Rua Paulo Viana, 256. Bairro São Carlos - Rio de Janeiro, RJ - CEP 22253-000",
            "Rua Marquês de São Vicente, 125. Bairro Bexiga - São Paulo, SP - CEP 01246-000",
            "Rua Paulo Viana, 301. Bairro São Carlos - Rio de Janeiro, RJ - CEP 22253-000",
            "Rua Direita, 222, Bairro São Lucas - São Paulo, SP - CEP 01040-000",
            "Rua Paulo Viana, 401. Bairro São Carlos - Rio de Janeiro, RJ - CEP 22253-000",
            "Rua São João, 123. Bairro São João - Rio de Janeiro, RJ - CEP 22250-000",
            "Rua Conselheiro Rodrigues, 567. Bairro Bonsucesso - Rio de Janeiro, RJ - CEP 22251-000",
            "Rua Carlos de Almeida, 98. Bairro Nebraska - Belo Horizonte, MG - CEP 01251-000"
        );

        $customers = [];

        for ($i = 0; $i < 10; $i++) {
            array_push($customers, [
                "name" => $name[$i],
                "email" => $email[$i],
                "phone" => $phone[$i],
                "address" => $address[$i]
            ]);
        }

        return $customers;
    }
}
