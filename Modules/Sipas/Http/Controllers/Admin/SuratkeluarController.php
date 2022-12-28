<?php

namespace Modules\Sipas\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\Sipas\Http\Controllers\SipasController;
use Modules\Sipas\Http\Requests\Admin\SuratkeluarRequest;

use Modules\Sipas\Repositories\Admin\Interfaces\SuratkeluarRepositoryInterface;
use Modules\Sipas\Repositories\Admin\Interfaces\UnitRepositoryInterface;

use App\Authorizable;

class SuratkeluarController extends SipasController
{
    use Authorizable;

    private $suratkeluarRepository,
        $unitRepository;

    public function __construct(
        SuratkeluarRepositoryInterface $suratkeluarRepository,
        UnitRepositoryInterface $unitRepository
    ) {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'suratkeluar';

        $this->suratkeluarRepository = $suratkeluarRepository;
        $this->unitRepository = $unitRepository;

        $kategory = collect(
            [
                '' => '-- Pilih Kategori --',
                'HK' => 'Hukum',
                'KU' => 'Keuangan',
                'LG' => 'Logistik',
                'PR' => 'Public Relation',
                'LP' => 'Pengolahan Data & Pelaporan',
                'PD' => 'Pendidikan & Pelatihan',
                'PS' => 'Personalia',
                'UM' => 'Umum',
                'LB' => 'Penelitian & Pengembangan',
                'PW' => 'Pengawasan'
            ]
        );

        $this->data['kategori'] = $kategory;
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
        $this->data['suratkeluars'] = $this->suratkeluarRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('sipas::admin.suratkeluar.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['unit_by_userId'] = $this->unitRepository->findByUserId();
        $this->data['unit'] = $this->unitRepository->findAll()->pluck('unit', 'id');
        $this->data['unit_id'] = null;

        return view('sipas::admin.suratkeluar.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SuratkeluarRequest $request)
    {
        $params = $request->validated();

        if ($this->suratkeluarRepository->create($params)) {
            return redirect('admin/sipas/suratkeluar')
                ->with('success', 'Surat Keluar has been created');
        }
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
        $this->data['suratkeluar'] = $this->suratkeluarRepository->findById($id);
        $this->data['unit'] = $this->unitRepository->findAll()->pluck('unit', 'id');
        $this->data['unit_id'] = null;

        return view('sipas::admin.suratkeluar.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SuratkeluarRequest $request, $id)
    {
        $params = $request->validated();
        $suratkeluar = $this->suratkeluarRepository->findById($id);

        if ($this->suratkeluarRepository->update($id, $params)) {
            return redirect('admin/sipas/suratkeluar')
                ->with('success', 'Surat Keluar has been Updated');
        }

        return redirect('admin/sipas/suratkeluar/' . $id . '/edit')
            ->with('error', 'Could not update the Surat Keluar');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        if ($this->suratkeluarRepository->delete($id)) {
            return redirect('admin/sipas/suratkeluar')
                ->with('success', 'Surat Keluar has been deleted.');
        }

        return redirect('admin/sipas/suratkeluar')->with('error', 'Could not delete the Anggaran.');
    }
}
