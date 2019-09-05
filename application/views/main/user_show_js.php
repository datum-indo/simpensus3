<script type="text/javascript">
$(function () {
	"use strict";
	
	
    var line = new Morris.Line({
        element: 'progress-chart',
        resize: true,
		parseTime: false,
        data: <?php echo json_encode($progress_chart); ?>,
        xkey: 'bulan',
        ykeys: ['total', 'selesai', 'belum'],
        labels: ['Total', 'Selesai', 'Belum Selesai'],
        lineColors: ['#3c8dbc', '#00a65a','#D58665'],
		lineWidth: 2,
		gridStrokeWidth: 0.4,
		pointSize: 4,
		smooth: true,
        hideHover: 'auto'
    });
	
});	



</script>