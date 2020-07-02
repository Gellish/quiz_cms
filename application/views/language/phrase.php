<div class="row">
    <div class="col-sm-12">
        <a href="<?= base_url('language') ?>" class="btn btn-info">Language Home</a>
    </div>
</div>
<br/>

<div class="panel" style="background-color:#f6f6f6">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTableExample2">
                 <thead>
                    <tr>
                        <td colspan="2">
                            <?= form_open('language/addPhrase', ' class="form-inline" ') ?> 
                                <div class="form-group">
                                    <label class="sr-only" for="addphrase"> Phrase Name</label>
                                    <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name">
                                </div>
                                  
                                <button type="submit" class="btn btn-primary">Save</button>
                            <?= form_close(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-th-list"></i></th>
                        <th>Phrase</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($phrases)) {?>
                        <?php $sl = 1 ?>
                        <?php foreach ($phrases as $value) {?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= $value->phrase ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


