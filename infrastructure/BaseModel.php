<?php


namespace Infrastructure;


use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseModel extends Model
{
    public function apiListPresenterWithPagination(TransformerAbstract $transformer)
    {
        $rs = [];
        $page = request()->has('page') ? (int)request()->input('page') : 1;
        $length = request()->has('length') ? (int)request()->input('length') : 10;
        $offset = ($page - 1) * $length;

        $copyModel = clone $this;
        $totalRecord = $copyModel->count();
        $totalPage = ceil($totalRecord / $length);

        $data = $this->offset($offset)->limit($length)->get();

        $data = listPresenter($data, $transformer);

        $rs['page'] = $page;
        $rs['total_record'] = $totalRecord;
        $rs['total_page'] = $totalPage;
        $rs['data'] = isset($data) && isset($data['data']) ? $data['data'] : [];
        return $rs;
    }
}
