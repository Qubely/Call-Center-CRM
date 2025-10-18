<?php

namespace App\Traits\PxTraits\Policies\Items;

trait CenterPolicyTrait {

    public function centerPOlicy(){
        return [
            'name' => 'Center Management',
            'policies' => [
                [
                    'name' => 'Center Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ]
            ]

        ];
    }
}
