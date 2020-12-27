<div class="form-group text-left">
   @if($userService=='' || $userService=='null')
      <label class="bold_text build_label">Type of Services</label>@endif
      @if(!empty($userService))
      <label class="bold_text build_label">Type of Services</label>@endif
        <div class="wrap_rad_chk">
             @foreach($userService as $val)
            
                 <div class="custom-control custom-checkbox"> 
                      <input type="checkbox" class="custom-control-input service" id="se{{$val['id']}}" name="user_service_id[]" value="{{$val['id']}}" >
                      <label class="custom-control-label" for="se{{$val['id']}}">{{$val['name']}}</label>
                  </div>
             @endforeach
             @if($userService!=null)
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input check_apnd" id="customCheck_123" value="1" name="user_other_id" >
                      <label class="custom-control-label" for="customCheck_123">Others</label>
                  </div>
                  <div class="form-group other_apnd">
                      <input type="text" name="other_name" class="form-control other_name" placeholder="Please define Others Service...">
                  </div>
             @endif     
        </div>
        <label id="user_service_id-error" class="error" for="user_service_id[]"></label>
      
        
  </div>




<script type="text/javascript">

 $(".other_apnd").hide();
        $(".check_apnd").click(function() {
            if($(this).is(":checked")) {
                $(".other_apnd").show('normal');
            } else {
                $(".other_apnd").hide('normal');

                $('input[name=other_name').val('');
            }
        });


</script>
        