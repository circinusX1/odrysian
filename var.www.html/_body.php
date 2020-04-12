<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">
    <img src="_img/index.png" height="30px"></a>

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="yyy">
      <ul class="navbar-nav navbar-sidenav sidewidth" id="xxx">

        <li id='<b>Panel</b>' class="nav-item" data-toggle="tooltip" data-placement="right" title="x">
          <a class="nav-link" href="/?p=_auto.php">
            <i class="fa fa-dashboard"></i>
            <span class="nav-link-text"><b>Panel</b></span>
          </a>
        </li>
        <li id='<sub>Settings</sub>' class="nav-item" data-toggle="tooltip" data-placement="right" title="x">
          <a class="nav-link" href="/?p=_settings.php">
            <i class="fa fa-gears"></i>
            <span class="nav-link-text"><sub>Settings</sub></span>
          </a>
        </li>
        <li id='<sub>Reports</sub>' class="nav-item" data-toggle="tooltip" data-placement="right" title="x">
          <a class="nav-link" href="/?p=_reports.php">
            <i class="fa fa-database"></i>
            <span class="nav-link-text"><sub>Reports</sub></span>
          </a>
        </li>
        <li id='<sub>Admin</sub>' class="nav-item" data-toggle="tooltip" data-placement="right" title="x">
          <a class="nav-link" href="/?p=_admin.php">
            <i class="fa fa-gear"></i>
            <span class="nav-link-text"><sub>Admin</sub></span>
          </a>
        </li>


      </ul>
      <ul class="navbar-nav sidenav-toggler sidewidth">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">

          </a>
        </li>
      </ul>
<!-- top -->
      <ul class="navbar-nav ml-left">


     <li class="nav-item"><div class='mode stopli' id='s2w-mode-stop' title='stops all motors'>Stop Mode </div></li>
     <li class="nav-item"><div class='mode servli' id='s2w-mode-service' title='conserves current state'>Idle/Service Mode </div></li>
    &nbsp;&nbsp;&nbsp;
     <li class="nav-item"><div class='mode absli' title='start cycle' id='s2w-mode-absorbtion'>Absorbtion Mode </div></li>
     <li class="nav-item"><div class='mode cregli' id='s2w-mode-condens'>Condens Mode </div></li>
     <li class="nav-item"><div class='mode cregli' id='s2w-mode-regen' >Regen Mode </div></li>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
     <li class="nav-item"><img src='_img/plw.jpg' id='plw' width='28px'>
     &nbsp;<div class='tpdiv' id='s2wmsg'></div></li>
      </ul>
    </div>
           <li class='nav-item toright'>
               <a href='index.php?p=_admin.php&poweroff=1'
                    title='power off'>
                        <img src='_img/poweroff.png'>
                </a>
           </li>
  </nav>
  <div class="content-wrapper" id="s2wwrapper">
    <!--div class="container-fluid" id="pcontent"-->
    <form action="/?p=_settings.php" method="post">
    <table class='tgn'>
    <tr><th colspan='3'>config.ssi file was parsed successuly</th></tr>
    <tr><th>Setting Variable</th><th>Value</th><th>Comment</th></tr>
