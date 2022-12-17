<?php

namespace Modules\Sipas\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\Sipas\Http\Controllers\SipasController;
use Modules\Sipas\Http\Requests\Admin\WorkspaceSuratMasukRequest;

use Modules\Sipas\Repositories\Admin\Interfaces\SuratmasukRepositoryInterface;
use Modules\Sipas\Repositories\Admin\Interfaces\UnitRepositoryInterface;

use App\Authorizable;

class WorkspaceSuratMasukController extends SipasController
{
    use Authorizable;

    private $suratmasukRepository,
        $unitRepository;

    public function __construct(
        SuratmasukRepositoryInterface $suratmasukRepository,
        UnitRepositoryInterface $unitRepository
    )
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'suratmasuk';

        $this->suratmasukRepository = $suratmasukRepository;
        $this->unitRepository = $unitRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $options = [
            'per_page' => 10,
            'order' => [
                'id' => 'asc',
            ],
            'filter' => $params,
        ];
        $this->data['workspacesuratmasuks'] = $this->suratmasukRepository->findAllworkspace($options);
        $this->data['filter'] = $params;
        return view('sipas::admin.workspacesuratmasuk.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sipas::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sipas::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $this->data['workspacesuratmasuk'] = $this->suratmasukRepository->findById($id);

        $this->data['unit'] = $this->unitRepository->findAll()->pluck('unit', 'kode_unit_sap');
        $this->data['unit_id'] = null;

        return view('sipas::admin.workspacesuratmasuk.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(WorkspaceSuratMasukRequest $request, $id)
    {
        $params = $request->validated();

        if ($this->suratmasukRepository->updateworkspace($id, $params)) {
            return redirect('admin/sipas/workspace-suratmasuk')
                ->with('success', 'Surat Masuk has been Received');
        }

        return redirect('admin/sipas/workspace-suratmasuk/' . $id . '/edit')
            ->with('error', 'Could not received the Surat Masuk');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
