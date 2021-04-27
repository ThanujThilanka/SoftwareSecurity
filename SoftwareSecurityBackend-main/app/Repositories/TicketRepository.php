<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

class TicketRepository extends BaseRepository
{
    public function __construct()
    {
    }

    public function json()
    {

        $json = Storage::disk('local')->get('JsonStore/tickets.json');
        $json = json_decode($json, true);
        return response()->json($json);

    }

    public function searchByOrganizationId($id)
    {
        $json = Storage::disk('local')->get('JsonStore/tickets.json');
        $data = json_decode($json, true);

        $datas = array_filter($data);

        $data = collect($datas)->where('organization_id', $id);

        return response()->json($data);


    }

    public function search($subject)
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

        $data_ticket_assignee_id = collect($datas)->where('subject', $subject)->pluck('assignee_id');
        $data_ticket_submitter_id = collect($datas)->where('subject', $subject)->pluck('submitter_id');
        $data_organization_id = collect($datas)->where('subject', $subject)->pluck('organization_id');

        $data_user_assignee_id = collect($data_users)->where('_id', $data_ticket_assignee_id->first())->pluck('name');
        $data_user_submitter_id = collect($data_users)->where('_id', $data_ticket_submitter_id->first())->pluck('name');


        $data_user_organization = collect($data_organizations)->where('_id', $data_organization_id->first())->pluck('name');

        $value = array(

            $data_user_assignee_id->all(),
            $data_user_submitter_id->all(),
            $data_user_organization->all()
        );

        return response()->json($value);
    }
}
