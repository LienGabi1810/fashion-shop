<?php
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


function showErrors($errors,$name){
    if($errors->has($name)){
        echo '<div class="alert alert-danger" role="alert">';
        echo '<strong>'.$errors->first($name).'</strong>';
        echo '</div>';
    }
}

//hàm lấy danh mục category
function getCategory($mang,$parent,$shift,$selected){
	foreach($mang as $row){
		if($row['parent_id']==$parent){
            if ($row['id']==$selected) {
                echo '<option selected value="'.$row['id'].'">'.$shift.$row['name'].'</option>';
            }
			echo '<option value="'.$row['id'].'">'.$shift.$row['name'].'</option>';

		getCategory($mang,$row['id'],$shift.'--|',$selected);
		}
	}
}


//hàm showcategory  
function showCategory($mang,$parent,$shift){
	foreach($mang as $row){
		if($row['parent_id']==$parent){
			echo '<div class="item-menu fl"  style="display:flex;justify-content:space-between;margin-bottom: 15px">
                    <div><span style="padding-bottom:20px;">'.$shift.$row['name'].'</span></div>
                    <div class="category-fix">
                    <a class="btn-category btn-primary" href="/admin/category/category-edit/'.$row['id'].'"><i class="fa fa-edit"></i></a>
                    <a style="margin-left: 10px; margin-right:10px" onclick="return del()" class="btn-category btn-danger" href="/admin/category/category-delete/'.$row['id'].'"><i class="fas fa-times" ></i></i></a>
                    </div>
                </div>';

		showCategory($mang,$row['id'],$shift.'--|');
		}
	}
}