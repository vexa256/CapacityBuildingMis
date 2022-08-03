<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> SRL Uganda Student Course Application


                    <small class="text-danger">

                        On form submission, An account is created for you with
                        the
                        default password and username as the email provided.
                        This must be changed after you login

                    </small>


                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form action="<?php echo e(route('NewStudent')); ?>" class="row" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">

                        <?php echo $__env->make('public.SelectCourse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="mt-3  mb-3 col-md-4  ">
                            <label id="label" for="" class=" required form-label">Country of Origin</label>
                            <select required name="nationality" class="form-select  " data-control="select2" data-placeholder="Select an option">
                                <option> </option>
                                <?php if(isset($Countries)): ?>
                                    <?php $__currentLoopData = $Countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($data->name); ?>">
                                            <?php echo e($data->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </select>

                        </div>


                        <div class="mt-3  mb-3 col-md-4  ">
                            <label id="label" for="" class=" required form-label">Gender</label>
                            <select required name="Gender" class="form-select  " data-control="select2"
                                data-placeholder="Select an option">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>



                            </select>

                        </div>


                        <input type="hidden" name="created_at" value="<?php echo e(date('Y-m-d h:i:s')); ?>">

                        <input type="hidden" name="role" value="Approve">

                        <input type="hidden" name="TableName" value="students">

                        <?php $__currentLoopData = $Form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data['type'] == 'string'): ?>
                                <?php echo e(CreateInputText($data, $placeholder = null, $col = '4')); ?>

                            <?php elseif('smallint' == $data['type'] ||
                                'bigint' === $data['type'] ||
                                'integer' == $data['type'] ||
                                'bigint' == $data['type']): ?>
                                <?php echo e(CreateInputInteger($data, $placeholder = null, $col = '4')); ?>

                            <?php elseif($data['type'] == 'date' || $data['type'] == 'datetime'): ?>
                                <?php echo e(CreateInputDate($data, $placeholder = null, $col = '4')); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="mt-3  mb-3 col-md-4 ">
                            <label id="label" for="" class=" required form-label">Upload Your CV
                                (Only PDF )</label>

                            <input type="file" required name="CV" class="form-control" id="">

                        </div>

                        <div class="mt-3  mb-3 col-md-4 ">
                            <label id="label" for="" class=" required form-label">Upload Your ID
                                Document (Only PDF )</label>

                            <input type="file" required name="StudentID" class="form-control" id="">

                        </div>





                    </div>

                    <div class="row">
                        <div class="mt-5  mb-5 col-md-12 ">
                            <label id="label" for="" class=" required form-label">Briefly describe
                                your reasons for applying for this course and
                                how
                                you are hoping it will help you and your
                                organization. </label>
                            <textarea class="editorme" name="ReasonsForJoining" id="" cols="30" rows="10"></textarea>

                        </div>

                        <div class="mt-5  mb-5 col-md-12 ">
                            <label id="label" for="" class=" required form-label">Please describe any
                                special needs of which we should be aware
                                (Disability, etc) </label>
                            <textarea class="editorme" name="SpecialNeed" id="" cols="30" rows="10">

                                Special Needs

                            </textarea>

                        </div>
                        <?php $__currentLoopData = $Form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data['type'] == 'text'): ?>
                                <?php echo e(CreateInputEditor($data, $placeholder = null, $col = '12')); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>



                    <input type="hidden" name="uuid" value="<?php echo e(md5(uniqid() . 'AFC' . date('Y-m-d H:I:S'))); ?>">




            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-dark">Save
                    Changes</button>

                </form>
            </div>

        </div>
    </div>
</div>
<?php /**PATH /var/www/html/srl.local/sys/public/NewApp.blade.php ENDPATH**/ ?>