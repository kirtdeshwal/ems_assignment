<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'id' => 1,
                'name' => 'Stripe',
                'type' => 'Traditional',
                'website' => 'https://stripe.com/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'Pay.com',
                'type' => 'Traditional',
                'website' => 'https://pay.com/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => 'Apcopay',
                'type' => 'Traditional',
                'website' => 'https://www.apcopay.com/home',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'name' => 'HiPay',
                'type' => 'Traditional',
                'website' => 'https://hipay.com/en/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'name' => 'BPPay',
                'type' => 'Traditional',
                'website' => 'https://www.bpay.com.au/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'name' => 'CryptoPay',
                'type' => 'Crypto',
                'website' => 'https://cryptopay.me/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
