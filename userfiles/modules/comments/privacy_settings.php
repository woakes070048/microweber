<?php must_have_access(); ?>


<script type="text/javascript">
    $(document).ready(function () {
        mw.options.form('.<?php print $config['module_class'] ?>', function () {
            mw.notification.success("<?php _ejs("All changes are saved"); ?>.");
        });
    });
</script>


<div class="card mb-5">
    <div class="card-body">


        <div class="row">
            <div class="col-xl-3 mb-xl-0 mb-3">
                <h5 class="font-weight-bold settings-title-inside"><?php _e("Comments form settings"); ?></h5>
                <small class="text-muted"><?php _e("Make settings for the comment form. Are there any rules they must agree to when posting a comment?") ?></small>
            </div>

            <div class="col-xl-9">
                <div class="card bg-light ">
                    <div class=" ">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label"><?php _e("Users must agree to the terms and conditions"); ?></label>
                                    <small class="text-muted d-block mb-2"><?php _e("If the user does not agree to the terms, he will not be able to use the comments"); ?></small>
                                </div>

                                <module type="users/terms/set_for_module" for_module="comments" />

                                <div class="form-group mb-3">
                                    <label class="form-label d-block"><?php _e("Want to view and edit the text and the page?"); ?></label>
                                    <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="collapse" data-bs-target="#comments-form-settings"><?php _e("Edit the text and URL"); ?></button>
                                </div>

                                <div class="collapse" id="comments-form-settings">
                                    <module type="users/terms/edit" terms-group="comments"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
