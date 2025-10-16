<?php

namespace App\Http\Controllers\Admin\DataLibrary\TimeZone\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\TimeZone\Crud\ValidateStoreLibTimeZone;
use App\Repositories\Admin\DataLibrary\TimeZone\Crud\ILibTimeZoneCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibTimeZoneCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibTimeZoneCrudRepository $iLibTimeZoneCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.time-zone.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libtimezone crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibTimeZoneCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.time-zone.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libtimezone crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibTimeZoneCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorelibtimezone $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibTimeZone $request): JsonResponse
    {
        return $this->iLibTimeZoneCrudRepo->store($request);
    }

    /**
     * Index page for view
     *
     * @param integer|string $id
     * @param Request $request
     * @return view
     */
    public function edit($id,Request $request) : view
    {
        $data = $this->iLibTimeZoneCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.time-zone.crud.index', compact('data'));
    }

    /**
     * Update procedure for libtimezone
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibTimeZoneCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibTimeZoneCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibTimeZoneCrudRepo->updateList($request);
    }

}