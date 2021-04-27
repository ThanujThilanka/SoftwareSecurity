<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrganizationService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;


class OrganizationController extends Controller
{
    private $service;

    public function __construct(OrganizationService $service)
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


            $path = storage_path() . "/app/JsonStore/organizations.json";

            $json = json_decode(file_get_contents($path), true);

            return response()->json($json);

        } catch (Exception $exception) {
            return response()->json([$exception]);
        }
    }

    public function searchByOrganizationId($id)
    {
        try {

            $json = Storage::disk('local')->get('JsonStore/tickets.json');
            $json_user = Storage::disk('local')->get('JsonStore/users.json');
            $data = json_decode($json, true);
            $data_user = json_decode($json_user, true);

            $datas = array_filter($data);
            $data_users = array_filter($data_user);

            $data_ticket = collect($datas)->where('organization_id', $id);
            $data_user = collect($data_users)->where('organization_id', $id);

            $value = array(
                $data_ticket,
                $data_user,
            );
            return response()->json($value);

        } catch (Exception $exception) {
            return response()->json([$exception]);
        }
    }

    public function search($id)
    {
        try {

            $json_ticket = Storage::disk('local')->get('JsonStore/tickets.json');
            $json_user = Storage::disk('local')->get('JsonStore/users.json');
            $data = json_decode($json_ticket, true);
            $data_user = json_decode($json_user, true);

            $datas = array_filter($data);
            $data_users = array_filter($data_user);

            $data_ticket = collect($datas)->where('organization_id', $id)->pluck('subject');

            $data_user = collect($data_users)->where('organization_id', $id)->pluck('name');

            $value = array(
                $data_ticket,
                $data_user,
            );
            return response()->json($value);

        } catch (Exception $exception) {
            return response()->json([$exception]);
        }
    }
}
