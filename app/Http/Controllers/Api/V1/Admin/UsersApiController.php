<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['nama_usaha', 'jenis_plastiks', 'roles'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('file_lampiran', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_lampiran'))))->toMediaCollection('file_lampiran');
        }

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['nama_usaha', 'jenis_plastiks', 'roles']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('file_lampiran', false)) {
            if (!$user->file_lampiran || $request->input('file_lampiran') !== $user->file_lampiran->file_name) {
                if ($user->file_lampiran) {
                    $user->file_lampiran->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_lampiran'))))->toMediaCollection('file_lampiran');
            }
        } elseif ($user->file_lampiran) {
            $user->file_lampiran->delete();
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

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
