<?php
PageFrame::header();
PageFrame::loadBundle();
?>
<style>
    body {
        background-color: #f8f9fa;

    }
</style>
<link rel="stylesheet" href="/public/css/admin.css">

<div class="listcontainer">
<?php PageFrame::AdminNav();?>
    <div class="section">
        <div class="d-flex justify-content-between" style="padding:20px">
            <h2>Fidelité</h2>
           
        </div>
        <?php Components::fidelityList($data) ?>
    </div>
</div>

<?php
PageFrame::footer();
?>