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
            <h3>Spectacles</h3>
            <button onclick="window.location.href='show'" class="btn btn-primary green">Ajouter un spectable</button>
        </div>

        <?php showList($data["showList"]);
        ?>

    </div>
</div>

<?php
PageFrame::footer();

 function showList($data)
{
    $html = "<table class='table table-borderless'>";
    $html .= "<thead class='black white-text'><tr>
                <th>Affiche</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Artiste</th>
                <th></th>
                </tr></thead>";
    foreach ($data as $value) {
        $IdShow = $value["idShow"];
        $Name = $value['title'];
        $Artist = $value['artist'];
        $category = $value["idCat"];
        $html .= "<tr>
                    <th class='listingContainer'>
                        <img class='showImage' src='".$_SERVER['basePath']."public/images/show/show$IdShow.jpg'>
                    </th>
                    <th>$Name</td>
                    <th>$category</td>
                    <th>$Artist</td>
                    <th
                    <div style=\"text-align:right; display:flex; justify-content:flex-end;align-items:center;\">
                        <a href=\"".$_SERVER['basePath']."admin/details?id=$IdShow\"><div class=\"next\">Détails</div></a>
                    </div>
                    </th>
                </tr>";
    }
    $html .= "</table>";
    echo $html;
}
?>