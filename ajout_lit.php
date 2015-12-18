<?php require('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="acceuil.php">Accueil</a>
        </li>
        <li>
            <a href="lit.php">Lit</a>
        </li>
        <li>
            <a href="ajout_lit.php">Ajouter</a>
        </li>

    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Form Elements</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
<div class="box-content">
    <div class="control-group">
        <label class="control-label" for="selectError">Modern Select</label>

        <div class="controls" >
            <select id="selectError" data-rel="chosen" class="box col-md-8">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                <option>Option 4</option>
                <option>Option 5</option>
            </select>
        </div>
    </div>
    </div>
            </div>
        </div>
    </div>
<?php require('footer.php'); ?>