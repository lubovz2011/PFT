<?php

use Illuminate\Database\Seeder;

/**
 * Class CurrenciesRates
 * This seed insert currency rates into the rates table in DB
 */
class CurrenciesRates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('rates')
            ->insert([
                [ "from"=>"USD", "to"=>"EUR", "rate"=> 0.8484   ],
                [ "from"=>"USD", "to"=>"JPY", "rate"=> 105.9658 ],
                [ "from"=>"USD", "to"=>"ILS", "rate"=> 3.4107   ],
                [ "from"=>"USD", "to"=>"GBP", "rate"=> 0.7657   ],
                [ "from"=>"EUR", "to"=>"USD", "rate"=> 1.1785   ],
                [ "from"=>"EUR", "to"=>"JPY", "rate"=> 124.8897 ],
                [ "from"=>"EUR", "to"=>"ILS", "rate"=> 4.0198   ],
                [ "from"=>"EUR", "to"=>"GBP", "rate"=> 0.9025   ],
                [ "from"=>"ILS", "to"=>"EUR", "rate"=> 0.2487   ],
                [ "from"=>"ILS", "to"=>"JPY", "rate"=> 31.0684  ],
                [ "from"=>"ILS", "to"=>"USD", "rate"=> 0.2931   ],
                [ "from"=>"ILS", "to"=>"GBP", "rate"=> 0.2245   ],
                [ "from"=>"GBP", "to"=>"EUR", "rate"=> 1.1078   ],
                [ "from"=>"GBP", "to"=>"JPY", "rate"=> 138.3808 ],
                [ "from"=>"GBP", "to"=>"ILS", "rate"=> 4.4537   ],
                [ "from"=>"GBP", "to"=>"USD", "rate"=> 1.3058   ],
                [ "from"=>"JPY", "to"=>"EUR", "rate"=> 0.008    ],
                [ "from"=>"JPY", "to"=>"USD", "rate"=> 0.0094   ],
                [ "from"=>"JPY", "to"=>"ILS", "rate"=> 0.0321   ],
                [ "from"=>"JPY", "to"=>"GBP", "rate"=> 0.0072   ]
            ]);
    }
}
