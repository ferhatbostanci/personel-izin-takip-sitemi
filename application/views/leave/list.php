<?php $this->load->view('include/header'); ?>

    <!-- Page Container -->
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">

        <?php $this->load->view('include/bodyheader'); ?>

        <!-- Main Container -->
        <main id="main-container">

            <!-- Hero -->
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill h3 my-2">
                            İzin Listesi
                            <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                                Bu bölümde personellerin izinlerini listeleyebilirsiniz.
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content">

                <!-- Dynamic Table Simple -->
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">PERSONEL İZİN LİSTESİ</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" onclick="window.location.reload();">
                                <i class="si si-reload"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th style="width: 35;">AD-SOYAD</th>
                                <th style="width: 15%;">İZİN TÜRÜ</th>
                                <th style="width: 15%;">BAŞLANGIÇ</th>
                                <th style="width: 15%;">BİTİŞ</th>
                                <th style="width: 10%;">SÜRE</th>
                                <th style="width: 5%;">SİL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; foreach($leavehistory as $history): $i++; ?>
                                <tr>
                                    <td class="text-center font-size-sm"><?= $i ?></td>
                                    <td class="font-w600 font-size-sm">
                                        <?= $history['staffname'] ?>
                                        <span class="badge badge-danger"><?= time() > (strtotime($history['end_date'])+86400) ? 'Bitmiş' : '' ?></span>
                                        <?php if( time() >= strtotime($history['start_date']) && time() <= (strtotime($history['end_date'])+86400) ): ?>
                                        <span class="badge badge-success">Devam Ediyor</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="font-w500 font-size-sm"><?= $history['typename'] ?></td>
                                    <td>
                                        <em class="text-muted font-size-sm"><?= date('d/m/Y', strtotime($history['start_date'])) ?></em>
                                    </td>
                                    <td>
                                        <em class="text-muted font-size-sm"><?= date('d/m/Y', strtotime($history['end_date'])) ?></em>
                                    </td>
                                    <td>
                                        <em class="text-muted font-size-sm"><?= getWorkdays($history['start_date'], $history['end_date'], $history['worker']) ?> Gün</em>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-dark" onclick="deleteButton(<?= $history['id'] ?>)">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Dynamic Table Simple -->

            </div>
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->

        <?php $this->load->view('include/bodyfooter'); ?>

    </div>
    <!-- END Page Container -->

    <script src="<?= base_url('assets/js/plugins/jquery/jquery.slim.min.js') ?>"></script>

    <script>
        function deleteButton(id) {
            // Ajax POST
            $.ajax({
                url: "<?= base_url('leave/list') ?>",
                method: "DELETE",
                data: {
                    id : id
                }
            }).done(function(data){
                location.reload()
            });
        }
    </script>

<?php $this->load->view('include/footer'); ?>