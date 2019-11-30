<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Comando Artisan: "php artisan make:controller ClientsController --resource"
 * Cria os métodos a flag --resource
 * Essa forma de criar classe com flag acima é chamado de Controller Resource
 */
class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clientType = Client::getClientType($request->client_type);
        return view('admin.clients.create', ['client' => new Client(), 'clientType' => $clientType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->_validate($request);
        $data['defaulter']   = $request->has('defaulter');
        $data['client_type'] = Client::getClientType($request->client_type);
        Client::create($data);
        // return redirect()->to('/admin/clients'); // Tem o mesmo resultado com código abaixo
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  object  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     * * Parâmetros foi modificado, onde:
     * 1º Request para validar
     * 2º Type Hint precisa ter o mesmo nome como no URI(ver isso com "php artisan route:list")
     * dessa forma Laravel faz a busca no DB e verifica se existe, caso não existir irá redirecionar
     * uma page 404. Essa forma de passar a instância de acordo com o nome da URI é chamado de 
     * Route Model Binding Implicit
     *
     * @param  object  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        // Caso retirar o Type Hint no parâmetro, deve-se usar a linha abaixo e terá o mesmo efeito
        // $client = Client::findOrFail($client);
        $clientType = $client->client_type;
        return view('admin.clients.edit', compact('client', 'clientType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  object  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client) // Route Model Binding Implicit
    {
        $client = Client::find($client->id);
        $data = $this->_validate($request);
        $data['defaulter'] = $request->has('defaulter');
        $client->fill($data);
        $client->save();
        // return redirect()->to('/admin/clients'); // Tem o mesmo resultado com código abaixo
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
    
    protected function _validate(Request $request)
    {
        $clientType = Client::getClientType($request->client_type);
        $documentNumberType = $clientType == Client::TYPE_INDIVIDUAL ? 'cpf' : 'cnpj';
        $client = $request->route('client');
        $clientId = $client instanceof Client ? $client->id : null;
        $rules = [
            'name'                => 'required|max:255',
            'document_number'     => "required|unique:clients,document_number,$clientId|document_number:$documentNumberType",
            'email'               => 'required|email',
            'phone'               => 'required'
        ];
        $maritalStatus = implode(',', array_keys(Client::MARITAL_STATUS));
        $rulesIndividual = [
            'date_birth'          => 'required|date',
            'marital_status'      => "required|in:$maritalStatus",
            'sex'                 => 'required|in:m,f',
            'physical_desability' => 'max:255'
        ];
        $rulesLegal = [
            'company_name'        => 'required|max:255'
        ];
        return $this->validate(
            $request,
            $clientType == Client::TYPE_INDIVIDUAL ? ($rules + $rulesIndividual) : ($rules + $rulesLegal)
        );
    }
}
