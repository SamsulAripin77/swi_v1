<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\JenisPlastik;
use App\Models\JenisUsaha;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $authorize = Gate::inspect('super-admin');
        $users = User::with(['jenis_usahas', 'jenis_plastiks', 'roles', 'media'])->whereHas('roles', function (Builder $query){ $query->where('title','!=','Super Admin');})->paginate(10);

        if ($authorize->allowed()){
            $users = User::with(['jenis_usahas', 'jenis_plastiks', 'roles', 'media'])->paginate(10);
        };


        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isPabrik = Gate::inspect('pabrikan-only');


        if ($isPabrik->allowed()) {
            $nama_plastiks = JenisPlastik::where('nama_plastik', '=', 'produk hasil olahan')->pluck('nama_plastik', 'id');
        }

        $nama_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id');

        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');

        $roles = Role::where('title','!=','Super Admin')->pluck('title', 'id');

        return view('admin.users.create', compact('nama_usahas', 'jenis_plastiks', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create(['kode' => $this->kode_user($request)] + $request->all());
        $user->jenis_usahas()->sync($request->input('nama_usaha_id', []));
        $user->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $user->roles()->sync($request->input('roles', []));
        foreach ($request->input('file_lampiran', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_lampiran');
        }

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id');

        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');

        $roles = Role::where('title','!=','Super Admin')->pluck('title', 'id');
        $auth = Gate::inspect('super-admin');
        if($auth->allowed()){
            $roles = Role::all()->pluck('title', 'id');
        }

        $user->load('jenis_usahas', 'jenis_plastiks', 'roles');
        
        $admin = Gate::inspect('admin-only');
        if ($user->id === Auth::id() || $admin->allowed()){
            return view('admin.users.edit', compact('nama_usahas', 'jenis_plastiks', 'roles', 'user'));
        }
        abort(404);

    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $admin = Gate::inspect('admin-only');
        if ($user->id === Auth::id() || $admin->allowed()){
            $user->update($request->all());
        }
        else 
        {
            abort(400);
        }
        if($admin->allowed()){
            $user->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        }
        $user->jenis_usahas()->sync($request->input('nama_usaha_id', []));
        $user->roles()->sync($request->input('roles', []));
        if (count($user->file_lampiran) > 0) {
            foreach ($user->file_lampiran as $media) {
                if (!in_array($media->file_name, $request->input('file_lampiran', []))) {
                    $media->delete();
                }
            }
        }
        $media = $user->file_lampiran->pluck('file_name')->toArray();
        foreach ($request->input('file_lampiran', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_lampiran');
            }
        }

        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        if ($request->input('video', false)) {
            if (!$user->video || $request->input('video') !== $user->video->file_name) {
                if ($user->video) {
                    $user->video->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($user->video) {
            $user->video->delete();
        }

        return back()->with('msg', 'Profile User Berhasi Dirubah');
    }

    public function show(User $user)
    {
        // abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $user->load('jenis_usahas', 'jenis_plastiks', 'roles', 'userUserAlerts');
        $admin = Gate::inspect('admin-only');
        if ($user->id === Auth::id() || $admin->allowed()){
            return view('admin.users.show', compact('user'));
        }
        // return $user->id;
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    private function kode_user($request)
    {
        $usaha_array = $request->input('nama_usaha_id', []);
        $usaha = JenisUsaha::findOrFail($usaha_array[0]);
        $last_id = User::latest()->first()->id + 1;
        $kode_user = $usaha->kode . $last_id;
        return $kode_user;
    }

    public function dependendDropdown(Request $request)
    {
        $param = $request->input('usahas');
        $plastiks = JenisPlastik::where('nama_plastik', '!=', 'produk hasil olahan')->get();
        $usahas = JenisUsaha::whereIn('id', $param)->where('nama_usaha', 'pabrikan')->count();
        if ($usahas > 0) {
            $plastiks = JenisPlastik::where('nama_plastik', '=', 'produk hasil olahan')->get();
        }
        return response()->json($plastiks);
    }
    
}
