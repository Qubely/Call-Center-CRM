<?php

namespace App\Traits\PxTraits\Policies\Items;

trait CompanyPolicyTrait {

    public function companyPolicy(){
        return [
            'name' => 'Company Core',
            'policies' => [
                [
                    'name' => 'Company Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ]
            ]
        ];
    }
}
