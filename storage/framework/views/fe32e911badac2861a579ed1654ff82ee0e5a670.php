<script type="text/javascript" src="<?php echo e(config('atm_app.jsPDFJsCdn')); ?>"></script>
<script type="text/javascript" src="<?php echo e(config('atm_app.momentJsCDN')); ?>"></script>

<script type="text/javascript">
    $(function () {
        $('#save-image-btn').click(function (event) {
            $('#save-image-btn').attr("disabled", "disabled");
            $('#save-image-btn > i').removeClass('fa-fw fa-file-pdf-o');
            $('#save-image-btn > i').addClass('fa-spin fa-spinner');
            $('#pdf_label').text('Exportando a PDF...');
            event.preventDefault();

            function getDataUri(url, callback) {
                var image = new Image();
                image.setAttribute('crossOrigin', 'anonymous'); //getting images from external domain

                image.onload = function () {
                    var ar = this.naturalWidth / this.naturalHeight;
                    var width = 100;
                    var height = width / ar;

                    var canvas = document.createElement('canvas');

                    canvas.width = width;
                    canvas.height = height;
                    var ctx = canvas.getContext('2d');
                    ctx.fillStyle = '#fff';  /// set white fill style
                    ctx.fillRect(0, 0, width, height);
                    canvas.getContext('2d').drawImage(this, 0, 0, width, height);

                    callback(canvas.toDataURL('image/jpeg'));
                };

                image.src = url;
            }

            getDataUri('<?php echo e(asset('images/atm-logo.png')); ?>', function (logo) {
                var mapElement = $("#map-canvas")[0];
                html2canvas(mapElement, {
                    useCORS: true,
                    onrendered: function (canvas) {
                        var url = canvas.toDataURL();

                        var divHeight = $('#map-canvas').height();
                        var divWidth = $('#map-canvas').width();
                        var ratio = divHeight / divWidth;

                        var doc = new jsPDF({
                            orientation: 'landscape',
                            unit: 'mm',
                            format: 'a3'
                        });
                        //doc.internal.scaleFactor = 2;

                        var width = doc.internal.pageSize.getWidth() - 40;
                        var height = ratio * width;
                        var pos = 20;

                        doc.addImage(logo, 'PNG', 20, pos);

                        var text = 'Generado por: <?php echo e(\Illuminate\Support\Facades\Auth::user()->full_name()); ?> el ' + moment().format('DD/MM/YYYY, h:mm:ss a');
                        var fontSize = doc.internal.getFontSize();
                        var txtWidth = doc.getStringUnitWidth(text) * fontSize / doc.internal.scaleFactor + 4;
                        doc.setFontSize(14);
                        doc.text(doc.internal.pageSize.getWidth() - txtWidth, pos + 12, text);

                        pos += 15;
                        doc.setLineWidth(0.2);
                        doc.line(20, pos, doc.internal.pageSize.getWidth() - 20, pos);

                        pos += 10;
                        doc.addImage(url, 'PNG', 20, pos, width, height);

                        doc.save(Date.now().toString() + '.pdf');

                        $('#save-image-btn > i').removeClass('fa-spin fa-spinner');
                        $('#save-image-btn > i').addClass('fa-fw fa-file-pdf-o');
                        $('#pdf_label').text('Exportar mapa a PDF');
                        $('#save-image-btn').removeAttr("disabled");
                    }
                });
            });
        });
    });
</script><?php /**PATH /home/atmdeveqadoor/resources/views/scripts/google-maps-save-pdf.blade.php ENDPATH**/ ?>