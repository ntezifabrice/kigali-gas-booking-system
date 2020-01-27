<?php

namespace App\Http\Controllers;

use App\Mail\NotifyAgentIfCylinderBooked;
use App\Mail\NotifyConsumerIfBookingAccepted;
use App\Transaction;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;

class VoyagerTransactionController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    //
    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $data_status = $data->status;
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);
        if($data_status=='Pending' && $request->status == 'Active'){
            Mail::to($data->user)->queue(new NotifyConsumerIfBookingAccepted(Transaction::find($data->id)));
            Mail::to($data->cylinder->user)->queue(new NotifyAgentIfCylinderBooked(Transaction::find($data->id)));
        }
        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', $model)) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }
}
