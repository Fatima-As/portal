  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?php echo ($current == 'dashboard')?'active':''; ?>">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?php echo ($current == 'walls')?'active':''; ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Video Walls</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="wallcomposer.php"><i class="fa fa-circle-o"></i> Create Video Wall</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo ($current == 'screens')?'active':''; ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Screens</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="screens.php"><i class="fa fa-circle-o"></i> Screens</a></li>
            <li><a href="screenadd.php"><i class="fa fa-circle-o"></i> Add New Screen</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo ($current == 'devices')?'active':''; ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Devices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="devices.php"><i class="fa fa-circle-o"></i> Devices</a></li>
            <li><a href="deviceadd.php"><i class="fa fa-circle-o"></i> Add New Device</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo ($current == 'settings')?'active':''; ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="settings.php"><i class="fa fa-circle-o"></i> Settings</a></li>
            <li><a href="settingadd.php"><i class="fa fa-circle-o"></i> Add New Setting</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo ($current == 'managers')?'active':''; ?>">
          <a href="#">
            <i class="fa fa-table"></i> <span>Managers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="managers.php"><i class="fa fa-circle-o"></i> Managers</a></li>
            <li><a href="manageradd.php"><i class="fa fa-circle-o"></i> Add New Manager</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
