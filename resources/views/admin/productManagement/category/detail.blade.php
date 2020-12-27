

<?php  
    if (!empty($userdata['profile_image'])) {
        $imgpath= userProfileImageBasePath.'/'.$userdata['profile_image'];    
    }                                                                                        
    if(!empty($userdata['profile_image']) && file_exists($imgpath) ) { 
        // dd($imgpath);
        $admin_image = userProfileImagePath.'/'.$userdata['profile_image'];    
    }else{
        $admin_image = defaultAdminImagePath.'/no_image.png';  
        // dd($admin_image);
    }                                           
?>

@extends('admin.layout.adminLayout')
@section('title','User List')
@section('content')

 @include('admin.include.header')
    <!-- Sidebar menu-->
    @include('admin.include.sidebar')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Product Management</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Product Management</a></li>
                                <li class="active">Category Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      
    <div class="content">
        <div class="animated fadeIn">  
            <form method="post" id="termForm" action="" enctype="multipart/form-data">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title">Category Detail</strong>
                    </div>
                   <div class="row">

                       <?php 

                           if (!empty($category['category_image'])) {
                               $imgpath= adminBaseProductCategoryImgsPath.'/'.$category['category_image'];    
                               // dd($imgpath);
                           }                                                                                        
                           if(!empty($category['category_image']) && file_exists($imgpath) ) { 
                               // dd($imgpath);
                               $admin_image = adminProductCategoryImgsPath.'/'.$category['category_image'];    
                           }else{
                               $admin_image = defaultAdminImagePath.'/no_image.png';  
                               // dd($admin_image);
                           }                                           
                       ?>

                       <div class="form-group text-center">
                           <div class="text-left img_advert">
                               <div class="pos_rel pic_top">
                                   <span class="img_edtt pos_rel vw_pro_img">
                                      
                                       <img src="{{$admin_image}}" class="img-fluid user-img" id="item-img-output" value="{{$admin_image}}">

                                      
                                   </span>
                               </div>
                               <!-- <label class="note">Suggested Image size: (750 W * 140 H)</label> -->
                           </div>
                       </div>

                       <div class="col-lg-10 offset-lg-1">
                            <div class="terms_page view_prof_dash cat_detail my-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <p>{{@$category->name}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label>Description</label>
                                             <p>{{@$category->description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>               
        </div> 
    </div>      
@stop

@section('script')

@stop