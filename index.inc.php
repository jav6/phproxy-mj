<?php 

if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
{
    exit(0);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>PhProxy-MJ</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="Default Theme" media="all" />
</head>
<body onload="document.getElementById('address_box').focus();">
  <br />
<div id="container">
  <br />
<center>
<h1>PhProxy-MJ run with Php Ver: 5.6.38</h1>
</center>
<?php
switch ($data['category'])
{
    case 'auth':
?>
<div id="auth">

  <b>
    Enter your username and password for "
    <?php echo htmlspecialchars($data['realm']) ?>
    " on 
    <?php echo $GLOBALS['_url_parts']['host'] ?>
    
    </b>
  <form method="post" action="">
    <input type="hidden" name="<?php echo $GLOBALS['_config']['basic_auth_var_name'] ?>" value="<?php echo base64_encode($data['realm']) ?>" />
    <label>Username <input type="text" name="username" value="" /></label>
    <label>Password <input type="password" name="password" value="" /></label>
    <input type="submit" value="Login" />
  </form>
</div>

<?php
        break;
    case 'error':
        echo '<div id="error"><p>';
        
        switch ($data['group'])
        {
            case 'url':
                //echo '<b>URL Error (' . $data['error'] . ')</b>: ';
                switch ($data['type'])
                {
                    case 'internal':
                        $message = 'Failed to connect to the specified host. '
                                 . 'Possible problems are that the server was not found, the connection timed out, or the connection refused by the host. '
                                 . 'Try connecting again and check if the address is correct.';
                        break;
                    case 'external':
                        switch ($data['error'])
                        {
                            case 1:
                                $message = 'The URL you\'re attempting to access is blacklisted by this server. Please select another URL.';
                                break;
                            case 2:
                                $message = 'The URL you entered is malformed. Please check whether you entered the correct URL or not.';
                                break;
                        }
                        break;
                }
                break;
            case 'resource':
                echo '<b>Resource Error:</b> ';
                switch ($data['type'])
                {
                    case 'file_size':
                        $message = 'The file your are attempting to download is too large.<br />'
                                 . 'Maxiumum permissible file size is <b>' . number_format($GLOBALS['_config']['max_file_size']/1048576, 2) . ' MB</b><br />'
                                 . 'Requested file size is <b>' . number_format($GLOBALS['_content_length']/1048576, 2) . ' MB</b>';
                        break;
                    case 'hotlinking':
                        $message = 'It appears that you are trying to access a resource through this proxy from a remote Website.<br />'
                                 . 'For security reasons, please use the form below to do so.';
                        break;
                }
                break;
        }
        
        
        break;
}
?>


<center>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <div id="address_bar">
    <label>Web Address <input id="address_box" type="text"   name="<?php echo $GLOBALS['_config']['url_var_name'] ?>" value="<?php echo isset($GLOBALS['_url']) ? htmlspecialchars($GLOBALS['_url']) : '' ?>" onfocus="this.select()" /></label>
    <input id="go" type="submit" value="Go" />
    <a href="#" onclick="document.getElementById('form').style.display = '';return false">[Options]</a>
    <ul id="form" style="display: none">

      <?php
      foreach ($GLOBALS['_flags'] as $flag_name => $flag_value)
      {
          if (!$GLOBALS['_frozen_flags'][$flag_name])
          {
              echo '<li class="option"><label><input type="checkbox" name="' . $GLOBALS['_config']['flags_var_name'] . '[' . $flag_name . ']"' . ($flag_value ? ' checked="checked"' : '') . ' />' . $GLOBALS['_labels'][$flag_name][1] . '</label></li>' . "\n";
          }
      }
      ?>
    </ul>
    <br />
  </div>
</form>
</center>
<br />
<center>
  <div id="lnks">
    <br />
  </div>
  <h3>Edit & Upgrade by Mohammad Javidi Ver : 0.1</h3>
  <hr />
  <h3>Created by Abdullah Arif => Last Modified  | 5:27 PM 1/20/2007 <br /> he Created in php version 5 or lower than that</h3>
  <br />
</center>
</div>
</body>
</html>