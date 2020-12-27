var proto = window.location.protocol;
var host  = window.location.host;
var ajax_url = proto+"//"+host+"/xlow/admin/";
var name_regex = /^[A-Z,a-z ]+$/;
var email_regex = /^.{1,}@.{2,}\..{2,}/;
var contact_no_regex = /^[\+\d]?(?:[\d-.\s()]*)$/;  /*contact no have spaces and symbols*/

$.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Please enter in proper format"
);

$.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
});

$.validator.addMethod("nospace", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
});

$.validator.addMethod('empty_location', 
    function (value, element, param) {
    if($('#search_latitude').val()=='' || $('#search_longitude').val()=='' || $('#search_latitude').val()==null || $('#search_longitude').val()==null){
        return false;
    }else{
        return true;
    }
}, 'Please enter valid location');

$.validator.addMethod('interest_location', 
    function (value, element, param) {
    if($('#interest_latitude').val()=='' || $('#interest_longitude').val()=='' || $('#interest_latitude').val()==null || $('#interest_longitude').val()==null){
        return false;
    }else{
        return true;
    }
}, 'Please enter valid location');



