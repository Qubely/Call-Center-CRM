<?php

namespace App\Traits\PxTraits\Policies\Items;

trait CampaignPolicyTrait {

    public function campaignPolicy(){
        return [
            'name' => 'Data Library',
            'policies' => [
                [
                    'name' => 'Campaign Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ]
            ]

        ];
    }
}
