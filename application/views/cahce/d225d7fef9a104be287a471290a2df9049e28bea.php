<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-navy">
    <div class="nav-header bg-primary">
      <a class="navbar-brand"  href="<?php echo e(rt('/')); ?>"><h3><b>NUWSP</b> </h3>  </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo e(rt('/dashboard')); ?>" class="nav-link text-white"><i class="fa fa-home"></i> Dahhboard</a>
          </li>
          <li class="dropdown  nav-item d-none d-sm-inline-block">
            <a href="javascript:void(0)" data-toggle="dropdown" class="nav-link text-white dropdown-toggle"><i class="ion ion-cash"></i> Perencanaan Kegiatan</a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo e(rt('air_minum')); ?>">Air Minum</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Air Minum Daerah NUWAS</a>
                </div>
          </li>
          <li class="  nav-item d-none d-sm-inline-block dropdown">
            <a href="javascript:void(0)"  data-toggle="dropdown" class="nav-link text-white  dropdown-toggle"><i class="ion ion-cash"></i> Anggaran</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Air Minum</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Air Minum Daerah NUWAS</a>
            </div>
          </li>
          <li class="dropdown nav-item d-none d-sm-inline-block">
            <a  href="javascript:void(0)"  data-toggle="dropdown" class="nav-link text-white  dropdown-toggle"><i class=" fa fa-industry"></i> Profile PDAM</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Air Minum</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Air Minum Daerah NUWAS</a>
            </div>
          </li>
          <li class=" nav-item d-none d-sm-inline-block">
            <a href="javascript:void(0)" class="nav-link text-white "><i class=" fa fa-list"></i> Profile Kebijakan </a>



          </li>


          <li></li>
          <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo e(rt('map_tematik')); ?>" class="nav-link text-white"><i class="fa fa-map"></i> Map Tematik</a>
          </li> -->

        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </form>
      </div>
    </nav>
<?php /**PATH /var/NUWAS/nuwas/application/views/component/nav.blade.php ENDPATH**/ ?>