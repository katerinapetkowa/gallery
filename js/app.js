$(document).ready(function(){
	$.ajax({
		url: "http://localhost:8080/gallery/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var hashtag = [];
			var times_used = [];

			for(var i in data) {
				hashtag.push(data[i].hashtag);
				times_used.push(data[i].times_used);
			}

			var chartdata = {
				labels: hashtag,
				datasets : [
					{
						label: 'Top 5 Hashtags',
						backgroundColor: [
						'rgba(0, 0, 0, 1)',
						'rgba(50, 50, 50, 1)',
						'rgba(100, 100, 100, 1)',
						'rgba(150, 150, 150, 1)',
						'rgba(200, 200, 200, 1)'
						],
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: [
						'rgba(0, 0, 0, 0.75)',
						'rgba(50, 50, 50, 0.75)',
						'rgba(100, 100, 100, 0.75)',
						'rgba(150, 150, 150, 0.75)',
						'rgba(200, 200, 200, 0.75)'
						],
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: times_used
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true,
			                    stepSize: 1
			                }
			            }]
			        }
			    }
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});