<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

class OrganizationRepository extends BaseRepository
{
    public function __construct()
    {
    }

    public function json()
    {

        $path = storage_path() . "/app/JsonStore/organizations.json";

        $json = json_decode(file_get_contents($path), true);

        return response()->json($json);

    }

    public function searchByOrganizationId($id)
    {
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

    }

    public function search($id)
    {
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
    }
}
