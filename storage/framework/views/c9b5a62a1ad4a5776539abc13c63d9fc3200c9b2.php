<form action="<?php echo e(route('activity')); ?>" method="get">
	<div class="row mb-3">
		<?php if(in_array('description',explode(',', config('LaravelLogger.searchFields')))): ?>
			<div class="col-12 col-sm-4 col-lg-2 mb-2">
				<input type="text" name="description" value="<?php echo e(request()->get('description') ? request()->get('description'):null); ?>" class="form-control" placeholder="Description">
			</div>
		<?php endif; ?>
		<?php if(in_array('user',explode(',', config('LaravelLogger.searchFields')))): ?>
			<div class="col-12 col-sm-4 col-lg-2 mb-2">
				<select class="form-control" name="user">
					<option value="" selected>All</option>
					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($user->id); ?>" <?php echo e(request()->get('user') && request()->get('user') == $user->id ? 'selected':''); ?>><?php echo e($user->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		<?php endif; ?>
		<?php if(in_array('method',explode(',', config('LaravelLogger.searchFields')))): ?>
			<div class="col-12 col-sm-4 col-lg-2 mb-2">
				<select class="form-control" name="method">
					<option value="" selected>All</option>
					<option value="GET" <?php echo e(request()->get('method') && request()->get('method') == 'GET' ? 'selected':''); ?>>GET</option>
					<option value="POST" <?php echo e(request()->get('method') && request()->get('method') == 'POST' ? 'selected':''); ?>>POST</option>
					<option value="PUT" <?php echo e(request()->get('method') && request()->get('method') == 'PUT' ? 'selected':''); ?>>PUT</option>
					<option value="DELETE" <?php echo e(request()->get('method') && request()->get('method') == 'DELETE' ? 'selected':''); ?>>DELETE</option>
					<option value="CONNECT" <?php echo e(request()->get('method') && request()->get('method') == 'CONNECT' ? 'selected':''); ?>>CONNECT</option>
					<option value="OPTIONS" <?php echo e(request()->get('method') && request()->get('method') == 'OPTIONS' ? 'selected':''); ?>>OPTIONS</option>
					<option value="TRACE" <?php echo e(request()->get('method') && request()->get('method') == 'TRACE' ? 'selected':''); ?>>TRACE</option>
					<option value="PATCH" <?php echo e(request()->get('method') && request()->get('method') == 'PATCH' ? 'selected':''); ?>>PATCH</option>
					<option value="CONNECT" <?php echo e(request()->get('method') && request()->get('method') == 'CONNECT' ? 'selected':''); ?>>CONNECT</option>
				</select>
			</div>
		<?php endif; ?>
		<?php if(in_array('route',explode(',', config('LaravelLogger.searchFields')))): ?>
			<div class="col-12 col-sm-4 col-lg-2 mb-2">
				<input type="text" name="route" class="form-control" value="<?php echo e(request()->get('route') ? request()->get('route'):null); ?>" placeholder="Route">
			</div>
		<?php endif; ?>
		<?php if(in_array('ip',explode(',', config('LaravelLogger.searchFields')))): ?>
			<div class="col-12 col-sm-4 col-lg-2 mb-2">
				<input type="text" name="ip_address" class="form-control" value="<?php echo e(request()->get('ip_address') ? request()->get('ip_address'):null); ?>" placeholder="Ip Address">
			</div>
		<?php endif; ?>
		<?php if(in_array('description',explode(',', config('LaravelLogger.searchFields')))||in_array('user',explode(',', config('LaravelLogger.searchFields'))) ||in_array('method',explode(',', config('LaravelLogger.searchFields'))) || in_array('route',explode(',', config('LaravelLogger.searchFields'))) || in_array('ip',explode(',', config('LaravelLogger.searchFields')))): ?>
			<div class="col-12 col-sm-4 col-lg-2 mb-2">
				<input type="submit" class="btn btn-primary btn-block" value="Search">
			</div>
		<?php endif; ?>
	</div>
</form>
<?php /**PATH /home/atmdeveqadoor/vendor/jeremykenedy/laravel-logger/src/resources/views//partials/form-search.blade.php ENDPATH**/ ?>