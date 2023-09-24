<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta16
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title><?= $tittle; ?></title>
  <link rel="icon" href="<?= base_url(); ?>assets/login/Logo - pu.png" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/login/Logo - pu.png" type="image/x-icon">
  <!-- CSS files -->
  <link href="<?= base_url(); ?>assets/dist/css/tabler.min.css?1668287865" rel="stylesheet"/>
  <link href="<?= base_url(); ?>assets/dist/css/tabler-flags.min.css?1668287865" rel="stylesheet"/>
  <link href="<?= base_url(); ?>assets/dist/css/tabler-payments.min.css?1668287865" rel="stylesheet"/>
  <link href="<?= base_url(); ?>assets/dist/css/tabler-vendors.min.css?1668287865" rel="stylesheet"/>
  <link href="<?= base_url(); ?>assets/dist/css/demo.min.css?1668287865" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Toastr  -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/toastr/toastr.min.css">

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> -->
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
  <script type="text/javascript">
    function base_url() {
     return '<?= base_url(); ?>';
   }

   function ajaxUntukSemua(url, requestData, onSuccess, onError) {
    $.ajax({
      url: url,
      type: 'POST',
      data: requestData,
      dataType: 'json',
      success: function(data) {
        onSuccess(data);
      },
      error: function(xhr, status, error) {
        onError(error);
      }
    });
  }
</script>
<style>
  @import url('https://rsms.me/inter/inter.css');
  :root {
   --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
 }
</style>
</head>
<body  class=" layout-fluid">

 <!-- Sidebar -->
 <?php $this->load->view('tamplate/'.$sidebar); ?>
 <!-- End Sidebar -->
 <div class="page-wrapper">
  <!-- Page header -->
  <?php $this->load->view($content); ?>
  <!-- Page body -->

  <!-- Footer -->
  <?php $this->load->view('tamplate/'.$footer_content); ?>
  <!-- End Footer -->
</div>
</div>

<!-- Modal PDF -->
<div class="modal modal-blur fade " id="modalPDFXX" >
  <div class="modal-dialog modal-xl "style="height:100%;">
    <div class="modal-content " style="height:100%; margin-top: -40px;">
      <div style="height: 100%; width: 100%; margin:auto;  justify-content: center;  align-items: center;">
        <embed src="" id="idEmbed" frameborder="0" width="100%" height="100%">
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal PDF -->

  <!-- Libs JS -->
  <script  src="<?= base_url(); ?>assets/dist/libs/apexcharts/dist/apexcharts.min.js?1668287865" defer></script>
  <script  src="<?= base_url(); ?>assets/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1668287865" defer></script>
  <script  src="<?= base_url(); ?>assets/dist/libs/jsvectormap/dist/maps/world.js?1668287865" defer></script>
  <script  src="<?= base_url(); ?>assets/dist/libs/jsvectormap/dist/maps/world-merc.js?1668287865" defer></script>
  <!-- Tabler Core -->
  <script  src="<?= base_url(); ?>assets/dist/js/tabler.min.js?1668287865" defer></script>
  <script  src="<?= base_url(); ?>assets/dist/js/demo.min.js?1668287865" defer></script>
  <!-- SweetAlert -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/sweetalert/sweetalert2.js"></script>
  <!-- Toastr -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/toastr/toastr.min.js"></script>
  <!-- Custom Toast -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/toastr/toast_custom.js"></script>

  <!-- Lite Picker -->
  <script src="<?= base_url(); ?>assets/dist/libs/litepicker/dist/litepicker.js" defer></script>

  <script type="text/javascript">
    $(document).ready(function() {

      showPdf = async function (url) {
        let start = await url.indexOf('assets');
        if (start !== -1) {
          let result =  await url.substring(start),
          spasiJadiPersen = await result.replace(/ /g, '%20'); 
          var parent = await $('embed#idEmbed').parent();
          var newElement = await "<embed src='"+base_url()+spasiJadiPersen+"' id='idEmbed' frameborder='0' width='100%' height='100%'>";

          await $('embed#idEmbed').remove();
          await parent.append(newElement);
          await $('#modalPDFXX').modal('show');
        } 
      }

    })
  </script>

</body>
</html>