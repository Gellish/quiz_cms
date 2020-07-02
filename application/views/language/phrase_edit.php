<div class="row">
    <div class="col-sm-12">
        <a href="<?= base_url('language') ?>" class="btn btn-info">Language Home</a>
    </div>
</div>
<br/>

<div class="panel panel-default">

    <div class="panel-body">
        <div class="row">

            <!-- phrase -->
            <div class="col-sm-12">
 
                <?= form_open('language/addlebel') ?>
                <table class="table table-striped">
                    <thead> 
                        <tr>
                            <td colspan="3"> 
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-th-list"></i></th>
                            <th>Phrase</th>
                            <th>Label</th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?= form_hidden('language', $language) ?>
                            <?php if (!empty($phrases)) {?>
                                <?php $sl = 1 ?>
                                <?php foreach ($phrases as $value) {?>
                                <tr class="<?= (empty($value->$language)?"bg-danger":null) ?>">
                                
                                    <td><?= $sl++ ?></td>
                                    <td><input type="text" name="phrase[]" value="<?= $value->phrase ?>" class="form-control" readonly></td>
                                    <td><input type="text" name="lang[]" value="<?= $value->$language ?>" class="form-control"></td> 
                                </tr>
                                <?php } ?>
                            <?php } ?>

                            <tr>
                                <td colspan="3"> 
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </td>
                            </tr>
                    </tbody>
                    <?= form_close() ?>
                </table>
            </div> 

        </div>
    </div>
 

</div>