<tr><th class='tcsens' colspan='3'><input  class='form-control' type='text' name='k_0' readonly value='Main settings' /></th></tr><tr><th class='tcsens'>LOOP_INTERVAL</th><td class='tcstat'><input class='form-control'  type='text' name='v_LOOP_INTERVAL' value='15' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_LOOP_INTERVAL' value='how othen to check sensors and apply modes' /></td></tr><tr><th class='tcsens'>BILDGE_PUMP_TIME</th><td class='tcstat'><input class='form-control'  type='text' name='v_BILDGE_PUMP_TIME' value='12' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_BILDGE_PUMP_TIME' value='how long to run bildge pump when sensor is full.' /></td></tr><tr><th class='tcsens'>DB_SAVE_INTERVAL</th><td class='tcstat'><input class='form-control'  type='text' name='v_DB_SAVE_INTERVAL' value='10' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_DB_SAVE_INTERVAL' value='db saving interval in seconds' /></td></tr><tr><th class='tcsens'>MAX_MUX_RESET</th><td class='tcstat'><input class='form-control'  type='text' name='v_MAX_MUX_RESET' value='0' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_MAX_MUX_RESET' value='failures to read sensors, max resets of tca before resetting it' /></td></tr><tr><th class='tcsens'>CYCLE_TIME</th><td class='tcstat'><input class='form-control'  type='text' name='v_CYCLE_TIME' value='86400' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_CYCLE_TIME' value='hours for 1 cycle - TB ADDED - 11.7.18' /></td></tr><tr><th class='tcsens' colspan='3'><input  class='form-control' type='text' name='k_1' readonly value='Absorbtion Settings' /></th></tr><tr><th class='tcsens'>ABS_DURATION_TIME</th><td class='tcstat'><input class='form-control'  type='text' name='v_ABS_DURATION_TIME' value='43200' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_ABS_DURATION_TIME' value='absorbtion running time in seconds' /></td></tr><tr><th class='tcsens'>ABS_LOUVER_TIME_SETT</th><td class='tcstat'><input class='form-control'  type='text' name='v_ABS_LOUVER_TIME_SETT' value='31' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_ABS_LOUVER_TIME_SETT' value='louver time waiting to open' /></td></tr><tr><th class='tcsens'>ABS_START_CIRCPUMP</th><td class='tcstat'><input class='form-control'  type='text' name='v_ABS_START_CIRCPUMP' value='3600' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_ABS_START_CIRCPUMP' value='hrs to start circ pump before end of cycle - TB added' /></td></tr><tr><th class='tcsens'>ABS_FAN_PWM</th><td class='tcstat'><input class='form-control'  type='text' name='v_ABS_FAN_PWM' value='80' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_ABS_FAN_PWM' value='Main Fan PWM - TB Added 1.4.19' /></td></tr><tr><th class='tcsens' colspan='3'><input  class='form-control' type='text' name='k_2' readonly value='Condens Settings' /></th></tr><tr><th class='tcsens'>C_FAN_SPEED</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_FAN_SPEED' value='50' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_FAN_SPEED' value='minim fan speed' /></td></tr><tr><th class='tcsens'>C_MIN_SPEED_PWM</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_MIN_SPEED_PWM' value='0' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_MIN_SPEED_PWM' value='minim pwm percentage  for PID' /></td></tr><tr><th class='tcsens'>C_MAX_SPEED_PWM</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_MAX_SPEED_PWM' value='70' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_MAX_SPEED_PWM' value='max pwm percentage for PID' /></td></tr><tr><th class='tcsens'>C_INCREMENT_PWM</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_INCREMENT_PWM' value='1' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_INCREMENT_PWM' value='1%' /></td></tr><tr><th class='tcsens'>C_PID_DERIV</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_PID_DERIV' value='0.0' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_PID_DERIV' value='derivative factor' /></td></tr><tr><th class='tcsens'>C_PID_INTEGRAP</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_PID_INTEGRAP' value='-0.025' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_PID_INTEGRAP' value='integral factor - original 0.05' /></td></tr><tr><th class='tcsens'>C_PID_PROP</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_PID_PROP' value='-0.125' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_PID_PROP' value='proportinal factorconst - original 0.25' /></td></tr><tr><th class='tcsens'>C_R3_CONST</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_R3_CONST' value='0.65' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_R3_CONST' value='used in averaging next optimal' /></td></tr><tr><th class='tcsens'>C_R2_CONST</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_R2_CONST' value='50' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_R2_CONST' value='- original was a negative number (-0.25)' /></td></tr><tr><th class='tcsens'>C_MAX_REG_PWM</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_MAX_REG_PWM' value='75' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_MAX_REG_PWM' value='set max reg pwm - TB ADDED - 11.7.18' /></td></tr><tr><th class='tcsens'>C_MAX_AMB_PWM</th><td class='tcstat'><input class='form-control'  type='text' name='v_C_MAX_AMB_PWM' value='60' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_C_MAX_AMB_PWM' value='set max amb PWM - TB ADDED - 11.7.18' /></td></tr><tr><th class='tcsens' colspan='3'><input  class='form-control' type='text' name='k_3' readonly value='Flushing Condens Settings' /></th></tr><tr><th class='tcsens'>F_BUMP_COND_INTERVAL</th><td class='tcstat'><input class='form-control'  type='text' name='v_F_BUMP_COND_INTERVAL' value='420' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_F_BUMP_COND_INTERVAL' value='seconds flushing interval minutes' /></td></tr><tr><th class='tcsens'>F_BUMP_COND_TIME</th><td class='tcstat'><input class='form-control'  type='text' name='v_F_BUMP_COND_TIME' value='15' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_F_BUMP_COND_TIME' value='seconds to work at 100%' /></td></tr><tr><th class='tcsens'>F_BUMP_SETTLE_BACK_TIME</th><td class='tcstat'><input class='form-control'  type='text' name='v_F_BUMP_SETTLE_BACK_TIME' value='30' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_F_BUMP_SETTLE_BACK_TIME' value='to ignore PID and work on' /></td></tr><tr><th class='tcsens' colspan='3'><input  class='form-control' type='text' name='k_4' readonly value='Regen Settings' /></th></tr><tr><th class='tcsens'>R_R1_CONST</th><td class='tcstat'><input class='form-control'  type='text' name='v_R_R1_CONST' value='40' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_R_R1_CONST' value='3 degrees' /></td></tr><tr><th class='tcsens'>R_REGFAN_PWM_CONST</th><td class='tcstat'><input class='form-control'  type='text' name='v_R_REGFAN_PWM_CONST' value='75' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_R_REGFAN_PWM_CONST' value='less to conserve energy' /></td></tr><tr><th class='tcsens'>R_AMBFAN_PWM_CONST</th><td class='tcstat'><input class='form-control'  type='text' name='v_R_AMBFAN_PWM_CONST' value='30' /></td><td class='tcctrl'><input class='form-control'  type='text' name='c_R_AMBFAN_PWM_CONST' value='less to conserve energy - TB added' /></td></tr><tr><td colspan='3' align='right'><input id='applyset' title='will restart s2w' type="submit" name="subbmit" value="Apply..."></td><tr></table>
</form>
<br />
<br />
<br />
    <!--/div-->


    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->


<div id='botb'>
 S2W:4.0.1-Mar  6 2019&nbsp;&nbsp;&nbsp; Units: Temperature:  &#8451; * 10, Pressure: Pascals (Norm:101325 Pa), Humidity: % </b>


    <div class='tpdiv' id='s2wmsg1'></div> |
    <div class='tpdiv' id='s2wmsg2'></div> |
    <div class='tpdiv' id='s2wmsg3'></div> |


</div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </div>
</body>
