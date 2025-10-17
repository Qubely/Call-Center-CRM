<?php

namespace App\Traits\PxTraits\Policies\Items;

trait DataLibraryPolicyTrait {

    public function dataLibrayPolicies(){
        return [
            'name' => 'Data Library',
            'policies' => [
                [
                    'name' => 'Lib Country Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ]
            ]

        ];
    }
}
