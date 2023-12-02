<html>
    <head>
        <title>Regular Expression</title>
        <link rel="stylesheet" href="index.css">
    </head>
    
    <body>
    	<form id="regex_form" method="post" action="index.php" enctype="multipart/form-data">
    		<div id="result">
    			<table border="1" style="width: 500px; cell-padding: 10px">
    				<tr>
    					<td colspan="2"><input type="file" id='regex_file' name="regex_file"><input type="button" id="submit" value='Upload'></td>
    				</tr>
    				<tr>
    					<td style="width: 50px">Status</td>
    					<td><div id="status"></div></td>
    				</tr>
    				<tr>
    					<td>Pattern</td>
    					<td><input type="text" id="regex_text" name="regex_text" onkeyup="match_pattern()" style="width: 100%; background-color: khaki" /></td>
    				</tr>
    			</table>
    		</div>
    	</form>
    	<label id="filter" class="switch" style="position: absolute; left: 465px; top: 20px">
            <input type="checkbox" checked>
            <span class="slider round"></span>
		</label>
    	<script type="text/javascript" src="index.js"></script>
    </body>
</html>
