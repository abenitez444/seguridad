<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Clients;
use App\Watchmen;
use App\Shifts;

class ClientsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        $this->middleware('role:list_clients')->only(['index', 'getAllWithPagination']);
        $this->middleware('role:create_client')->only(['store']);
        $this->middleware('role:edit_client')->only(['update']);
        $this->middleware('role:delete_client')->only(['destroy']);
	}

    public function index()
    {
        return view('admin.clients');
    }

    public function getAllWithPagination(Request $request)
    {
        $per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = Clients::all()->count();
        } else {
            $per_page = $request->per_page;
        }
        $clients = Clients::paginate($per_page);
        foreach ($clients as &$c) {
            if ($c->type_of_programming == 1) {
                $c->shift = $c->shift()->first();
                $selected = [];
                $c->shifts_selected = $selected;
            } else {
                $c->shift = $c->shift()->first();
                $selected = [];
                $shifts_selected = DB::table('client_has_shifts')->where('clients_id', $c->id)->get();
                foreach ($shifts_selected as $s) {
                    array_push($selected, DB::table('shifts')->where('id', $s->shifts_id)->first());
                }
                $c->shifts_selected = $selected;
            }
            
        }
        return $clients;
    }

    public function getAllActivated()
    {
        $clients = [];
        $all = Clients::where('is_active', '1')->orderBy('name', 'ASC')->get();
        foreach ($all as &$c) {
            if ($c->assignments()->count() > 0) {
                $assignment = $c->assignments()->first();
                $c->watchmen = $assignment->watchmen()->orderBy('name', 'ASC')->get();
                // $c->shift = Shifts::find($c->watchmen->pivot->shifts_id);
                foreach ($c->watchmen as &$w) {
                    $watchmen = Watchmen::find($w->id);
                    $w->assignment = $w->assignment()->get();
                    $w->shift = Shifts::find($w->pivot->shifts_id);
                }
                array_push($clients, $c);
            }
        }
        return $clients;
    }

    public function getAllClients()
    {
        $clients = [];
        $all = Clients::orderBy('name', 'ASC')->get();
        foreach ($all as &$c) {
            $c->assignments = $c->assignments()->get();
            if ($c->type_of_programming == 1) {
                $c->shift = $c->shift()->first();
                $selected = [];
                $c->shifts_selected = $selected;
            } else {
                $c->shift = $c->shift()->first();
                $selected = [];
                $shifts_selected = DB::table('client_has_shifts')->where('clients_id', $c->id)->get();
                foreach ($shifts_selected as $s) {
                    array_push($selected, DB::table('shifts')->where('id', $s->shifts_id)->first());
                }
                $c->shifts_selected = $selected;
            }
            foreach ($c->assignments as &$a) {
                $a->watchmen = $a->watchmen_activated()->get();
                foreach ($a->watchmen as &$w) {
                    $w->shift = Shifts::find($w->pivot->shifts_id);
                }
            }            
            array_push($clients, $c);
        }
        return $clients;
    }


    public function getAll()
    {
        $clients = [];
        $all = Clients::orderBy('name', 'ASC')->get();
        foreach ($all as &$c) {
            if ($c->assignments()->count() > 0) {
                $assignment = $c->assignments()->first();
                $c->watchmen = $assignment->watchmen()->orderBy('name', 'ASC')->get();
                // $c->shift = Shifts::find($c->watchmen->pivot->shifts_id);
                foreach ($c->watchmen as &$w) {
                    $watchmen = Watchmen::find($w->id);
                    $w->assignment = $w->assignment()->get();
                    $w->shift = Shifts::find($w->pivot->shifts_id);
                }
                array_push($clients, $c);
            }
        }
        return $clients;
    }

    public function getEmpty()
    {
        $clients = [];
        $all = Clients::where('is_active', '1')->orderBy('name', 'ASC')->get();
        foreach ($all as &$c) {
            if ($c->assignments()->count() == 0) {
                if ($c->type_of_programming == 1) {
                    $c->shift = $c->shift()->first();
                } else {
                    $c->shift = $c->shift()->first();
                    $selected = [];
                    $shifts_selected = DB::table('client_has_shifts')->where('clients_id', $c->id)->get();
                    foreach ($shifts_selected as $s) {
                        array_push($selected, DB::table('shifts')->where('id', $s->shifts_id)->first());
                    }
                    $c->shifts_selected = $selected;
                }
                array_push($clients, $c);
            }
        }
        return $clients;
    }

    public function getAvailableClientsByDate(Request $request)
    {
        $clients = [];
        $all = Clients::where('is_active', '1')->orderBy('name', 'ASC')->get();
        foreach ($all as &$c) {
            if ($c->assignments()->count() == 0) {
                if ($c->type_of_programming == 1) {
                    $c->shift = $c->shift()->first();
                } else {
                    $c->shift = $c->shift()->first();
                    $selected = [];
                    $shifts_selected = DB::table('client_has_shifts')->where('clients_id', $c->id)->get();
                    foreach ($shifts_selected as $s) {
                        array_push($selected, DB::table('shifts')->where('id', $s->shifts_id)->first());
                    }
                    $c->shifts_selected = $selected;
                }
                array_push($clients, $c);
            } else {
                $assignment_active = false;
                foreach ($c->assignments()->get() as $assig) {
                    if ($assig->date_end > $request->date_ini) {
                        $assignment_active = true;
                        break;
                    }
                }

                if ($assignment_active == false) {
                    if ($c->type_of_programming == 1) {
                        $c->shift = $c->shift()->first();
                    } else {
                        $c->shift = $c->shift()->first();
                        $selected = [];
                        $shifts_selected = DB::table('client_has_shifts')->where('clients_id', $c->id)->get();
                        foreach ($shifts_selected as $s) {
                            array_push($selected, DB::table('shifts')->where('id', $s->shifts_id)->first());
                        }
                        $c->shifts_selected = $selected;
                    }
                    array_push($clients, $c);
                }
            }
        }
        return $clients;
    }

    public function getNotEmptyClients()
    {
        $clients = [];
        $all = Clients::where('is_active', '1')->orderBy('name', 'ASC')->get();
        foreach ($all as &$c) {
            $c->assignments = $c->assignments()->get();
            if ($c->assignments()->count() > 0) {
                if ($c->type_of_programming == 1) {
                    $c->shift = $c->shift()->first();
                } else {
                    $c->shift = $c->shift()->first();
                    $selected = [];
                    $shifts_selected = DB::table('client_has_shifts')->where('clients_id', $c->id)->get();
                    foreach ($shifts_selected as $s) {
                        array_push($selected, DB::table('shifts')->where('id', $s->shifts_id)->first());
                    }
                    $c->shifts_selected = $selected;
                }
                array_push($clients, $c);
            }
        }
        return $clients;
    }

    public function store(Request $request)
    {
        // DB::beginTransaction();
        $client = new Clients;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->name_person = $request->name_person;
        $client->salary = $request->salary;
        $client->num_watchmen = $request->num_watchmen;
        $client->is_active = ($request->has('is_active') && ($request->is_active == 1 || $request->is_active == 'on')) ? '1' : 0;

        if ($request->type_of_programming == 1) {
            $client->type_of_programming = 1;
            $client->shifts_id = $request->shifts_id;
            $client->save();
        } else {
            $client->type_of_programming = 2;
            $client->shifts_id = null;
            $client->save();
            $shifts = [];
            foreach ($request->shifts_selected as $s) {
                array_push($shifts, ['shifts_id' => $s['id'], 'clients_id' => $client->id]);
            }
            DB::table('client_has_shifts')->insert($shifts);
        }        
        return $client;
    }

    public function update(Request $request, $id)
    {
        $client = Clients::find($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->name_person = $request->name_person;
        $client->salary = $request->salary;
        $client->num_watchmen = $request->num_watchmen;
        $client->is_active = ($request->has('is_active') && ($request->is_active == 1 || $request->is_active == 'on')) ? '1' : 0;

        if ($request->type_of_programming == 1) {
            $client->type_of_programming = 1;
            $client->shifts_id = $request->shifts_id;
            $client->update();
        } else {
            $client->type_of_programming = 2;
            $client->shifts_id = null;
            $client->update();
            $shifts = [];
            DB::table('client_has_shifts')->where('clients_id', $client->id)->delete();
            foreach ($request->shifts_selected as $s) {
                array_push($shifts, ['shifts_id' => $s['id'], 'clients_id' => $client->id]);
            }
            DB::table('client_has_shifts')->insert($shifts);
        }   
        return $client;
    }

    public function destroy(Request $request, $id)
    {
        $client = Clients::find($id);
        /*DB::table('client_has_shifts')->where('clients_id', $client->id)->delete();
        $assignment = DB::table('assignment')->where('clients_id', $client->id)->get();
        foreach ($assignment as $a) {
            DB::table('assignment_as_watchmen')->where('assignment_id', $a->id)->delete();
            DB::table('assignment')->where('id', $a->id)->delete();
        }
        $news = DB::table('news')->where('clients_id', $client->id)->get();
        foreach ($news as $n) {
            DB::table('watchmen_has_news')->where('news_id', $n->id)->delete();
            DB::table('news')->where('id', $n->id)->delete();
        }
        $client->delete();*/
        $client->is_delete = 1;
        $client->update();
        return ['sucess' => '1'];
    }
}
