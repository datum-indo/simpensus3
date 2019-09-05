<script type="text/javascript">
$(function () {
	"use strict";
	
	// LINE CHART
	
    var line = new Morris.Line({
        element: 'layanan-bantuan',
        resize: true,
		parseTime: false,
        data: <?php echo json_encode($bantuan_hukum); ?>,
        xkey: 'bulan',
        ykeys: ['total', 'diterima', 'ditolak'],
        labels: ['Total', 'Diterima', 'Ditolak'],
        lineColors: ['#3c8dbc', '#00a65a','#D58665'],
		lineWidth: 2,
		gridStrokeWidth: 0.4,
		pointSize: 4,
		smooth: true,
        hideHover: 'auto'
    });
	
	
	$(".knob").knob();

	var pieCanvasBentukKasus = $("#bentuk_kasus").get(0).getContext("2d");
    var pieBentukKasus = new Chart(pieCanvasBentukKasus);
    var DataBentukKasus = [
        {
			value: <?php echo $individu; ?>,
			color: "#00c0ef",
			highlight: "#00c0ef",
            label: "Individu"
        },
        {
            value: <?php echo $kelompok; ?>,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Kelompok"
        }
    ];
	
	var pieCanvasSifatKasus = $("#sifat_kasus").get(0).getContext("2d");
    var pieSifatKasus = new Chart(pieCanvasSifatKasus);
    var DataSifatKasus = [
        {
			value: <?php echo $nonstruktural; ?>,
			color: "#00a65a",
			highlight: "#00a65a",
            label: "Non-Struktural"
        },
        {
            value: <?php echo $struktural; ?>,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Struktural"
        }
    ];
    
    var pieOptions = 
	{
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
     };
     
	//Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieBentukKasus.Doughnut(DataBentukKasus, pieOptions);	
	pieSifatKasus.Doughnut(DataSifatKasus, pieOptions);	
		
	//BAR CHART
    var bar = new Morris.Bar(
	{
        element: 'issue-ham',
		data: <?php echo json_encode($issue_ham); ?>,
        barColors: ['#f39c12'],
        ykeys: ['jumlah'],
		xkey: 'id_issue_ham',
        labels: ['Jumlah'],
		hideHover: 'auto',
		hoverCallback: function (index, options, content, row) {
			return row.issue_ham+'<br/><span style="">Jumlah: '+row.jumlah+'</span>';
		}
    });
	
	/*
	var bar = new Morris.Line(
	{
        element: 'issue-ham',
		resize: true,
		parseTime: false,
        data: <?php echo json_encode($issue_ham); ?>,
        ykeys: ['jumlah'],
		xkey: 'id_issue_ham',
        labels: ['Jumlah'],
		hideHover: 'auto',
		lineColors: ['#f39c12'],
		lineWidth: 2,
		gridStrokeWidth: 0.4,
		pointSize: 4,
		smooth: true,
		hoverCallback: function (index, options, content, row) {
			return row.issue_ham+'<br/><span style="">Jumlah: '+row.jumlah+'</span>';
		}
    });
	*/
	
});	



</script>