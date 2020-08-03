<?php $__env->startSection('template_title'); ?>
	<?php echo e($user->name); ?>'s Profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>

	#map-canvas{
		min-height: 300px;
		height: 100%;
		width: 100%;
	}

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
				<div class="card">
					<div class="card-header">

						<?php echo e(trans('profile.showProfileTitle',['username' => $user->name])); ?>


					</div>
					<div class="card-body">
						<dl class="user-info">

							<dt>
								<?php echo e(trans('profile.showProfileUsername')); ?>

							</dt>
							<dd>
								<?php echo e($user->name); ?>

							</dd>

							<dt>
								<?php echo e(trans('profile.showProfileFirstName')); ?>

							</dt>
							<dd>
								<?php echo e($user->first_name); ?>

							</dd>

							<?php if($user->last_name): ?>
								<dt>
									<?php echo e(trans('profile.showProfileLastName')); ?>

								</dt>
								<dd>
									<?php echo e($user->last_name); ?>

								</dd>
							<?php endif; ?>

							<dt>
								<?php echo e(trans('profile.showProfileEmail')); ?>

							</dt>
							<dd>
								<?php echo e($user->email); ?>

							</dd>
						</dl>

						<?php if($user->profile): ?>
							<?php if(Auth::user()->id == $user->id): ?>

								<?php echo HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-cog', trans('titles.editProfile'), array('class' => 'btn btn-small btn-info btn-block')); ?>


							<?php endif; ?>
						<?php else: ?>

							<p><?php echo e(trans('profile.noProfileYet')); ?></p>
							<?php echo HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-plus ', trans('titles.createProfile'), array('class' => 'btn btn-small btn-info btn-block')); ?>


						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

	<?php if(config('settings.googleMapsAPIStatus')): ?>
		<?php echo $__env->make('scripts.google-maps-geocode-and-map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/profiles/show.blade.php ENDPATH**/ ?>