function load_my_ajax(){
  var pc = jQuery("input[name=postalcode]").val();
  jQuery.ajax({
  url: ajax_object.ajax_url,
  type: 'POST',
  data: {
      action : 'my_ajax_function',
      postalcode : pc

  },
  success: function( data ){
    console.log(data);
    if (data !== ''){
      window.location = (data);
    } else{
    // document.getElementById("ajax_response").innerHTML="Sorry not availabel in your city";
    window.location = 'http://www.kidspartyideas.net/franchises-available-2/'

}


  }
});
}
function EnterKeyEvent(){
jQuery(".searchInput").keyup(function (e) {
    if (e.keyCode == 13) {
       load_my_ajax();
    }
});
}