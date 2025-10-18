<?php

namespace App\Traits\PxTraits\Policies\Items;

trait AgentPolicyTrait {

    public function agentPolicy(){
        return [
            'name' => 'Agent Management',
            'policies' => [
                [
                    'name' => 'Agent Application Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ]
            ]

        ];
    }
}
