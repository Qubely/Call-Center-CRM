<?php

namespace App\Http\Controllers\Admin\DataLibrary\Country\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Country\Crud\ValidateStoreLibCountry;
use App\Repositories\Admin\DataLibrary\Country\Crud\ILibCountryCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibCountryCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibCountryCrudRepository $iLibCountryCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.country.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libcountry crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibCountryCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.country.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libcountry crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibCountryCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorelibcountry $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibCountry $request): JsonResponse
    {
        return $this->iLibCountryCrudRepo->store($request);
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
        $data = $this->iLibCountryCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.country.crud.index', compact('data'));
    }

    /**
     * Update procedure for libcountry
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibCountryCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibCountryCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibCountryCrudRepo->updateList($request);
    }

}
