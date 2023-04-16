<div class="container-sm">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">

            <div class="card-body p-md-5">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">


                        <h2>Reset Password</h2>
                        <form id="reset-form" action="controller/email.php" method="post">
                            <div class="form-group mb-2">
                                <input type="password" class="form-control" name="password"  placeholder="New Password">
                            </div>

                            <div class="form-password">
                                <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
                            </div>

                            <input type="hidden" name="reset" value="reset">
                            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

                            <div class="d-flex py-2">
                                <button type="submit" class="btn btn-danger">Reset Password</button>
                            </div>
                        </form>

                        <div id="reset-error"></div>

                        
                    </div>
                </div>
            </div>

    
        </div>

    <div>
</div>

