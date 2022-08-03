<div class="mt-3  mb-3 col-md-4  ">
    <label id="label" for="" class=" required form-label">Course your
        applying for</label>
    <select required name="CID" class="form-select  " data-control="select2" data-placeholder="Select an option">
        <option> </option>
        <?php if(isset($Courses)): ?>
            <?php $__currentLoopData = $Courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($data->CID); ?>">
                    <?php echo e($data->CourseName); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </select>

</div>
<?php /**PATH /var/www/html/srl.local/sys/public/SelectCourse.blade.php ENDPATH**/ ?>