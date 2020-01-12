

<?php $__env->startSection('content'); ?>
<div class="card">
  <div class="card-body table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>kode Kegiatan</th>
            <th>NSPK</th>
            <th>SPM</th>
            <th>PN</th>
            <th>SDGS</th>

            <th>Kegiatan</th>
            <th>indikator</th>
            <th>target awal</th>
            <th>target ahir</th>

          </tr>
        </thead>
        <tbody>
          <?php $num=0; ?>
          <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php

          $num+=1;
          ?>
          <tr>
              <td><?php echo e($num); ?></td>
              <td>
                <?php echo e($key); ?>

              </td>
              <td>
                <?php echo $d['nspk']; ?>

              </td>
              <td>
                <?php echo $d['spm']; ?>


              </td>
              <td>
                <?php echo $d['pn']; ?>


              </td>
              <td>
                <?php echo $d['sdgs']; ?>


              </td>
              <td>
                <p class="text-primary"><?php echo e($d['nama']); ?></p>
              </td>
              <td>
              </td>
              <td></td>
              <td></td>

          </tr>
          <?php if(isset($d['indikator'])): ?>
            <?php $__currentLoopData = $d['indikator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td></td>
                <td></td>

                <td></td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td><?php echo e($ind['nama']); ?></td>
                <td><?php echo e($ind['target_awal']); ?></td>
                <td><?php echo e($ind['target_ahir']); ?></td>

              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


      </table>

  </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.lay1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/NUWAS/nuwas/application/views/detail_kegiatan.blade.php ENDPATH**/ ?>