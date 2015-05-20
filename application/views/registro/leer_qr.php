<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.scannerdetection.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.scannerdetection.compatibility.js"></script>
<script type="text/javascript">
	$(function() {
		$("#div1").scannerDetection();
		$("#div1").scannerDetection('scanned string');
	});
</script>
<style type="text/css">
	#div1 {
		height: 200px;
		width: 200px;
	}
</style>
<div id="div1"></div>
