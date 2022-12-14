<?php

namespace Modules\Sipas\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\Sipas\Http\Controllers\SipasController;
use Modules\Sipas\Http\Requests\Admin\SuratmasukRequest;

use Modules\Sipas\Repositories\Admin\Interfaces\SuratmasukRepositoryInterface;
use Modules\Sipas\Repositories\Admin\Interfaces\UnitRepositoryInterface;

use App\Authorizable;

class SuratmasukController extends SipasController
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
//            'per_page' => $this->perPage,
            'per_page' => 10,
            'order' => [
                'id' => 'asc',
            ],
            'filter' => $params,
        ];
        $this->data['suratmasuks'] = $this->suratmasukRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('sipas::admin.suratmasuk.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['unit'] = $this->unitRepository->findAll()->pluck('unit', 'kode_unit_sap');
        $this->data['unit_id'] = null;

        return view('sipas::admin.suratmasuk.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SuratmasukRequest $request)
    {
        $params = $request->validated();

        if ($this->suratmasukRepository->create($params)) {
            return redirect('admin/sipas/suratmasuk')
                ->with('success', 'Surat Masuk has been created');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->data['suratmasuk'] = $this->suratmasukRepository->findById($id);

        return view('sipas::admin.suratmasuk.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $this->data['suratmasuk'] = $this->suratmasukRepository->findById($id);

        $this->data['unit'] = $this->unitRepository->findAll()->pluck('unit', 'kode_unit_sap');
        $this->data['unit_id'] = null;

        return view('sipas::admin.suratmasuk.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SuratmasukRequest $request, $id)
    {
        $params = $request->validated();

        if ($this->suratmasukRepository->update($id, $params)) {
            return redirect('admin/sipas/suratmasuk')
                ->with('success', 'Surat Masuk has been Updated');
        }

        return redirect('admin/sipas/suratmasuk/' . $id . '/edit')
            ->with('error', 'Could not update the Surat Masuk');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        if ($this->suratmasukRepository->delete($id)) {
            return redirect('admin/sipas/suratmasuk')
                ->with('success', 'Surat Masuk has been deleted.');
        }

        return redirect('admin/sipas/suratmasuk')->with('error', 'Could not delete the Anggaran.');
    }
}
