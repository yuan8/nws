<?php $__env->startSection('content'); ?>

	<div class="row mb-4 mt-4">
		<div class="col-md-12 mb-4 mt-4">
			<div class="card text-dark mb-4 mt-4">
				<div class="card-body ">
						<table class="table">
							<thead>
								<tr>
									<th>Daerah</th>
									<th>Nilai Kinerja Total</th>
									<th>Nilai Aspek Keuangan</th>
									<th>Nilai Aspek Pelayanan</th>
									<th>Nilai Aspek Oprasional</th>


									<th>Detail</th>


								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($d['nama']); ?></td>
										<td><?php echo e($d['nilai_kinerja_total']); ?></td>
										<td><?php echo e($d['nilai_aspek_keuangan']); ?></td>
										<td><?php echo e($d['nilai_aspek_pelayanan']); ?></td>
										<td><?php echo e($d['nilai_aspek_operasional']); ?></td>
										<td><a href="<?php echo e(rt('pdam/detail/').$d['id']); ?>" class="btn btn-primary">Detail</a></td>



									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>

				</div>
			</div>

	</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.lay1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nuwas\application\views/pages/pdam.blade.php ENDPATH**/ ?>