<?php

use Illuminate\Database\Seeder;
use App\Coupon;

class coupontableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            [
                'id' => 1,
                'code' => 'FREESHIP15',
                'coupon_type' => 'fixed',
                'coupon_amount' => '15',
                'description' => 'Free shiping 15k',
                'expiry' => '2022-01-15'
            ],
            [
            'id' => 2,
            'code' => 'COVID5',
            'coupon_type' => 'percentage',
            'coupon_amount' => '5',
            'description' => 'Giảm giá 5% tổng giá trị đơn hàng',
            'expiry' => '2022-08-22'
            ]
        ];
        Coupon::insert($insert);
    }
}
