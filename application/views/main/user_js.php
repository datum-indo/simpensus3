<script type="text/javascript">
$(document).ready(function() {
	get_user_list();
	
	
	$("#paginator").on("click", ".pagination a", function() {
		
		var url = $(this).attr("href");
		var offset = $(this).attr("data-ci-pagination-page");
				
		if(offset == undefined)
		{
			return false;	
		}
		else
		{
			action(offset);
		}	
		/*
		var url = $(this).attr("href");
		
		if(url == 'javascript:void(0)')
		{
			return false;	
		}
		else
		{
			$.ajax({
				url : url,
				type: "GET",
				dataType: "JSON",
				success: function(response)
				{
					var total = response[0];
					var perPage = response[1];
					var paginator = response[2];
					var data = response[3];

					$('#user_list').empty();
					
					$.each(data, function (i){
						$('#user_list').append(data[i]);
					});
					
					$('#paginator').empty().append(paginator);
				},
				complete: function() 
				{
					
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax');
				}
			});
		
			return false;		
		}		
		*/
		
	});
	
	
});	

function get_user_list()
{
	url = "<?php echo site_url('users/ajax_list'); ?>";
	    	
	$.ajax({
		url : url,
		type: "GET",
		dataType: "JSON",
		success: function(response)
		{
			var total = response[0];
			var perPage = response[1];
			var paginator = response[2];
			var data = response[3];

			$('#user_list').empty();
			
			$.each(data, function (i){
				$('#user_list').append(data[i]);
			});
			
			$('#paginator').empty().append(paginator);
			
		},
		error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
	});
}

function action(offset)
{
	//var offset	= $("#paginator .pagination a").attr("data-ci-pagination-page");
	url = "<?php echo site_url('users/ajax_list/index')?>/" + offset,
	
	$.ajax({
		url : url,
		type: "GET",
		dataType: "JSON",
		success: function(response)
		{
			var total = response[0];
			var perPage = response[1];
			var paginator = response[2];
			var data = response[3];

			$('#user_list').empty();
				
			$.each(data, function (i){
				$('#user_list').append(data[i]);
			});
					
			$('#paginator').empty().append(paginator);
		},
		complete: function() 
		{
					
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
		
	return false;
}

</script>
	
     