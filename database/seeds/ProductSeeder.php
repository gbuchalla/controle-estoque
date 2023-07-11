<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getProducts() as $product) {
            Product::create($product);
        };
    }

    
    /**
     * Gera um array de dados falsos da resource
     *
     * @return array
     */
    public function getProducts()
    {
        $productsImages = [
            
            'Jogo de roda' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096761/controle-estoque/auto-parts/jogo_de_rodas_bksbzr.png',//
            'Amortecedores Traseiros' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096760/controle-estoque/auto-parts/amortecedor_2_v8rbct.png', 
            'Amortecedores' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096759/controle-estoque/auto-parts/amortecedor_traseiro_btfxnq.webp',
            'Bateria veicular 60 Ah' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096760/controle-estoque/auto-parts/car_battery_uolb8b.png',
            'Faróis veiculares' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096760/controle-estoque/auto-parts/far%C3%B3is_veiculares_hnvhxq.png',
            'Volante' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096774/controle-estoque/auto-parts/volante_sqendg.png',
            'Kit de filtros de ar' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096760/controle-estoque/auto-parts/filtros_de_ar_amzhqs.png',
            'Kit filtros de óleo' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096761/controle-estoque/auto-parts/kit_oil_filters_pvnbg2.png',
            'Filtro de óleo' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096768/controle-estoque/auto-parts/oil_filter_dg0nqs.webp',
            'Jogo de pistão, biela, pinos e anéis' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096761/controle-estoque/auto-parts/jogo_pistao_biela_pinos_aneis_nshxh0.png',
            'Motor de partida Alfa' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096769/controle-estoque/auto-parts/motor_partida_2_lsfcn5.png',
            'Motor de partida Beta' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096769/controle-estoque/auto-parts/motor_partida_ggt0lj.png',
            'Alternador' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096760/controle-estoque/auto-parts/alternador_d9eigr.png',
            'Macaco mecânico tipo sanfona, 1 ton' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096767/controle-estoque/auto-parts/macaco_mecanico_sanfona_e4jfqi.png',
            'Macaco hidráulico tipo garrafa, 4 ton' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096768/controle-estoque/auto-parts/macaco_hidraulico_garrafa_lu3lye.png',
            'Macaco hidráulico tipo jacaré, 2 ton' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096769/controle-estoque/auto-parts/macaco_hidraulico_jacare_d8o1pw.png',
            'Lâmpada de farol incandescente H4' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096762/controle-estoque/auto-parts/l%C3%A2mpada_farol_h4_obuclf.png',
            'Limpadores de parabrisa Alfa' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096768/controle-estoque/auto-parts/limpador_parabrisa_2_wqbzn9.png',
            'Limpadores de parabrisa Beta' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096766/controle-estoque/auto-parts/limpador_parabrisa_mwfiex.png',
            'Radiador' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096769/controle-estoque/auto-parts/radiador_hgrbhk.png',
            'Silencioso escapamento' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096770/controle-estoque/auto-parts/silencioso_escapamento_xvhuuz.png',
            'Freio de disco' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096762/controle-estoque/auto-parts/freio_disco_bfmxbe.png',
            'Kit braços da suspensão' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096762/controle-estoque/auto-parts/kit_bra%C3%A7os_da_suspens%C3%A3o_i9rxlo.png',
            'Kit discos e pastilhas de freio' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096761/controle-estoque/auto-parts/kit_pastilha_disco_freio_oanxcl.png',
            'Pastilhas de freio' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096769/controle-estoque/auto-parts/pastilhas_freio_jhefvz.webp',
            'Jogo de pneus' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096769/controle-estoque/auto-parts/pneus_qyy6sm.png',
            'Jogo de velas de ignição' => 'https://res.cloudinary.com/dmxxtoux0/image/upload/v1689096773/controle-estoque/auto-parts/velas_igni%C3%A7%C3%A3o_d54wan.png',
        ];

        $products = [];
        foreach ($productsImages as $product => $image) {
            array_push($products, [
                "product_name" => $product,
                "product_code" => 'COD' . rand(1000, 9999),
                "category_id" => 1, // Id da categoria de 'Auto Peças' ou equivalente
                "product_quantity" => rand(0, 20),
                "buying_price" => $buying_price = rand(35, 250),
                "selling_price" => $buying_price +  rand(40, 80),
                "supplier_id" => rand(23, 42), // Verificar ids possiveis de acordo com query a DB ou add relacionamento
                "buying_date" =>  date('d/m/Y', strtotime('-' . rand(1, 365) . ' days')),
                "image" => $image
            ]);
        };

        return $products;
    }
}
