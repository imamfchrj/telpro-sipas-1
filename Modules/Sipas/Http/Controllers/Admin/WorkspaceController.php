<?php

namespace Modules\Sipas\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\Sipas\Http\Controllers\SipasController;
use Modules\Sipas\Http\Requests\Admin\WorkspaceRequest;

use Modules\Sipas\Repositories\Admin\Interfaces\SuratkeluarRepositoryInterface;
use Modules\Sipas\Repositories\Admin\Interfaces\UnitRepositoryInterface;

use App\Authorizable;

class WorkspaceController extends SipasController
{
    use Authorizable;

    private  $suratkeluarRepository,
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
                ''=> '-- Pilih Kategori --',
                'HK'=>'Hukum',
                'KU'=>'Keuangan',
                'LG'=>'Logistik',
                'PR'=>'Public Relation',
                'LP'=>'Pengolahan Data & Pelaporan',
                'PD'=>'Pendidikan & Pelatihan', 
                'PS'=>'Personalia', 
                'UM'=>'Umum', 
                'LB'=>'Penelitian & Pengembangan', 
                'PW'=>'Pengawasan'
                ] 
        );

        $this->data['kategori'] = $kategory;

        // dd($kategory);

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $options = [
            'per_page' => $this->perPage,
            'order' => [
                'id' => 'asc',
            ],
            'filter' => $params,
        ];
        $this->data['workspaces'] = $this->suratkeluarRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('sipas::admin.workspace.index',$this->data);
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
        return view('sipas::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
        $params = $request->all();
        $suratkeluar = $this->suratkeluarRepository->findById($id);

        if ($this->suratkeluarRepository->updateWorkspace($id, $params)) {
            return redirect('admin/sipas/workspace')
                ->with('success', 'Surat Keluar telah di terima');
        }

        return redirect('admin/sipas/workspace/' . $id . '/edit')
            ->with('error', 'Surat Keluar tidak dapat diubah');
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
