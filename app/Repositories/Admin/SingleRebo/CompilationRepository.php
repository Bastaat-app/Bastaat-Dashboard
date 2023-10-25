<?php

namespace App\Repositories\Admin\SingleRebo;

//use App\Http\Requests\Admin\CityRequest;


use App\Models\Compilation;
use App\Repositories\Admin\BaseRepository;
use App\Traits\UploadAttachTrait;
use Illuminate\Http\Request;

class CompilationRepository extends BaseRepository
{
    use UploadAttachTrait;

    public function __construct()
    {
        parent::__construct(new Compilation());

    }
    public function store(Request $request = null, $data = null)
    {
        if($request->has('image')) {
            $images = ($this->upload($request->image, 'compilation'));
            unset($request->image);
        }
        // $request->image=$images;
        $request= $request->except(['_token','image']);

        if(isset($images[0]))
            $request['image']=$images[0];
       /* if ($request != null)
            $data = $this->setDataPayload($request, 'store');*/
        $item = $this->model;
        $item->fill($request);
        $item->save();
        return $item;
    }

    public function update($id, Request $request = null, $data = null)
    {

       if($request->has('image')) {
           $images = ($this->upload($request->image, 'compilation'));
           unset($request->image);
       }
        // $request->image=$images;
        $request= $request->except(['_token','image']);

        if(isset($images[0]))
            $request['image']=$images[0];

     /*   if ($request != null)
            $data = $this->setDataPayload($request, 'update');
*/
        $item = $this->model->findOrFail($id);

        $item->fill($request);
        $item->save();
        return $item;
    }




}
