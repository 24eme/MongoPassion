<table style="display: none;">
	<tr>
		<?php foreach ($docs[0] as $key => $value) { ?>
			<td><?php echo $key ?></td>
		<?php } ?>
	</tr>
	<?php foreach ($docs as $entry) { ?>
		<tr>
			<?php foreach ($entry as $value) { ?>
				<td><?php echo $value ?></td>
			<?php } ?>
		</tr>
	<?php } ?>
</table>

<script type="text/javascript">
	function download_csv(csv, filename) {
      var csvFile;
      var downloadLink;

      // CSV FILE
      csvFile = new Blob([csv], {type: "text/csv"});

      // Download link
      downloadLink = document.createElement("a");

      // File name
      downloadLink.download = filename;

      // We have to create a link to the file
      downloadLink.href = window.URL.createObjectURL(csvFile);

      // Make sure that the link is not displayed
      downloadLink.style.display = "none";

      // Add the link to your DOM
      document.body.appendChild(downloadLink);

      // Lanzamos
      downloadLink.click();
  }

  function export_table_to_csv(html, filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

      for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll("td, th");

          for (var j = 0; j < cols.length; j++)
              row.push(cols[j].innerText);

      csv.push(row.join(","));
    }

      // Download CSV
      download_csv(csv.join("\n"), filename);
  }

	var random = (Math.floor(Math.random() * Math.floor(100000000))).toString(16);
    var html = document.querySelector("table").outerHTML;
    export_table_to_csv(html, "csv_"+random+".csv");

    var link = '<?php echo $link_return ?>';

    document.location.href = link;

</script>