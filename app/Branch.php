<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $guarded = [];
    public $timestamps = false;
    
    public function subBranches(){
        return $this->hasMany($this,'parent_id','id');
    }
    public function rootBranches(){
        return $this->where('parent_id',0)->get();
    }
//    public function traversing($parent_id=0){
//        global $depth;
//        if($parent_id == 0) {
//            $branches = $this->rootBranches();
//            $depth = 0;
//        }
//        else {
//            $branches = $this->where('parent_id',$parent_id)->get();
//            $depth++;
//        }
//        foreach ($branches as $branch){
//            $tmpBranch = $branch;
//            $tmpBranch['depth'] = $depth;
//            $tmpBranch['subBranches'] = $this->subBranches();
//            if(count($tmpBranch['subBranches'])>0){
//                $this->traversing($branch->id);
//            }else{
//                $branchArr[] = $tmpBranch;
//            }
//        }
//        $branchArr['totalDepth'] = $depth;
//        return $branchArr;
//    }

    /**
     * 将数据格式化成树形结构
     * @author Xuefen.Tong
     * @param array $items
     * @return array
     */
    public function getTree() {
        $arr =$this->all()->toArray();
        // 将 id 作为数组的 key
        foreach ($arr as $item){
            $items[$item['id']] = $item;
        }
//        dd($items) ;
        $tree = array(); //格式化好的树
        foreach ($items as $item)
            if (isset($items[$item['parent_id']]))
                $items[$item['parent_id']]['subBranches'][] = &$items[$item['id']];
            else
                $tree[] = &$items[$item['id']];
        return $tree;
    }
}
