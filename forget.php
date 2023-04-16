<div class="container">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-lg-12 col-xl-11">

      <div class="card-body p-md-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">

              <h2>Reset Password</h2>
                <form id="forgot-form">

                    <div class="form-group">
                        <small id="emailHelp" class="form-text text-muted">if your email exits you will get a password reset link as an email</small>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <input type="hidden" name="forget" value="forgot">
                    <div class="d-flex py-2 flex-grow-1">
                      <button type="submit" class="btn btn-primary flex-grow-1">Search for Email</button>
                    </div>
                </form>

              <div id="forgot-error"></div>


          </div>
        </div>
      </div>

    </div>
  </div>
</div>
