<?php require_once("../controller/script.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="tab-content tab-content-basic">
  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
    <div class="row">
      <div class="col-sm-12">
        <div class="statistics-details d-flex align-items-center justify-content-between">
          <div>
            <p class="statistics-title">Pengguna</p>
            <h3 class="rate-percentage"><?= $count_users ?></h3>
          </div>
          <div>
            <p class="statistics-title">Menu</p>
            <h3 class="rate-percentage"><?= $count_menu ?></h3>
          </div>
          <div>
            <p class="statistics-title">Jumlah Penjualan</p>
            <h3 class="rate-percentage"><?= $count_pemesanan ?></h3>
          </div>
          <div class="d-none d-md-block">
            <p class="statistics-title">Pendapatan Bulan Ini</p>
            <h3 class="rate-percentage">Rp.<?= number_format($total_pendapatan) ?></h3>
          </div>
          <div class="d-none d-md-block">
            <p class="statistics-title">Belum Dibayar</p>
            <h3 class="rate-percentage"><?= $count_belum_bayar ?></h3>
          </div>
          <div class="d-none d-md-block">
            <p class="statistics-title">Sudah Dibayar</p>
            <h3 class="rate-percentage"><?= $count_sudah_bayar ?></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 d-flex flex-column">
        <div class="row flex-grow">
          <div class="col-12 grid-margin stretch-card">
            <div class="card rounded-0">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                  <div>
                    <h4 class="card-title card-title-dash">Pendapatan Tahun <?= date('Y') ?></h4>
                  </div>
                </div>
                <div class="chartjs-bar-wrapper mt-3">
                  <?php include 'data.php'; ?>
                  <canvas id="myChart"></canvas>
                  <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: <?php echo json_encode($datasets); ?>
                      },
                      options: {
                        scales: {
                          yAxes: [{
                            ticks: {
                              beginAtZero: true
                            }
                          }]
                        }
                      }
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-flex flex-column">
        <div class="row flex-grow">
          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
            <div class="card bg-primary rounded-0">
              <div class="card-body pb-0">
                <h4 class="card-title card-title-dash text-white mb-4">Kontak</h4>
                <div class="row">
                  <div class="col-md-12">
                    <p class="status-summary-ight-white mb-1 text-left">Pengunjung yang menghubungi Sei Babi Om Ba'i</p>
                    <h2 class="text-white"><?= $count_kontak ?><i class="bi bi-people" style="margin-left: 10px;"></i></h2>
                  </div>
                  <div class="col-md-12">
                    <div class="status-summary-chart-wrapper pb-4">
                      <canvas id="status-summary"></canvas>
                      <script>
                        if ($("#status-summary").length) {
                          var statusSummaryChartCanvas = document.getElementById("status-summary").getContext('2d');;
                          var statusData = {
                            labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI"],
                            datasets: [{
                              label: '# of Votes',
                              data: [0, 0, 1, 2, 2, 2],
                              backgroundColor: "#ffcc00",
                              borderColor: [
                                '#01B6A0',
                              ],
                              borderWidth: 2,
                              fill: false, // 3: no fill
                              pointBorderWidth: 0,
                              pointRadius: [0, 0, 0, 0, 0, 0],
                              pointHoverRadius: [0, 0, 0, 0, 0, 0],
                            }]
                          };

                          var statusOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                              yAxes: [{
                                display: false,
                                gridLines: {
                                  display: false,
                                  drawBorder: false,
                                  color: "#F0F0F0"
                                },
                                ticks: {
                                  beginAtZero: false,
                                  autoSkip: true,
                                  maxTicksLimit: 4,
                                  fontSize: 10,
                                  color: "#6B778C"
                                }
                              }],
                              xAxes: [{
                                display: false,
                                gridLines: {
                                  display: false,
                                  drawBorder: false,
                                },
                                ticks: {
                                  beginAtZero: false,
                                  autoSkip: true,
                                  maxTicksLimit: 7,
                                  fontSize: 10,
                                  color: "#6B778C"
                                }
                              }],
                            },
                            legend: false,

                            elements: {
                              line: {
                                tension: 0.4,
                              }
                            },
                            tooltips: {
                              backgroundColor: 'rgba(31, 59, 179, 1)',
                            }
                          }
                          var statusSummaryChart = new Chart(statusSummaryChartCanvas, {
                            type: 'line',
                            data: statusData,
                            options: statusOptions
                          });
                        }
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php $profilUser = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
    if (mysqli_num_rows($profilUser) > 0) {
      $row = mysqli_fetch_assoc($profilUser);
      if ($row['telp'] == "" || $row['alamat'] == "") { ?>
        <div class="row">
          <div class="col-lg-12 d-flex flex-column">
            <div class="row flex-grow">
              <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded table-darkBGImg rounded-0" style="background-image: url(../assets/images/darkBG.png);">
                  <div class="card-body">
                    <div class="col-sm-8">
                      <h3 class="text-white upgrade-info mb-0">
                        Data kamu <span class="fw-bold">Belum Lengkap</span> untuk membeli
                      </h3>
                      <a href="profil" class="btn btn-info upgrade-btn">Lengkapi Akun!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php }
    } ?>
    <div class="row">
      <div class="col-lg-12 d-flex flex-column">
        <div class="row flex-grow">
          <div class="col-12 grid-margin stretch-card">
            <div class="card rounded-0">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                  <div>
                    <h4 class="card-title card-title-dash">Daftar Pemesanan</h4>
                  </div>
                  <div>
                    <button class="btn btn-primary btn-sm text-white mb-0 me-0 rounded-0" onclick="window.location.href='pemesanan'" type="button"><i class="bi bi-arrow-return-right"></i> Lihat Lainnya</button>
                  </div>
                </div>
                <div class="table-responsive  mt-1">
                  <table class="table select-table">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">#Order ID</th>
                        <th scope="col" class="text-center">Tgl Beli</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Nama Pembeli</th>
                        <th scope="col" class="text-center">Menu</th>
                        <th scope="col" class="text-center">Alamat</th>
                        <th scope="col" class="text-center">Ekspedisi</th>
                        <th scope="col" class="text-center">Estimasi</th>
                        <th scope="col" class="text-center">Total Berat</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Ongkos Kirim</th>
                        <th scope="col" class="text-center">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (mysqli_num_rows($pemesananDash) > 0) {
                        while ($row = mysqli_fetch_assoc($pemesananDash)) { ?>
                          <tr>
                            <th scope="row"><?= $row['id_order']; ?></th>
                            <td><?php $dateCreate = date_create($row["created_at"]);
                                echo date_format($dateCreate, "l, d M Y h:i a"); ?></td>
                            <td><?= $row["status_pemesanan"] ?></td>
                            <td><?= $row["username"] ?><br>Email: <?= $row["email"] ?><br>Telp: <?= $row["telp"] ?><br>Alamat: <?= $row["alamat"] ?></td>
                            <td><?= $row["nama_makanan"] ?></td>
                            <td><?= $row['alamat_pengirim'] . ", " . $row['tipe'] . ", " . $row['distrik'] . ", " . $row['provinsi'] . ", (" . $row['kodepos'] . ")" ?></td>
                            <td><?= strtoupper($row["ekspedisi"]) . " " . $row['paket'] . " - Rp. " . number_format($row['ongkir']) ?></td>
                            <td><?= $row["estimasi"] ?> hari</td>
                            <td><?= $row["jumlah"] ?>Kg</td>
                            <td>Rp.<?= number_format($row["harga"]) ?>/Kg</td>
                            <td>Rp.<?= number_format($row["ongkir"]) ?>/Kg</td>
                            <td>Rp.<?= number_format($row["total_harga"]) ?></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../assets/datatable/datatables.js"></script>
<script>
  $(document).ready(function() {
    $("#datatable").DataTable();
  });
</script>
<script>
  (function() {
    function scrollH(e) {
      e.preventDefault();
      e = window.event || e;
      let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
      document.querySelector(".table-responsive").scrollLeft -= (delta * 40);
    }
    if (document.querySelector(".table-responsive").addEventListener) {
      document.querySelector(".table-responsive").addEventListener("mousewheel", scrollH, false);
      document.querySelector(".table-responsive").addEventListener("DOMMouseScroll", scrollH, false);
    }
  })();
</script>