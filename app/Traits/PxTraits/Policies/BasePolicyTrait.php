<?php

namespace App\Traits\PxTraits\Policies;

use App\Traits\PxTraits\Policies\Items\CompanyPolicyTrait;
use App\Traits\PxTraits\Policies\Items\DataLibraryPolicyTrait;
use App\Traits\PxTraits\Policies\Items\SytemUserPolicyTrait;

trait BasePolicyTrait {

    use SytemUserPolicyTrait,DataLibraryPolicyTrait,CompanyPolicyTrait;
    public function systemPolicies(){
        return [
            [
                'name' => 'Admin Panel',
                'policies' => [
                    [
                        ...$this->companyPolicies()
                    ],
                    [
                        ...$this->dataLibrayPolicies()
                    ],
                    [
                        ...$this->systemUserPolicies()
                    ],

                ]
            ]
        ];
    }
}
