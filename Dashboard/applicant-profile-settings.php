<?php
if(!isset($DASHBOARD) || !$DASHBOARD == true){
	header('Location: ../dashboard.php');
}
?>

<div class="content-box"> Profile <br />

    <div class="profile-img-container">

        <form action="Utils/image-upload.php?redirect=dashboard.php?" method="POST" enctype="multipart/form-data">
            <label class="image-upload" id="profile-image">
                <input type="file" name="image" id="image" class="image-upload__input" accept="image/*" required>
                <div class="image-upload__preview" style="background-image:url(profiles/applicant/<?php echo $user_id ?>/profile-image.jpg)"></div>
                <div class="image-upload__path">Choose File</div>
            </label>
            <button value='submit' class='button green' name='approve' type='submit'><span class='material-symbols-outlined'>
                    check</span><span class='text'>Save</span>
            </button>
        </form>

    </div>
    You Are Logged in as an APPLICANT</div>

<div class="content-box settings-box">
    <div class="settings-row">
        <div class="setting-desc-col">
            <div class="setting-name">Personal Details</div>
        </div>
        <div class="setting-col">
            <div class="setting-desc">Username</div>
            <div class="setting" data-column="user_name"><?php echo $user['user_name'] ?></div>
            <div class="setting-change">
                <input class='setting-button bt-t3' type='button' data-identifier="user_name" value='edit' />
            </div>
        </div>

        <div class="setting-col">
            <div class="setting-desc">Name</div>
            <div class="setting" data-column="name"><?php echo $user['name'] ?></div>
            <div class="setting-change">
                <input class="setting-button bt-t3" type="button" data-identifier="name" value="edit" />
            </div>
        </div>

        <div class="setting-col">
            <div class="setting-desc">NIC</div>
            <div class="setting" data-column="nic"><?php echo $user['nic'] ?></div>
            <div class="setting-change">
                <input class="setting-button bt-t3" type="button" data-identifier="nic" value="edit" />
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