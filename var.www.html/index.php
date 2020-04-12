<?php

/**
 * Based on Raspbian WiFi Configuration Portal
 *
 * Enables use of simple web interface rather than SSH to control wifi and hostapd on the Raspberry Pi.
 * Recommended distribution is Raspbian Server Edition. Specific instructions to install the supported software are
 * in the README and original post by @SirLagz. For a quick run through, the packages required for the WebGUI are:
 * lighttpd (I have version 1.4.31-2 installed via apt)
 * php5-cgi (I have version 5.4.4-12 installed via apt)
 * along with their supporting packages, php5 will also need to be enabled.
 * 
 * @author     Lawrence Yau <sirlagz@gmail.com>
 * @author     Bill Zimmerman <billzimmerman@gmail.com>
 * @license    GNU General Public License, version 3 (GPL-3.0)
 * @version    1.3.1
 * @link       https://github.com/billz/raspap-webgui
 * @see        http://sirlagz.net/2013/02/08/raspap-webgui/
 */

session_start();

include_once( 'includes/config.php' );
include_once( '/etc/raspap/raspap.php' );
include_once( 'includes/locale.php');

$output = $return = 0;
if(isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = "gpsmco";

if (empty($_SESSION['csrf_token'])) {
    if (function_exists('mcrypt_create_iv')) {
        $_SESSION['csrf_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
$csrf_token = $_SESSION['csrf_token'];

$theme = "custom.css";
$theme_url = 'dist/css/'.htmlspecialchars($theme, ENT_QUOTES);

include_once( 'includes/functions.php' );

if(isset($_POST))
{
	$POST_VARS = serialize($_POST);
	echo "<pre hidden><div id='post_vars'>{$POST_VARS}</div></pre>";
}
if(isset($_GET))
{
	$GET_VARS = serialize($_GET);
	echo "<pre hidden><div id='get_vars'>{$GET_VARS}</div></pre>";
}
$hn = file_get_contents("/etc/hostname");
?>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odrysian GPS Time Server. v-1.0.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?php echo $theme_url; ?>" title="main" rel="stylesheet">

    <link href="css/css.css" rel="stylesheet">
    <link href="css/obitron.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
  </head>
  <body>

    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

           <div class="nav-item" style="float:left;width:26px;"><img title="odrisysian/meeiot" src="img/meeiot.jpg"></div>
           <div class="nav-item" style="float:left;width:26px;"><img src="img/favicon.png" title="credits: raspapp"></div>
           <div class="nav-item" style="float:left;width:16px;padding-top:60px;"><?=$hn;?></div>
           <div class="nav-item" id="timedate" style="float:right;font-size:26px;font-family: 'Orbitron', sans-serif;"></div>
           <img style="left:220px;position:absolute;top:20px;" src="img/plw.jpg" id="plw" width="32px" />

           <div id="pg" hidden><?=$page;?></div>
      </nav>
  
        <!-- Navigation -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li  class="list-group-item">
                <a href="?page=gpsmco" class="fa fa-rocket fa-fw inl">GPS</a>
              </li>
              <li class="list-group-item">
                <a href="?page=ntp" class="fa  fa-clock-o fa-fw inl">NTP&nbsp;Status</a>
              </li>
              <li class="list-group-item">
                <a href="?page=nmap" class="fa fa-sitemap fa-fw inl">NET&nbsp;Status</a>
              </li>

              <?php if ( RASPI_HOTSPOT_ENABLED ) : ?>
              <li  class="list-group-item">
                <a href="?page=hostapd" class="fa fa-dot-circle-o fa-fw inl">Configure&nbsp;hotspot</a>
              </li>
              <?php endif; ?>
              <?php if ( RASPI_NETWORK_ENABLED ) : ?>
              <li  class="list-group-item">
                 <a href="?page=networking" class="fa fa-sitemap fa-fw inl">Configure&nbsp;networking</a>
              </li> 
              <?php endif; ?>
              <?php if ( RASPI_DHCP_ENABLED ) : ?>
              <li  class="list-group-item">
                <a href="page=?dhcp" class="fa fa-exchange fa-fw inl">Configure&nbsp;DHCP&nbsp;Server</a>
              </li>
              <?php endif; ?>
              <?php if ( RASPI_OPENVPN_ENABLED ) : ?>
              <li  class="list-group-item">
                <a href="?page=openvpn_conf" class="fa fa-lock fa-fw inl ">Configure&nbsp;OpenVPN</a>
              </li>
              <?php endif; ?>
              <?php if ( RASPI_TORPROXY_ENABLED ) : ?>
              <li>
                 <a href="?page=torproxy_conf" class="fa fa-eye-slash fa-fw inl ">Configure&nbsp;TOR&nbsp;proxy</a>
              </li>
              <?php endif; ?>
              <?php if ( RASPI_CONFAUTH_ENABLED ) : ?>
              <li  class="list-group-item">
                <a href="?page=admin" class="fa fa-lock fa-fw inl ">Configure&nbsp;Auth</a>
              </li>
              <?php endif; ?>
                <!-- li class="list-group-item">
                  <a href="?page=wifione" class="fa fa-wifi fa-fw inl ">Wifi Connect</a>
                </li -->
              <?php if ( RASPI_CHANGETHEME_ENABLED ) : ?>
              <li  class="list-group-item">
                <a href="?page=theme_conf" class="fa fa-wrench fa-fw inl">Change&nbsp;Theme</div>
              </li>
              <?php endif; ?>
              <?php if ( RASPI_VNSTAT_ENABLED ) : ?>
              <li  class="list-group-item">
                <a href="?page=data_use" class="fa fa-bar-chart fa-fw inl">Data&nbsp;usage</div>
              </li>
              <?php endif; ?>
              <li  class="list-group-item">
                <a href="?page=system" class="fa fa-cube fa-fw inl">System</a>
              </li>
                <!-- li  class="list-group-item">
                  <a href="?page=webconsole" class="fa fa-cube fa-fw inl">Shell</a>
                </li -->
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.navbar-default -->
      <div id="page-wrapper">

        <div class="row">

          <div class="col-lg-12" id="kontent" >
        <?php 
				include("includes/{$page}.php")
		?>
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper --> 
    </div><!-- /#wrapper -->




    <!-- RaspAP JavaScript -->
    <script src="dist/js/functions.js"></script>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="vendor/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/gpsd.js"></script>



  </body>
</html>


