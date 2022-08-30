
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
      body {
        text-align: center;
        /* padding: 40px 0; */
        /* background: #EBF0F5; */
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #fff;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <div class="ptb-100">
        <div class="container">
            <div class="col-12">
            <?php 
              if($status == 200){
            ?>
            <div class="card mt-5">
                <div style="border-radius:200px; height:200px; width:200px; background: #88B04B; margin:0 auto;">
                    <i class="checkmark">✓</i>
                </div>
                <br>
                    <h1>Pemesanan Berhasil</h1> 
                    <p>Pemesanan anda dengan nomer : <?= $row['transaksi_no'] ?><br/> Sudah Berhasil!</p>
            </div>
              <?php }else{?>
                <div class="card mt-5">
                <div style="border-radius:200px; height:200px; width:200px; background: #E30000; margin:0 auto;">
                    <i class="checkmark">X</i>
                </div>
                    <br>
                    <h1>Pemesanan Belum Selesai</h1> 
                    <p>Pemesanan anda dengan nomer : <?= $row['transaksi_no']?><br/> Belum Selesai!</p>
            </div>
              <?php }?>
            </div>
        </div>
    </div>
</div>
      