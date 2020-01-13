<?php $__env->startSection('content'); ?>


<div class="row mt-4 mb-4" style="padding-top: 25px;">
	<div class="col-md-12 mb-4">
		<h5 class="text-center text-white"><b>Detail Program Kegiatan <?php echo e(isset($_GET['nuwas'])?( $_GET['nuwas']?'NUWAS':''):''); ?></b></h5>
	</div>
	<div class="col-md-12 mb-4 text-white">
		<form action="<?php echo e(rt('data_program_kegiatan')); ?>" id="tgr_form">
			<input type="hidden" name="nuwas" value="<?php echo e(isset($_GET['nuwas'])?$_GET['nuwas']:null); ?>">
			<div class="row">
			<div class="col-md-4">
				<label>Daerah</label>
				<select class="form-control tgr" name="kode_daerah">
					<option value="">-</option>
					<?php $__currentLoopData = $s_daerah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php echo e(isset($_GET['kode_daerah'])?($_GET['kode_daerah']==$d['id']?'selected':''):''); ?> value="<?php echo e($d['id']); ?>"><?php echo e($d['nama']); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
			<div class="col-md-4">
				<label>Urusan</label>
				<select class="form-control tgr" name="id_urusan">
					<option value="">-</option>
					<?php $__currentLoopData = $s_urusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php echo e(isset($_GET['id_urusan'])?($_GET['id_urusan']==$d['id']?'selected':''):''); ?>  value="<?php echo e($d['id']); ?>"><?php echo e($d['nama']); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
			<div class="col-md-4">
				<label>Sub Urusan</label>
				<select class="form-control tgr" name="id_sub_urusan">
					<option value="">-</option>
					<?php $__currentLoopData = $s_sub_urusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php echo e(isset($_GET['id_sub_urusan'])?($_GET['id_sub_urusan']==$d['id']?'selected':''):''); ?>  value="<?php echo e($d['id']); ?>"><?php echo e($d['nama']); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		</div>

		</form>

		<script type="text/javascript">
			$('.tgr').on('change',function(){
				$('#tgr_form').submit();
			});
		</script>
	</div>
	<div class="col-md-12 ">
	<div class="card ">
	<div class="card-body table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Kegiatan</th>
				<th>Anggaran</th>
				<th>NSPK</th>
				<th>SPM</th>
				<th>PN</th>
				<th>SDGS</th>
				<th>Indikator</th>
				<th>Target Awal</th>
				<th>Target Ahir</th>
				<th>Program</th>
				<th>Sub Urusan</th>
				<th>Urusan</th>
				<th>Daerah</th>

			</tr>
		</thead>
		<tbody>
			<?php  $i=0;?>
			<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<?php echo e(($i+1)); ?>

					</td>
					<td><?php echo e($data['nama']); ?></td>
					<td>Rp. <?php echo e(number_format($data['anggaran'],0,',','.')); ?></td>
					<td><?php echo $data['nspk']; ?></td>
					<td><?php echo $data['spm']; ?></td>
					<td><?php echo $data['pn']; ?></td>
					<td><?php echo $data['sdgs']; ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo e($data['program']); ?></td>
					<td><?php echo e($data['sub_urusan']); ?></td>
					<td><?php echo e($data['urusan']); ?></td>
					<td><?php echo e($data['daerah']); ?></td>


				</tr>
				<?php if(isset($data['indikator'])): ?>
					<?php $__currentLoopData = $data['indikator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td colspan="7"></td>
						<td><?php echo e($indi['nama']); ?></td>
						<td><?php echo e($indi['target_awal']); ?> </td>
						<td><?php echo e($indi['target_ahir']); ?> </td>

						<td colspan="4"></td>


					</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php endif; ?>


				<?php $i++; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
</div>

</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.lay1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nuwas\application\views/pages/data_program_kegiatan.blade.php ENDPATH**/ ?>