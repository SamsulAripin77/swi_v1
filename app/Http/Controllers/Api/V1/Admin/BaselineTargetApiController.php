<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBaselineTargetRequest;
use App\Http\Requests\UpdateBaselineTargetRequest;
use App\Http\Resources\Admin\BaselineTargetResource;
use App\Models\BaselineTarget;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BaselineTargetApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('baseline_target_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BaselineTargetResource(BaselineTarget::with(['nama_user', 'jenis_plastiks'])->get());
    }

    public function store(StoreBaselineTargetRequest $request)
    {
        $baselineTarget = BaselineTarget::create($request->all());
        $baselineTarget->jenis_plastiks()->sync($request->input('jenis_plastiks', []));

        return (new BaselineTargetResource($baselineTarget))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BaselineTarget $baselineTarget)
    {
        abort_if(Gate::denies('baseline_target_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BaselineTargetResource($baselineTarget->load(['nama_user', 'jenis_plastiks']));
    }

    public function update(UpdateBaselineTargetRequest $request, BaselineTarget $baselineTarget)
    {
        $baselineTarget->update($request->all());
        $baselineTarget->jenis_plastiks()->sync($request->input('jenis_plastiks', []));

        return (new BaselineTargetResource($baselineTarget))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BaselineTarget $baselineTarget)
    {
        abort_if(Gate::denies('baseline_target_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baselineTarget->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
