<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/lib/uploadify.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/jquery.uploadify-3.1.min.js"></script>
  <title></title>
</head>
<body>

    <div class="uploadify-queue" id="file-queue"></div>
    <input type="file" name="userfile" id="upload_btn" />

    <script type='text/javascript' >
    $(function() {
     $('#upload_btn').uploadify({
      'debug'   : false,

      'swf'   : '<?php echo base_url() ?>assets/js/lib/uploadify.swf',
      'uploader'  : '<?php echo base_url('upload/uploadify')?>',
      'cancelImage' : '<?php echo base_url() ?>assets/js/lib/uploadify-cancel.png',
      'queueID'  : 'file-queue',
      'buttonClass'  : 'button',
      'buttonText' : "Upload Files",
      'multi'   : true,
      'auto'   : true,

      'fileTypeExts' : '*.jpg; *.png; *.gif; *.PNG; *.JPG; *.GIF;',
      'fileTypeDesc' : 'Image Files',

      'method'  : 'post',
      'fileObjName' : 'userfile',

      'queueSizeLimit': 40,
      'simUploadLimit': 2,
      'sizeLimit'  : 10240000,
	  /*'onUploadSuccess' : function(file, data, response) {
            alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
       },*/
	   'onUploadComplete' : function(file) {
            alert('The file ' + file.name + ' finished processing.');
       },
        'onQueueFull': function(event, queueSizeLimit) {
            alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
            return false;
        },
        });
     });
    </script>

</body>
</html>