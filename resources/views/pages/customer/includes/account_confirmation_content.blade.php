<section id="dashboard-header" class="customer-dashboard">

</section>
<section id="dashboard-verification" class="customer-dashboard">
    <div class="container">
        <div class="customer-account-status-badge">
                <div style="background: rgb(47, 217, 255);" class="customer-account-badge">
                    Account: Waiting for confirmation
                </div>

        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="first-time-name">Welcome <strong>{{ucwords(Auth::user()->name)}}</strong></h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="verification-uploaded-note">
                                <h3 class="mb-4"><strong>ThankYou!</strong> We successfully got your data. </h3>
                                <ol class="pl-4">
                                    <li>Mark Express is registered with <strong>FBR</strong>. For security reasons we need to ensure that we are working with valid customers.</li>
                                    <li>The purpose of the collected data is to retain the originality of our new and existing customers.</li>
                                    <li>The collected data will not be used anywhere for any reason by Mark Express.</li>
                                    <li>You can still change the copies you uploaded if you think you entered the ones before we start confirming your account.</li>
                                    <li>This screen will be disappeared after we process your account.</li>
                                    <li>If we found anything mismatched, the result will be in account deletion.</li>
                                    <li>You may receive a call for further confirmations as well.</li>
                                </ol>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
