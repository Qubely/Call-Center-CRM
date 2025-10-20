<?php

namespace App\Repositories\Admin\Agent\Application\Crud\Modal\ManageAgentDoc;

use Illuminate\Http\JsonResponse;

interface IManageAgentDocRepository
{
    public function display($request) : array;
    public function store($request) : JsonResponse;
    public function delete($request) : JsonResponse;

}
