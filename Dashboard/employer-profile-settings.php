<?php
if (!isset($EDASHBOARD)) {
    header('Location: ../dashboard.php?tab=profile-settings');
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth.php?error[]=You need to login first');
}
?>

<div class="content-box"> Profile <br />
    You Are Logged in as an : Employer
</div>

<div class="content-box settings-box">
    <div class="settings-row">
        <div class="setting-desc-col">
            <div class="setting-name">Personal Details</div>
        </div>
        <div class="setting-col">
            <div class="setting-desc">Company Name</div>
            <div class="setting" data-column="user_name"><?php echo $user['company_name'] ?></div>
            <div class="setting-change">
                <input class='setting-button bt-t3' type='button' data-identifier="company_name" value='edit' />
            </div>
        </div>

        <div class="setting-col">
            <div class="setting-desc">Email</div>
            <div class="setting" data-column="email"><?php echo $user['email'] ?></div>
            <div class="setting-change">
            </div>
        </div>

        <div class="setting-col">
            <div class="setting-desc">Mobile</div>
            <div class="setting" data-column="phone"><?php echo $user['phone'] ?></div>
            <div class="setting-change">
                <input class="setting-button bt-t3" type="button" data-identifier="phone" value="edit" />
            </div>
        </div>

        <div class="setting-col">
            <div class="setting-desc">Address</div>
            <div class="setting" data-column="address"><?php echo $user['address'] ?></div>
            <div class="setting-change">
                <input class="setting-button bt-t3" type="button" data-identifier="address" value="edit" />
            </div>
        </div>
    </div>
</div>