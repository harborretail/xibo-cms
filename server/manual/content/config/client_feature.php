<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php include('../../template.php'); ?>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  	<title><?php echo PRODUCT_NAME; ?> Documentation</title>
  	<link rel="stylesheet" type="text/css" href="../../css/doc.css">
	<meta name="keywords" content="digital signage, signage, narrow-casting, <?php echo PRODUCT_NAME; ?>, open source, agpl" />
	<meta name="description" content="<?php echo PRODUCT_NAME; ?> is an open source digital signage solution. It supports all main media types and can be interfaced to other sources of data using CSV, Databases or RSS." />  <link href="img/favicon.ico" rel="shortcut icon">
  	<!-- Javascript Libraries -->
  	<script type="text/javascript" src="lib/jquery.pack.js"></script>
  	<script type="text/javascript" src="lib/jquery.dimensions.pack.js"></script>
  	<script type="text/javascript" src="lib/jquery.ifixpng.js"></script>
</head>

<body>
	<h1><?php echo PRODUCT_NAME; ?> Client Features</h1>
	
	<p>The <?php echo PRODUCT_NAME; ?> client comes in three flavours &#8211; the .NET Windows Client, the Python Linux Client and an Android Client. The windows client was born first and is therefore the client of choice for a stable installation. The Python client has greater potential in the future and will eventually become the only client for Windows and Linux.</p>
	
	<table>
	<col width=40%><col width=30%><col width=30%>
	  <thead>
	    <tr>
	      <th>Feature</th>
	      <th>.Net Client</th>
	      <th>Python</th>
          <th>Android</th>
	    </tr>
	  </thead>
	
	  <tbody>
	  <tr>
	    <td>Schedule Layouts</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Priority Schedules</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Video</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Flash</td>
	    <td class="y">Yes</td>
	    <td class="partial-support">Some Support</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	   <td>Images</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>PowerPoint</td>
	    <td class="y">Yes</td>
	    <td class="n">No</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Text</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>RSS</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Web Page</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Embedded HTML</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	  <td>Microblog</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>DataSets</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Background Image</td>
	    <td class="y">Yes (jpg only)</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Media Stats</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Layout Stats</td>
	    <td class="y">Yes</td>
	    <td class="n">No</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Report Inventory</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>File Resume</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Counter Media</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Socket Listener</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Lift/Serial Interface Support</td>
	    <td class="n">No</td>
	    <td class="y">Yes (16 inputs / 4 per serial port)</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Client Runtime Information Screen</td>
	    <td class="y">Yes</td>
	    <td class="y">Yes</td>
        <td class="y">Yes</td>
	  </tr>
	  <tr>
	    <td>Offline Update via USB Drive</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Full Compositing (overlapping regions)</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Webpage Transparency</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Video Transparency</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  <tr>
	    <td>Image Transparency</td>
	    <td class="n">No</td>
	    <td class="y">Yes</td>
        <td class="n">No</td>
	  </tr>
	  </tbody>
	</table>	

	<?php include('../../template/footer.php'); ?>
</body>
</html>