@push('css')
     <link rel="stylesheet" type="text/css" href="{{ asset('mng/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('mng/plugins/toastr/toastr.min.css') }}">
@endpush
@push('js')
   	<script src="{{ asset('mng/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
   	<script src="{{ asset('mng/plugins/toastr/toastr.min.js') }}"></script>
   	<script>
   	 	$(".input-switch").bootstrapSwitch({
          onSwitchChange: function(e, status) {
            let url = $(this).data('url');
          updateSettings($(this).attr('name') ,status, url);
          }
    	});
     	function updateSettings(id , status, url){
        $.ajax({
            url : url,
            type : 'POST',
            dataType : 'json',
            data : {_token : token , id : id, status : status},
            success : function(res){
              if(res.status == true){
                  toastr.options.positionClass = 'toast-bottom-right';
                  toastr.success(res.message);
              }
            } 
    		});
     	}
   	</script>
@endpush