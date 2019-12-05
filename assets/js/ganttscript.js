google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {      	        
	  var datatabel = new google.visualization.DataTable();
      datatabel.addColumn('string', 'Project ID');
      datatabel.addColumn('string', 'Project Name');
      datatabel.addColumn('string', 'Resource');
      datatabel.addColumn('date', 'Start Date');
      datatabel.addColumn('date', 'End Date');
      datatabel.addColumn('number', 'Duration');
      datatabel.addColumn('number', 'Percent Complete');
      datatabel.addColumn('string', 'Dependencies');

      var datatabel2 = new google.visualization.DataTable();
      datatabel2.addColumn('string', 'Task ID');
      datatabel2.addColumn('string', 'Task Name');
      datatabel2.addColumn('string', 'Resource');
      datatabel2.addColumn('date', 'Start Date');
      datatabel2.addColumn('date', 'End Date');
      datatabel2.addColumn('number', 'Duration');
      datatabel2.addColumn('number', 'Percent Complete');
      datatabel2.addColumn('string', 'Dependencies');

      var datatabel3 = new google.visualization.DataTable();
      datatabel3.addColumn('string', 'Task ID');
      datatabel3.addColumn('string', 'Task Name');
      datatabel3.addColumn('string', 'Resource');
      datatabel3.addColumn('date', 'Start Date');
      datatabel3.addColumn('date', 'End Date');
      datatabel3.addColumn('number', 'Duration');
      datatabel3.addColumn('number', 'Percent Complete');
      datatabel3.addColumn('string', 'Dependencies');
      
      var datatabel4 = new google.visualization.DataTable();
      datatabel4.addColumn('string', 'Task ID');
      datatabel4.addColumn('string', 'Task Name');
      datatabel4.addColumn('string', 'Resource');
      datatabel4.addColumn('date', 'Start Date');
      datatabel4.addColumn('date', 'End Date');
      datatabel4.addColumn('number', 'Duration');
      datatabel4.addColumn('number', 'Percent Complete');
      datatabel4.addColumn('string', 'Dependencies');

      var options = {
        height: 400,
        gantt: {
          trackHeight: 30
        }
      };
		
		var dataproject = new Array();
      	$.ajax({
			url:'http://localhost/wpu-login/project/getAllProject',
			//data:{id : id},
			method:'post',
			dataType:'json',
			success:function(data) {
				$('#chart_project').empty();
				for (i in data) {
					//alert(data[i].name);
					var id = data[i].id;
					var name = data[i].projName;
					var startDate = data[i].projStartDate;
					var endDate = data[i].projEndDate;
					var progress = data[i].projProgress;
					dataproject.push([id, name, 'Project', new Date(startDate) , new Date(endDate) /*endDate*/, null, parseInt(progress), null]);
				}
				// console.log(dataproject);					
      			datatabel.addRows(dataproject);
      			var chart = new google.visualization.Gantt(document.getElementById('chart_project'));
      			chart.draw(datatabel, options);
			}
		});

		var datatask = new Array();
      	$.ajax({
			url:'http://localhost/wpu-login/task/getAllTask',
			//data:{id : id},
			method:'post',
			dataType:'json',
			success:function(data) {
				$('#chart_task').empty();
				for (i in data) {
					//alert(data[i].name);
					var id = data[i].id;
					var name = data[i].name;
					var startDate = new Date(data[i].startDate);
					var endDate = new Date(data[i].endDate);
					datatask.push([id, name, 'task', new Date(startDate) , new Date(endDate) /*endDate*/, null, 100, null]);
					// console.log(datatask);
					// var appendList = '<div class="card-header mb-2">'+id+'<br>'+name+'<br>'+startDate+'<br>'+endDate+'<br></div>';
					// $('#chart_div2').append(appendList);
				}
      			datatabel2.addRows(datatask);
      			var chart2 = new google.visualization.Gantt(document.getElementById('chart_task'));
      			chart2.draw(datatabel2, options);
			}
		});

		var dataprojectpm = new Array();
      	$.ajax({
			url:'http://localhost/wpu-login/project/getProjectPM',
			//data:{id : id},
			method:'post',
			dataType:'json',
			success:function(data) {
				$('#chart_projectpm').empty();
				for (i in data) {
					//alert(data[i].name);
					var id = data[i].id;
					var name = data[i].projName;
					var startDate = data[i].projStartDate;
					var endDate = data[i].projEndDate;
					var progress = data[i].projProgress;
					dataprojectpm.push([id, name, 'Project', new Date(startDate) , new Date(endDate) /*endDate*/, null, parseInt(progress), null]);
				}
				// console.log(dataproject);					
      			datatabel4.addRows(dataprojectpm);
      			var chartpm = new google.visualization.Gantt(document.getElementById('chart_projectpm'));
      			chartpm.draw(datatabel4, options);
			}
		});

		var datataskemp = new Array();
      	$.ajax({      		
			url:'http://localhost/wpu-login/task/getTaskByEmployee',
			data:{id : document.getElementById("empid").value},
			method:'post',
			dataType:'json',
			success:function(data) {
				$('#chart_task_employee').empty();
				for (i in data) {
					var id = data[i].id;
					var name = data[i].name;
					var startDate = new Date(data[i].startDate);
					var endDate = new Date(data[i].endDate);
					datataskemp.push([id, name, 'task', new Date(startDate) , new Date(endDate) /*endDate*/, null, 100, null]);
					// console.log(datatask);
					// var appendList = '<div class="card-header mb-2">'+id+'<br>'+name+'<br>'+startDate+'<br>'+endDate+'<br></div>';
					// $('#chart_div2').append(appendList);
					// console.log(data[i]);
				}
      			datatabel3.addRows(datataskemp);
      			var chart3 = new google.visualization.Gantt(document.getElementById('chart_task_employee'));
      			chart3.draw(datatabel3, options);
			}
		});

		
    
    }