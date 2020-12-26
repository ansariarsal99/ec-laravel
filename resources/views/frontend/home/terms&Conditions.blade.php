@extends('frontend.layout.layout')
@section('title','Terms & Conditions')
@section('content')


<style>
.terms_info p{
    color: #6c6c6c;
    }
</style>


  <div class="wrapper_shala">
            
            <section class="signuP_sec">
                <div class="custom_container">
                  
                    <div class="wrap_terms-condtns">
                        <div class="row">
                            <div class="col-md-12">  
                                <div class="terms_poliies">
                                    <div class="terms_info">
                                        <h3 class="mb-3">{{@$terms_condition['title']}}</h3>
                                        
                                    </div>
                                    <!-- <div class="terms_info"> -->
                                        <p>{!! @$terms_condition['description'] !!}</p>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
             
                </div>
            </section>

        </div>
 
        
           
@stop
@section('script')
@stop