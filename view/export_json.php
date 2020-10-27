<a id="send_json" href="<?php echo $link;?>" download="<?php echo $name;?>"></a>

<script type="text/javascript">
	document.getElementById('send_json').click();

	var link = '<?php echo $link_return ?>'

	document.location.href = link;
</script>