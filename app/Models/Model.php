<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class Model extends BaseModel
{
//    public function animes()
//    {
//    	return $this->belongsToMany(Animes::class,'anime_tags');
//    }

    protected $filter;
    protected $filter_select = array();

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->filterHandle();
    }

    public function scopeUpdate_filter($q,$date){
        $date = array_filter_key(
            $date,$this->fillable
        );
        return $q->update($date);
    }

    public function scopeFilter($q){
        // todo:: 根据 Request 返回 where 条件
//        $this->buildFilter();
//        dd(request()->all());
        foreach (request()->all() as $key => $value){
            if (empty($value)){continue;}
            if (str_end_with($key,'_max')){
                $q = $q->where(str_remove($key,'_max'), '<',$value);
            }else if (str_end_with($key,'_min')){
                $q = $q->where(str_remove($key,'_min'), '>',$value);
            }else{
                $q = $q->where($key,$value);
            }

        }
        return $q;
    }

    static public function filterView(){
        $self = new static ;
        $table = $self->getTable();
        $self->buildFilter();
        return view('backstage.layouts.filter.filter',[
            'table'=>$table,
            'role'=>$self->filter,
            'filter'
        ]);
    }
    protected function filterHandle() {
        foreach ($this->filter as $key=>$value) {
            if (empty($value['field'])){
                unset($this->filter[$key]);
                continue;
            }
            $this->filter[$key]['name'] = Arr::get($value,'name',str_filed_ucfirst($value['field']));
            $this->filter[$key]['type'] = Arr::get($value,'type','select');
        }
    }
    public function buildFilter(){
        foreach ($this->filter as $k => $column) {
            if ($column['type'] == 'select'){
                $val = $this->distinct()->select($column['field'])->get();
                $this->filter[$k]['date'] = array_column($val->toArray(),$column['field']);
            }
        }
//        dd($this->filter);
    }


}
