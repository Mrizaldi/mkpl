$(function() {
	$('.tambahTask').on('click', function() {
		$('#taskModalLabel').html('Tambah Task');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-body form').attr('action','http://localhost/wpu-login/task/tambah');
		$('#taskId').val('');
		$('.nama').val('');
		// $('#startdate').val('');
		$('#enddate').val('');
		$('#description').val('');
		$('#status').val('');
		$('#assignee').val('');
	});

	$('#newboard').on('click', function() {
		$('.newboard').html('Add');
	});
	
	$('.viewTask').on('click', function() {
		const id = $(this).data('id');
		const projid = $(this).data('proj');
		const mine = $(this).data('mine');
		$('#taskModalLabel').html('Detail Task');
		$('.modal-footer button[type=submit]').html('Update');		
		if (mine == 1) {
			// $('.modal-footer button[type=submit]').attr('disabled',false);		
			$('.modal-footer button[type=submit]').css({"display":"inline"});		
		}else{
			$('.modal-footer button[type=submit]').css({"display":"none"});		
		}
		$('.modal-body form').attr('action','http://localhost/wpu-login/task/update');
		$('.modal-footer a').attr('href','http://localhost/wpu-login/task/delete/' + id + '/' + projid);
		// console.log(id);
		$.ajax({
			url:'http://localhost/wpu-login/task/getDetails',
			data:{id : id},
			method:'post',
			dataType:'json',
			success:function(data) {
				$('#taskId').val(data.id);
				$('.nama').val(data.name);
				$('#startdate').val(data.startDate);
				$('#enddate').val(data.endDate);
				$('#description').val(data.deskripsi);
				$('#status').val(data.status);
				$('#assignee').val(data.empId);
			}
		});
	});

	$('#startdate').on('change', function () {
		var startdateprj = new Date($('#startdateprj').val());
		var startdate = new Date($('#startdate').val());
	  	var enddate = new Date($('#enddate').val());
	  	var today = new Date();
	  	if (startdate < today) {
	  		alert('Start date tidak boleh kurang dari hari ini !\n' + 
	  			'Silakan pilih ulang start date !');
	  	}
	  	if (enddate < startdate) {
	  		alert('Start date tidak boleh melebihi end date !\n' + 
	  			'Silakan pilih ulang start date !');
	  	}
	  	if (startdateprj > startdate) {
	  		alert('Start date task tidak boleh kurang dari start date project !\n' + 
	  			'Silakan pilih ulang start date !');
	  	}
	  	
	});
	$('#enddate').on('change', function () {		
	  	var enddateprj = new Date($('#enddateprj').val());
		var startdate = new Date($('#startdate').val());
	  	var enddate = new Date($('#enddate').val());
	  	var today = new Date();
	  	if (enddate < today) {
	  		alert('End date tidak boleh kurang dari hari ini !\n' + 
	  			'Silakan pilih ulang end date !');
	  	}
	  	if (enddate < startdate) {
	  		alert('End date tidak boleh kurang dari start date !\n' + 
	  			'Silakan pilih ulang end date !');
	  	}
	  	if (enddateprj < enddate) {
	  		alert('End date task tidak boleh lebih dari end date project !\n' + 
	  			'Silakan pilih ulang end date !');
	  	}
	});

	$('.custom-file-input').on('change',function (){
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.batal').on('click', function() {
		$('form button[type=submit]').html('Tambah');
		$('.card-body form').attr('action','http://localhost/wpu-login/Pic/tambah');
		$('#id').val('');
		$('#picName').val('');
		$('#picPhone').val('');
		$('#picMail').val('');
		$('#picPosition').val('');
		//$('#clientId').val('');
	});
	
	$('.viewPic').on('click', function() {
		const id = $(this).data('id');
		const pic = $(this).data('pic');

		$('form button[type=submit]').html('Update');		
		$('.card-body form').attr('action','http://localhost/wpu-login/Pic/update');

		$.ajax({
			url:'http://localhost/wpu-login/pic/getDetails',
			data:{id : id},
			method:'post',
			dataType:'json',
			success:function(data) {
				$('#id').val(data.id);
				$('#picName').val(data.picName);
				$('#picPhone').val(data.picPhone);
				$('#picMail').val(data.picMail);
				$('#picPosition').val(data.picPosition);
			}
		});
	});	
});
	