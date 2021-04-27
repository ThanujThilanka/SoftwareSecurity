<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TicketService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;


class TicketController extends Controller
{
    private $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return array|Factory|View|string
     * @throws Throwable
     */
    public function index(Request $request)
    {
        try {

            $json = Storage::disk('local')->get('JsonStore/tickets.json');
            $json = json_decode($json, true);
            return response()->json($json);

//            $value = $this->service->index();
//            return $value;
        } catch (Exception $exception) {
            return response()->json([$exception]);
        }


    }

    public function searchByOrganizationId($id)
    {
        try {

            $json = Storage::disk('local')->get('JsonStore/tickets.json');
            $data = json_decode($json, true);

            $datas = array_filter($data);

            $data = collect($datas)->where('organization_id', $id);

            return response()->json($data);

//            $value = $this->service->searchByOrganizationId($id);
//            return $value;
        } catch (Exception $exception) {
            return response()->json([$exception]);
        }

    }

    public function search($subject)
    {
        try {
            $value = $this->service->search($subject);
            return $value;
        } catch (Exception $exception) {
            return response()->json([$exception]);
        }

    }

}
