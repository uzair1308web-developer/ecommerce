<div class="modal fade" id="media-modal-one" tabindex="-1" role="dialog" aria-labelledby="media-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="media-modal-title">Media</h5>
            </div>
            <div class="modal-body" id="media-modal-body">
                <div class="container-fluid">

                    <input type="hidden" id="mediaOneMainInput" value="">
                    <input type="hidden" id="mediaOneMediaType" value="">

                    <div class="row" id="media-modal-img-box">
                        <?php
                        $image = "";
                        $sql = "SELECT * FROM media_data";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row =  mysqli_fetch_assoc($result)) {

                                $img_src = "upload/" . $row['image'];

                                echo "<input type='hidden' value='' id='imageInput' class='mb-4'>
                                        <div class='col-lg-2 col-md-3 col-sm-4 col-6 mb-2 modal-col' onclick=checkMedia('media$row[id]')  >
                                            <input type='checkbox'  id='media$row[id]' data-url='$img_src' class='modalone-checkbox'  value='$row[id]'>
                                            <img src='upload/$row[image]' alt='' style='height:100px; width:100px;'>
                                        </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="selectMedia('media-modal-one')">Done</button>
                <button type="button" class="btn btn-secondary" onclick="cancelMedia('media-modal-one', 'final-selected-media-input', 'media-selected-image')">Cancel</button>
            </div>
        </div>
    </div>
</div>