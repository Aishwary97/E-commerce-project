 <?php /* Template Name: Intentionally Vulnerable Page */ ?>
<html>
<head>
<title>Vulnerabilities</title>
    <style type="text/css">
		output *{
		color: red !important;
	}
	</style>
<!-- Javascript Part -->
<script>
	window.addEventListener("load", function () {

	function clearAllOutputs(){
		var outputs = document.querySelectorAll('output');
		for(i = 0; i < outputs.length; i++) {
			outputs[i].innerHTML="";
		}
	}
  function sendData(form,url,outputid) {
    var XHR = new XMLHttpRequest();

    // Bind the FormData object and the form element
    var FD = new FormData(form);

    // Define what happens on successful data submission
    XHR.addEventListener("load", function(event) {
		clearAllOutputs();
      document.getElementById(outputid).innerHTML = event.target.responseText;
    });

    // Define what happens in case of error
    XHR.addEventListener("error", function(event) {
      alert('Oops! Something went wrong.');
    });

    // Set up our request
    XHR.open("POST", url);

    // The data sent is what the user provided in the form
    XHR.send(FD);
  }
 
  function setupform(formid,url, outputid) {
  	var form = document.getElementById(formid);
	form.addEventListener("submit", function (event) {
    event.preventDefault();
    sendData(form, url, outputid);
  });
  
  }
  setupform("fileform", "FileUpload_Non.php", "fileoutput");  
});
</script>

</head>
<body>
<!-- HTML Part-->
<div>
	<h1 align="center">
	Welcome to TicketZilla's Non-Vulnerable Page
	</h1>
</div>
<div>
	<h2>
		Unrestricted File Upload Vulnerability:
	</h2>
	<p>
	Try uploading any file.
	</p>
	<div class="body_padded">
		<div class="vulnerable_code_area">
			<form id = "fileform" action="FileUpload_Non.php" method="post" enctype="multipart/form-data">
				Select file to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload File" name="submit">
			</form>
			<output id="fileoutput"></output>
		</div>
	</div>
</div>
<br>
</body>
</html>