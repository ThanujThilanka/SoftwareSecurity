<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
    }

    public function json()
    {

        $path = storage_path() . "/app/JsonStore/users.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);
        return response()->json($json);

    }

    public function searchByOrganizationId($id)
    {
        $path = storage_path() . "/app/JsonStore/users.json";

        $json = json_decode(file_get_contents($path), true);

        $data = array_filter($json);

        $data = collect($data)->where('organization_id', $id);

        return response()->json($data);

    }

    public function search($name)
    {
        $json_ticket = Storage::disk('local')->get('JsonStore/tickets.json');
        $json_user = Storage::disk('local')->get('JsonStore/users.json');
        $json_organization = Storage::disk('local')->get('JsonStore/organizations.json');
        $data = json_decode($json_ticket, true);
        $data_user = json_decode($json_user, true);
        $data_organization = json_decode($json_organization, true);

        $datas = array_filter($data);
        $data_users = array_filter($data_user);
        $data_organizations = array_filter($data_organization);

        $data_organization_id = collect($data_users)->where('name', $name)->pluck('organization_id');
        $data_id = collect($data_users)->where('name', $name)->pluck('_id');

        $data_ticket = collect($datas)->where('assignee_id', $data_id->first())->pluck('subject');

        $data_ticket_submitter = collect($datas)->where('submitter_id', $data_id->first())->pluck('subject');

        $data_user_organization = collect($data_users)->where('organization_id', $data_organization_id->first())->pluck('name');

        $value = array(
            $data_ticket_submitter->all(),
            $data_ticket->all(),
            $data_user_organization->all()
        );

        return response()->json($value);
    }
}
